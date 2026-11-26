<?php
//List Teams
function team_slug(?string $alt, ?string $name = null): string {
	$src = trim((string)$alt) !== '' ? $alt : $name;
	return slugify($src) ?: 'teams';
}

function team_info_url(int $id, ?string $alt = null, ?string $name = null, ?string $tab = null): string {
	$u = url('database', 'teams') . '/' . $id . '/' . team_slug($alt, $name);
	return $tab ? $u . '/' . $tab : $u;
}

function team_by_id(int $id): ?array {
	$st = db()->prepare(
		'SELECT t.teamID AS id, t.teamName AS name, t.teamShort AS short, t.teamCity AS city, t.teamAlt AS alt, t.teamEst AS est,
		        t.teamColor AS color, t.teamSubCol AS subcol,
		        t.teamRegion AS region_id,
		        t.teamEntity AS entity_id,
		        r.regionName AS region,
		        e.entityName AS entity,
		        s.stadeName  AS stadium, s.stadeCapc AS capacity
		 FROM team t
		 LEFT JOIN region r ON r.regionID = t.teamRegion
		 LEFT JOIN stadium s ON s.stadeID = t.teamStade
		 LEFT JOIN entity e ON e.entityID = t.teamEntity
		 WHERE t.teamID = :id'
	);
	$st->execute(['id' => $id]);
	return $st->fetch() ?: null;
}

function team_leagues(): array {
	return db()->query(
		"SELECT entityId AS id, entityName AS name
		 FROM entity
		 WHERE entityName LIKE '%League%'
		 AND entityID NOT IN (18,19,20,21)
		 ORDER BY entityName"
	)->fetchAll();
}

function teams_by_entities(array $entityIds): array {
	$ids = array_values(array_unique(array_map('intval', $entityIds)));
	if (!$ids) return [];

	$in = implode(',', array_fill(0, count($ids), '?'));
	$st = db()->prepare(
		"SELECT t.teamID AS id, t.teamName AS name, t.teamShort AS short, t.teamAlt AS alt,
		        t.teamCity AS city, t.teamColor AS color, t.teamSubCol AS subcol,
		        t.teamEntity AS entity_id, e.entityName AS entity, s.stadeName AS stadium
		 FROM team t
		 JOIN entity e ON e.entityId = t.teamEntity
		 LEFT JOIN stadium s ON s.stadeID = t.teamStade
		 WHERE t.teamEntity IN ($in)
		 ORDER BY t.teamID, t.teamName"
	);
	$st->execute($ids);

	$out = [];
	foreach ($st->fetchAll() as $r) $out[(int)$r['entity_id']][] = $r;
	return $out;
}

function team_style(?string $color, ?string $subcol): string {
	return color_style($color, $subcol, 'team');
}