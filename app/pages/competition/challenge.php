<?php // app/pages/competition/challenge.php
comp_data('challenge');
$cup = [
	'slug' => 'challenge',
	'tabs' => ['index' => 'Home', 'draw' => 'Draw', 'table' => 'Table', 'team-stats' => 'Team & Stats', 'history' => 'History', 'news' => 'News'],
];
require __DIR__ . '/_cup.php';