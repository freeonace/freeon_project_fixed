<?php // app/pages/competition/champions.php
comp_data('champions');
$cup = [
	'slug' => 'champions',
	'tabs' => ['index' => 'Home', 'matches' => 'Matches', 'history' => 'History', 'news' => 'News', 'about' => 'About'],
];
require __DIR__ . '/_cup.php';