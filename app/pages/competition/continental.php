<?php // app/pages/competition/continental.php
comp_data('continental');
$cup = [
	'slug' => 'continental',
	'tabs' => ['index' => 'Home', 'draw' => 'Draw', 'table' => 'Table', 'team-stats' => 'Team & Stats', 'history' => 'History', 'news' => 'News'],
];
require __DIR__ . '/_cup.php';