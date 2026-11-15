<?php
return [
	'sections'	=> [
		'home'			=> ['label' => 'HOME', 'name' => 'Home', 'icon' => 'home', 'group' => 'home'],

		'competition'	=> ['label' => 'COMPETITION', 'name' => 'Competition' ,'icon' => 'sports_soccer' , 'group' => 'competition'],

		'database'		=> ['label' => 'DATABASE', 'name' => 'Database' , 'icon' => 'database', 'group' => 'database'],

		'shop'			=> ['label' => 'SHOP', 'name' => 'Shop' , 'icon' => 'shopping_bag', 'group' => 'shop'],

		// Users
		'account'	=> ['label' => 'ACCOUNT', 'name' => 'Account', 'icon' => 'person', 'group' => 'account', 'hidden' => true],
		'admin'		=> ['label' => 'ADMIN', 'name' => 'Admin', 'icon' => 'fa-user-shield', 'group' => 'admin', 'hidden' => true],

	],
	'groups' => [
		'home'			=> [
			'about' => 'About', 'association' => 'Association', 'news' => 'News'
		],
		'competition'	=> [
			'world-cup' => 'World Cup', 'csf-sl' => 'CSF Super League', 'csf-c' => 'CSF Cup', 'csf-sc' => 'CSF Super Cup',
		],
		'database'	=> [
			'teams' => 'Teams', 'players' => 'Players',
			'fixtures' => 'Fixtures', 'leagues' => 'Leagues', 'transfers' => 'Transfers',
		],
		'shop'			=> [],

		// Users
		'account'	=> ['signin' => 'Sign In', 'signup' => 'Sign Up', 'signout' => 'Sign Out', 'icon' => 'Change Icon'],
		'admin'		=> [],
	],
	
	'args' => [
		'database/competition'	=> 3,
		'database/team'			=> 3,
		'database/player'		=> 3,
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
		'hide'    => ['world-cup', 'csf-sl', 'csf-c', 'csf-sc', 'database'],
		'groups'  => [
			'admin' => [
				'dashboard' => 'Dashboard', 'users' => 'Users', 'chat' => 'Chat',
			],
		],
	],
];