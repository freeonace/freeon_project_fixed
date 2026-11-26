<?php
define('APP', __DIR__);
define('BASE_URL', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'));
require __DIR__ . '/db.php';
require __DIR__ . '/data/users.php';
require __DIR__ . '/data/associations.php';
require __DIR__ . '/data/teams.php';
require __DIR__ . '/data/leagues.php';
require __DIR__ . '/data/competitions.php';

function component(string $name, array $vars = []): void {
	$file = APP . '/components/' . $name . '.php';
	if (!is_file($file)) {
		echo "<!-- components/$name.php not found -->";
		return;
	}
	extract($vars, EXTR_SKIP);
	require $file;
}

function partial(string $name): void {
	$file = APP . '/layout/' . $name . '.php';
	if (!is_file($file)) {
		echo "<!-- layout/$name.php not found -->";
		return;
	}
	require $file;
}

function e(?string $s): string {
	return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
}

function url(string $section = '', ?string $page = null): string {
	return BASE_URL . '/' . ltrim($section . ($page ? "/$page" : ''), '/');
}

function asset(string $path): string {
	$file = dirname(APP) . '/asset/' . $path;
	$v = is_file($file) ? filemtime($file) : 0;
	return BASE_URL . '/asset/' . $path . '?v=' . $v;
}

function render_page(string $file, array $vars): string {
	extract($vars, EXTR_SKIP);
	ob_start();
	require $file;
	return ob_get_clean();
}

$GLOBALS['config'] = require __DIR__ . '/config.php';

function nav_items(array $menu, string $section, ?string $page): array {
	$items = [];

	if (cup_nav() !== null) {
		foreach ($menu['groups']['competition'] ?? [] as $key => $label) {
			$items[] = ['href' => url('competition', $key), 'name' => $label,
						'icon' => $menu['meta']['competition'][$key]['icon'] ?? 'trophy',
						'on' => $key === $page, 'off' => false, 'cur' => 'page'];
		}
		return $items;
	}

	foreach ($menu['sections'] as $key => $sec) {
		if (!empty($sec['hidden'])) continue;
		$to  = $sec['url'] ?? $key;
		$grp = $menu['sections'][$to]['group'] ?? $sec['group'] ?? '';
		$off = empty($menu['groups'][$grp]);
		$items[] = ['href' => url($to), 'name' => $sec['name'], 'icon' => $sec['icon'] ?? '',
					'on' => !$off && $to === $section, 'off' => $off, 'cur' => $page === null ? 'page' : 'true'];
	}
	return $items;
}

function site(string $key): string {
	return (string) ($GLOBALS['config'][$key] ?? '');
}

function slugify(?string $s): string {
	$s = strtolower(trim((string)$s));
	return trim(preg_replace('/[^a-z0-9]+/', '-', $s), '-');
}

function page_title(?string $set = null): ?string {
	static $t = null;
	if ($set !== null) $t = $set;
	return $t;
}

function comp_data(?string $set = null): ?string {
	static $t = null;
	if ($set !== null) $t = $set;
	return $t;
}

function cup_nav(?array $set = null): ?array {
	static $t = null;
	if ($set !== null) $t = $set;
	return $t;
}

function team_logo(int $id): string {
	return BASE_URL . '/asset/img/team/id_' . sprintf('%05d', $id) . '.png';
}

function league_img(int $id): string {
	return BASE_URL . '/asset/img/comp/ic_' . sprintf('%04d', $id) . '_a.png';
}

function nation_fg(int $id): string {
	return BASE_URL . '/asset/img/flag/in_' . sprintf('%03d', $id) . '.png';
}

function assocs_logo(int $id): string {
	return BASE_URL . '/asset/img/assocs/ia_' . sprintf('%02d', $id) . '.png';
}

function hex_rgb(?string $c): ?array {
	$c = ltrim(trim((string)$c), '#');
	if (strlen($c) === 3) $c = $c[0] . $c[0] . $c[1] . $c[1] . $c[2] . $c[2];
	if (strlen($c) === 8) $c = substr($c, 0, 6);
	if (!preg_match('/^[0-9a-f]{6}$/i', $c)) return null;
	return [hexdec(substr($c, 0, 2)), hexdec(substr($c, 2, 2)), hexdec(substr($c, 4, 2))];
}

function rel_luminance(array $rgb): float {
	$f = static function ($v) {
		$v /= 255;
		return $v <= 0.03928 ? $v / 12.92 : (($v + 0.055) / 1.055) ** 2.4;
	};
	return 0.2126 * $f($rgb[0]) + 0.7152 * $f($rgb[1]) + 0.0722 * $f($rgb[2]);
}

function contrast_ratio(array $a, array $b): float {
	$la = rel_luminance($a);
	$lb = rel_luminance($b);
	return (max($la, $lb) + 0.05) / (min($la, $lb) + 0.05);
}

function rgb_hex(array $c): string {
	return sprintf('#%02x%02x%02x', $c[0], $c[1], $c[2]);
}

function readable_on(array $bg, float $whiteMin = 3.5): array {
	$white = contrast_ratio($bg, [255, 255, 255]);
	$black = contrast_ratio($bg, [0, 0, 0]);
	return ($white >= $whiteMin || $white > $black) ? [255, 255, 255] : [0, 0, 0];
}

function color_style(?string $color, ?string $subcol, string $prefix): string {
	$main = hex_rgb($color)  ?? [248, 249, 250];
	$sub  = hex_rgb($subcol) ?? [33, 37, 41];

	$text   = readable_on($main);
	$stxt   = readable_on($sub);
	$accent = contrast_ratio($sub, $main) >= 3 ? $sub : $text;

	$vars = [
		'color'     => $main,
		'color-sub' => $sub,
		'hover'     => $sub,
		'fg'        => $text,
		'fg-sub'    => $stxt,
		'accent'    => $accent,
	];
	$css = '';
	foreach ($vars as $k => $rgb) $css .= "--$prefix-$k: " . rgb_hex($rgb) . '; ';
	return rtrim($css);
}