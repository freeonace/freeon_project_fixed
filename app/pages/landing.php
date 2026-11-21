<section class="landing">
	<div class="text-center d-flex flex-column">
		<div class="d-flex flex-column gap-3">
			<h1 class="text-4xl">Welcome to <span class="logo-brand" data-first="<?= e(site('name')) ?>" data-second="<?= e(site('site')) ?>" aria-label="<?= e(site('name')).e(site('site')) ?>"></span></h1>
			<span class="fg-2 fs-lg lh-1">The digital home of <?= e(site('conti')) ?> Football Universe.</span>
			<small class="fg-2 lh-1">Explore football database, competititon, and more.</small>
		</div>

		<div class="landing-border py-9">
			<i class="fa-regular fa-futbol"></i>
		</div>

		<div class="landing-menu">
		<?php foreach ($menu['sections'] as $key => $sec):
			if (!empty($sec['hidden'])) continue;
			$to  = $sec['url'] ?? $key;
			$group = $sec['group'] ?? $key;
			$subs  = $menu['groups'][$group] ?? [];
			$grp = $menu['sections'][$to]['group'] ?? $sec['group'] ?? '';
			$off = empty($menu['groups'][$grp]);
			$on  = !$off && ($to === $section); ?>
			<a class="menu-card<?= $off ? ' disabled' : '' ?>" <?= $off ? 'aria-disabled="true"' : 'href="' . url($to) . '"' ?>
			aria-label="<?= $off ? 'TBA' : '' . e($sec['name']) . '"' ?>">
				<span class="material-symbols-outlined symbol"><?= e($sec['icon']) ?></span>
				<span class="menu-name"><?= e($sec['name']) ?></span>
				<div class="menu-subs">
				<?php $totalSubs = count($subs); $i = 0; foreach ($subs as $subKey => $label): ?>
					<small class="fg-2"><?= e($label) ?><?= ++$i < $totalSubs ? ',' : '.' ?></small>
				<?php endforeach; ?>
				</div>
				<div class="menu-action">
					<?= $off ? '<div class="badge theme-secondary">Coming Soon</div>' : 'Explore <span class="material-symbols-outlined">arrow_right_alt</span>' ?>
				</div>
			</a>
		<?php endforeach; ?>
		</div>
	</div>
	<span class="badge theme-primary">Version <?= e(site('version')) ?></span>
</section>