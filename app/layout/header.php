<header class="sticky-top" style="z-index: 2000;">
	<nav class="navbar">
		<div class="lg:container">
			<a class="navbar-brand" data-first="<?= e(site('name')) ?>" data-second="<?= e(comp_data() ?? site('site')) ?>" aria-label="<?= e(site('name')).e(comp_data() ?? site('site')) ?>" href="<?= e(home_url()) ?>" style="max-width: 45%;"></a>
			<div>
				<ul class="nav nav-underline">
				<?php foreach ($menu['sections'] as $key => $sec):
					if (!empty($sec['hidden'])) continue;
					$to  = $sec['url'] ?? $key;
					$grp = $menu['sections'][$to]['group'] ?? $sec['group'] ?? '';
					$off = empty($menu['groups'][$grp]);
					$on  = !$off && ($to === $section); ?>
					<li class="nav-item">
						<a class="nav-link<?= $on ? ' active' : '' ?><?= $off ? ' disabled' : '' ?>"
						<?= $on ? 'aria-current="' . ($page === null ? 'page' : 'true') . '"' : '' ?>
						<?= $off ? 'aria-disabled="true" tabindex="-1"' : 'href="' . url($to) . '"' ?> aria-label="<?= e($sec['name']) ?>"><?= e($sec['name']) ?></a>
					</li>
				<?php endforeach ?>
				</ul>
			</div>
			<div class="nav-tools">
				<button type="button" class="btn-menu btn-search" data-bs-toggle="dialog" data-bs-target="#searchDialog">
					<span class="material-symbols-outlined">search</span>
				</button>

				<button type="button" class="btn-menu btn-setting" aria-label="Themes" data-bs-toggle="drawer" data-bs-target="#menuSettings" aria-controls="menuSettings">
					<span class="material-symbols-outlined">settings</span>
				</button>

				<button type="button" class="btn-sm btn-outline theme-primary rounded-pill btn-user">
					<div class="d-flex align-items-center gap-3">
						<span>Log In</span>
						<span class="material-symbols-outlined">account_circle</span>
					</div>
				</button>
				<button type="button" class="btn-menu btn-user">
					<span class="material-symbols-outlined">account_circle</span>
				</button>
			</div>
		</div>
	</nav>
	<?php
	$cupNav		= cup_nav();
	$hideSubs	= ($section === 'competition' && $page !== null);
	?>
	<?php if ($cupNav !== null): ?>
		<?php component('cup-tabs', $cupNav); ?>
	<?php elseif ($subs && (empty($menu['sections'][$section]['hidden']) || $section === 'admin')): ?>
	<div class="nav-sub">
		<div class="lg:container">
			<div class="nav-overflow" data-bs-toggle="nav-overflow">
				<ul class="nav">
					<?php foreach ($subs as $key => $label): $on = ($key === $page); ?>
					<li class="nav-item">
						<a class="nav-link<?= $on ? ' active' : '' ?>"
							<?= $on ? 'aria-current="page"' : '' ?>
							href="<?= url($section, $key) ?>"
							aria-label="<?= e($label) ?>"><?= e($label) ?>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<?php endif; ?>
</header>