<?php
const NATIONAL_ENTITY = 1;

function assocs_slug(?string $short): string {
	return slugify($short) ?: 'association';   // pakai juga di assocs_url()
}

function assocs_url(int $id, ?string $alt = null, ?string $tab = null): string {
	$u = url('home', 'association') . '/' . $id . '/' . (slugify($alt) ?: 'association');
	return $tab ? $u . '/' . $tab : $u;
}

function assocs_team_url(int $assocId, ?string $short, int $teamId, ?string $alt = null, ?string $name = null): string {
	return assocs_url($assocId, $short) . '/national/' . $teamId . '/' . team_slug($alt, $name);
}

function association_by_id(int $id): ?array {
	$st = db()->prepare(
		'SELECT a.assocsID AS id, a.assocsName AS name, a.assocsShort AS short, a.assocsEst AS est,
		        a.assocsCol AS color, a.assocsSub AS subcol,
		        a.assocsRegion AS region_id, r.regionName AS region
		 FROM association a
		 JOIN region r ON r.regionID = a.assocsRegion
		 WHERE a.assocsID = :id'
	);
	$st->execute(['id' => $id]);
	return $st->fetch() ?: null;
}

function association_by_region(int $regionId): ?array {
	$st = db()->prepare(
		'SELECT assocsID AS id, assocsName AS name, assocsShort AS short
		 FROM association WHERE assocsRegion = :r ORDER BY assocsID LIMIT 1'
	);
	$st->execute(['r' => $regionId]);
	return $st->fetch() ?: null;
}

function associations_all(): array {
	return db()->query(
		"SELECT a.assocsID AS id, a.assocsName AS name, a.assocsShort AS short,
		        a.assocsRegion AS region_id, r.regionName AS region
		 FROM association a
		 JOIN region r ON r.regionID = a.assocsRegion
		 WHERE a.assocsID <> 1
		 ORDER BY r.regionName, a.assocsName"
	)->fetchAll();
}

function association_national_teams(array $assoc): array {
	$st = db()->prepare(
		'SELECT teamID AS id, teamName AS name, teamShort AS short, teamAlt AS alt,
		        teamColor AS color, teamSubCol AS subcol
		 FROM team WHERE teamEntity = :e AND teamRegion = :r ORDER BY teamName'
	);
	$st->execute(['e' => NATIONAL_ENTITY, 'r' => $assoc['region_id']]);
	return $st->fetchAll();
}

// Satu tim nasional milik asosiasi ini, atau null
function national_team_of(array $assoc, int $teamId): ?array {
	foreach (association_national_teams($assoc) as $t) {
		if ((int)$t['id'] === $teamId) return $t;
	}
	return null;
}

function assocs_style(?string $color, ?string $subcol): string {
	return color_style($color, $subcol, 'assocs');
}