<?php
require __DIR__ . '/app/bs.php';
require APP . '/router.php';

//$menu  = require APP . '/menu.php';
//$route = resolve($menu, $_GET['route'] ?? '');

$menu  = menu_for_user(require APP . '/menu.php');
$uri   = trim($_GET['route'] ?? '', '/');

if ($uri === '') {
	$route = [
		'section'	=> 'landing', 'page' => null, 'group' => null,
		'file'		=> APP . '/pages/landing.php', 'title' => 'Confederation of Southernia Football Official Websites',
		'landing'	=> true,
	];
} else {
	$route = resolve($menu, $uri);
}

if ($route === null) {
	http_response_code(404);
	$route = [
		'section' => 'landing', 'page' => null, 'group' => null,
		'file' => APP . '/pages/errors/404.php', 'title' => 'Not found',
	];
}

$section = $route['section'];
$page    = $route['page'];
$title   = $route['title'];
$subs    = $route['group'] ? $menu['groups'][$route['group']] : [];   // landing: tanpa sub-nav

$args    = $route['args'] ?? [];
$content = render_page($route['file'], compact('menu', 'section', 'page', 'args'));

require APP . '/layout/main.php';