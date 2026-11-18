<?php // app/layout/main.php ?>
<!DOCTYPE html>
<html lang="en" data-page-theme="<?= e(page_theme()) ?>">
<head>
	<?php require __DIR__ . '/head.php'; ?>
</head>
<body<?= !empty($route['landing']) ? ' class="home-page"' : '' ?>>
	<?php if (is_admin()): ?>
		<?php require __DIR__ . '/admin.php'; ?>
	<?php else: ?>
	<?php require __DIR__ . (empty($route['landing']) ? '/header.php' : '/header-landing.php'); ?>
	<dialog class="drawer drawer-end drawer-instant drawer-translucent" tabindex="-1" id="menuSettings" aria-labelledby="menuSettingsLabel">
		<div class="drawer-header border-bottom">
			<h5 class="drawer-title" id="menuSettingsLabel">Menu Settings</h5>
			<button type="button" class="btn-close" data-bs-dismiss="drawer" aria-label="Close"></button>
		</div>
		<div class="drawer-body">
			<div class="setting-menu">
				<div class="setting-list" aria-label="Themes">
					<small class="muted-text">Theme</small>
					<div class="setting-item setting-row">
						<a class="theme-select" data-theme-value="light">Light <span class="material-symbols-outlined">light_mode</span></a>
						<a class="theme-select" data-theme-value="dark">Dark <span class="material-symbols-outlined">dark_mode</span></a>
						<a class="theme-select" data-theme-value="system">System <span class="material-symbols-outlined">computer</span></a>
					</div>
				</div>
				<div class="setting-list">
					<small class="muted-text">Measurment System</small>
				</div>
			</div>
		</div>
		<div class="drawer-footer">
			<small class="nav-version">
				<span class="nav-full">Version <?= e(site('version')) ?></span>
				<span class="nav-short">v<?= e(site('version')) ?></span>
			</small>
		</div>
	</dialog>
	<main data-page-theme="<?= e($pageTheme ?? 'main') ?>"><?= $content ?></main>
	<button id="btnBackToTop" class="btn-top" title="Back to top">
		<span class="material-symbols-outlined">keyboard_double_arrow_up</span>
	</button>
	<?php require __DIR__ . '/footer.php'; ?>
	<?php endif; ?>
	<?php require __DIR__ . '/scripts.php'; ?>
</body>
</html>