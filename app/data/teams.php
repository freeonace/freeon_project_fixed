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

function hex_rgb(?string $c): ?array {
	$c = ltrim(trim((string)$c), '#');
	if (strlen($c) === 3) $c = $c[0] . $c[0] . $c[1] . $c[1] . $c[2] . $c[2];
	if (strlen($c) === 8) $c = substr($c, 0, 6);
	if (!preg_match('/^[0-9a-f]{6}$/i', $c)) return null;
	return [hexdec(substr($c, 0, 2)), hexdec(substr($c, 2, 2)), hexdec(substr($c, 4, 2))];
}

function rel_luminance(array $rgb): float {
	$f = static function ($v) {
		$v /= 255;
		return $v <= 0.03928 ? $v / 12.92 : (($v + 0.055) / 1.055) ** 2.4;
	};
	return 0.2126 * $f($rgb[0]) + 0.7152 * $f($rgb[1]) + 0.0722 * $f($rgb[2]);
}

function contrast_ratio(array $a, array $b): float {
	$la = rel_luminance($a);
	$lb = rel_luminance($b);
	return (max($la, $lb) + 0.05) / (min($la, $lb) + 0.05);
}

function rgb_hex(array $c): string {
	return sprintf('#%02x%02x%02x', $c[0], $c[1], $c[2]);
}

function readable_on(array $bg, float $whiteMin = 3.5): array {
	$white = contrast_ratio($bg, [255, 255, 255]);
	$black = contrast_ratio($bg, [0, 0, 0]);
	return ($white >= $whiteMin || $white > $black) ? [255, 255, 255] : [0, 0, 0];
}

function team_style(?string $color, ?string $subcol): string {
	$main = hex_rgb($color)  ?? [248, 249, 250];
	$sub  = hex_rgb($subcol) ?? [33, 37, 41];

	$text   = readable_on($main);
	$stxt   = readable_on($sub);
	$accent = contrast_ratio($sub, $main) >= 3 ? $sub : $text;

	return '--team-color: ' . rgb_hex($main) . '; --team-color-sub: ' . rgb_hex($sub)
	     . '; --team-hover: ' . rgb_hex($sub) . '; --team-fg: ' . rgb_hex($text)
	     . '; --team-fg-sub: ' . rgb_hex($stxt) . '; --team-accent: ' . rgb_hex($accent) . ';';
}