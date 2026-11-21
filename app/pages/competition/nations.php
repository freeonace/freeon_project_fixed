<?php // app/pages/competition/nations.php
comp_data('nations');
$cup = [
	'slug' => 'nations',
	'tabs' => ['index' => 'Home', 'matches' => 'Matches', 'standings' => 'Standings', 'teams' => 'Teams', 'stats' => 'Stats', 'news' => 'News'],
];
require __DIR__ . '/_cup.php';