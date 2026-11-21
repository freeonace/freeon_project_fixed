<?php
$tabs = $cup['tabs'];
$tab  = $_GET['tab'] ?? 'index';
$file = (is_string($tab) && isset($tabs[$tab])) ? cup_tab_file($cup['slug'], $tab) : null;

cup_nav(compact('cup', 'tab'));

if ($file === null) {
	http_response_code(404);
	page_title('Not found');
	require APP . '/pages/errors/404.php';
	return;
}

page_title($menu['groups']['competition'][$cup['slug']] . ($tab === 'index' ? '' : ' - ' . $tabs[$tab]));
require $file;