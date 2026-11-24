<?php
function assocs_url(int $id, ?string $alt = null, ?string $tab = null): string {
	$u = url('home', 'association') . '/' . $id . '/' . (slugify($alt) ?: 'association');
	return $tab ? $u . '/' . $tab : $u;
}

function assocs_team_url(int $assocId, ?string $short, int $teamId, ?string $alt = null, ?string $name = null): string {
	return assocs_url($assocId, $short) . '/national/' . $teamId . '/' . team_slug($alt, $name);
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