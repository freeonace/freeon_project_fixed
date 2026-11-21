<?php
function cup_tab_file(string $slug, string $tab): ?string {
	$base = APP . '/pages/competition';
	$candidates = $tab === 'index'
		? ["$base/$slug/index.php"]
		: ["$base/$slug/tabs/$tab.php", "$base/_shared/tabs/$tab.php"];
	foreach ($candidates as $f) {
		if (is_file($f)) return $f;
	}
	return null;
}

function cup_url(string $slug, string $tab = 'index', array $query = []): string {
	if ($tab !== 'index') $query = ['tab' => $tab] + $query;
	return url('competition', $slug) . ($query ? '?' . http_build_query($query) : '');
}