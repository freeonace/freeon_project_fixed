<?php
function league_url(int $id, ?string $alt = null, ?string $tab = null): string {
	$u = url('database', 'leagues') . '/' . $id . '/' . (slugify($alt) ?: 'leagues');
	return $tab ? $u . '/' . $tab : $u;
}

function leagues_by_ids(array $ids): array {
	$ids = array_values(array_unique(array_map('intval', $ids)));
	if (!$ids) return [];

	$in = implode(',', array_fill(0, count($ids), '?'));
	$st = db()->prepare(
		"SELECT compID AS id, compName AS name, compAlt AS alt, compCol AS color, compSubCol AS subcol
		 FROM competition WHERE compID IN ($in)"
	);
	$st->execute($ids);

	$out = [];
	foreach ($st->fetchAll() as $r) $out[(int)$r['id']] = $r;
	return $out;
}

function leagues_by_entity(): array {
	$st = db()->query(
		"SELECT e.entityId AS entity_id, e.entityName AS entity,
				c.compCol AS color, c.compSubCol AS subcol,
		        c.compID AS id, c.compName AS name, c.compAlt AS alt
		 FROM competition c
		 JOIN entity e ON e.entityId = c.compEntity
		 WHERE e.entityId <> 1
		 ORDER BY e.entityName, c.compName"
	);

	$out = [];
	foreach ($st->fetchAll() as $r) $out[(int)$r['entity_id']][] = $r;
	return $out;
}

function league_by_id(int $id): ?array {
	$st = db()->prepare(
		'SELECT c.compID AS id, c.compName AS name, c.compAlt AS alt,
		        c.compType AS type, c.compTier AS tier, c.compStatus AS status,
		        c.compEst AS est,
		        c.compCol AS color, c.compSubCol AS subcol,
		        r.regionID AS region_id, r.regionName AS region
		 FROM competition c
		 LEFT JOIN region r ON r.regionID = c.compRegion
		 WHERE c.compID = :id'
	);
	$st->execute(['id' => $id]);
	return $st->fetch() ?: null;
}

function league_style(?string $color, ?string $subcol): string {
	return color_style($color, $subcol, 'comp');
}