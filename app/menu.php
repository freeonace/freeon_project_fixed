<?php
return [
	'sections'	=> [
		'home'			=> ['label' => 'HOME', 'name' => 'Home', 'icon' => 'home', 'group' => 'home'],

		'competition'	=> ['label' => 'COMPETITION', 'name' => 'Competition','icon' => 'sports_soccer' , 'group' => 'competition'],

		'database'		=> ['label' => 'DATABASE', 'name' => 'Database', 'icon' => 'database', 'group' => 'database'],

		'shop'			=> ['label' => 'SHOP', 'name' => 'Shop', 'icon' => 'shopping_bag', 'group' => 'shop'],

		// Users
		'account'	=> ['label' => 'ACCOUNT', 'name' => 'Account', 'icon' => 'person', 'group' => 'account', 'hidden' => true],
		'admin'		=> ['label' => 'ADMIN', 'name' => 'Admin', 'icon' => 'fa-user-shield', 'group' => 'admin', 'hidden' => true],

	],
	'groups' => [
		'home'			=> [
			'about' => 'About', 'association' => 'Association', 'news' => 'News'
		],
		'competition'	=> [
			'nations-cup' => 'Nations Cup', 'continental-cup' => 'Continental Cup', 'challenge-cup' => 'Challenge Cup', 'champions-cup' => 'Champions Cup',
		],
		'database'	=> [
			'teams' => 'Teams', 'players' => 'Players', 'fixtures' => 'Fixtures', 'leagues' => 'Leagues', 'transfers' => 'Transfers', 'coaches' => 'Coaches',
		],
		'shop'			=> [],

		// Users
		'account'	=> ['signin' => 'Sign In', 'signup' => 'Sign Up', 'signout' => 'Sign Out', 'icon' => 'Change Icon'],
		'admin'		=> [],
	],

	'meta' => [
		'competition' => [
			'nations-cup'		=> ['id' => 5, 'title' => 'SFC Nations Cup',     'tier' => 'National Major Competition', 'var' => '2457C5'],
			'continental-cup'	=> ['id' => 1, 'title' => 'SFC Continental Cup', 'tier' => '1-Tier Major Competition',   'var' => '6245C5'],
			'challenge-cup'		=> ['id' => 2, 'title' => 'SFC Challenge Cup',   'tier' => '2-Tier Major Competition',   'var' => '657D2D'],
			'champions-cup'		=> ['id' => 3, 'title' => 'SFC Champions Cup',   'tier' => 'Honour Major Competition',   'var' => '699BB1'],
		],

		'database' => [
			'teams'     => ['icon' => 'shield',       'title' => 'Teams',     'sub' => 'Team Database',     'desc' => 'Browse teams across all {site} leagues and competitions.'],
			'players'   => ['icon' => 'person',       'title' => 'Players',   'sub' => 'Player Database',   'desc' => 'Discover players, profiles and career statistics across {site}.'],
			'fixtures'  => ['icon' => 'sports_score', 'title' => 'Fixtures',  'sub' => 'Fixture Database',  'desc' => 'Explore upcoming fixtures and match results across {site} competitions.'],
			'leagues'   => ['icon' => 'trophy',       'title' => 'Leagues',   'sub' => 'League Database',   'desc' => 'Discover {site} leagues, cups and competition records.'],
			'transfers' => ['icon' => 'handshake',    'title' => 'Transfers', 'sub' => 'Transfer Database', 'desc' => 'Follow player movements and transfer activity across {site} clubs.'],
			'coaches'   => ['icon' => 'productivity', 'title' => 'Coaches',   'sub' => 'Coach Database',    'desc' => ''],
		],
	],
	
	'args' => [
		'database/league'		=> 3,
		'database/team'			=> 3,
		'database/player'		=> 3,
		'database/coach'		=> 3,
		'database/fixture'		=> 4,
	],

	// Perubahan menu saat admin login (lihat menu_for_user() di data/users.php).
	//   replace: timpa tampilan section; 'url' = section tujuan link (key section tetap, jadi alamat publiknya tidak berubah)
	//   hide:    section yang disembunyikan dari sidebar, mis. ['world-cup']
	//   groups:  sub-menu suatu group, mis. 'admin' => ['teams' => 'Teams'] (butuh pages/admin/teams.php)
	'admin_menu' => [
		'add' => [
			'admin-team'   => ['label' => 'TEAMS',   'name' => 'Teams',   'icon' => 'fa-shield-halved', 'group' => 'admin-team'],

			'admin-player' => ['label' => 'PLAYERS', 'name' => 'Players', 'icon' => 'fa-user-gear', 'group' => 'admin-player'],

			'admin-fixture' => ['label' => 'FIXTURES', 'name' => 'Fixtures', 'icon' => 'fa-calendar', 'group' => 'admin-fixture'],

			'admin-competition' => ['label' => 'COMPETITIONS', 'name' => 'Competitions', 'icon' => 'fa-people-group', 'group' => 'admin-competition'],

			'admin-transfer' => ['label' => 'TRANSFERS', 'name' => 'Transfers', 'icon' => 'fa-handshake', 'group' => 'admin-transfer'],
		],
		'replace' => [
			'home' => ['label' => 'ADMIN', 'name' => 'Admin', 'icon' => 'fa-user-group', 'url' => 'admin'],
		],
		'hide'    => ['competition', 'home', 'shop', 'database'],
		'groups'  => [
			'admin' => [
				'dashboard' => 'Dashboard', 'users' => 'Users', 'chat' => 'Chat',
			],
		],
	],
];