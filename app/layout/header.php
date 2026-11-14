<header class="sticky-top shadow-lg">
	<nav class="navbar">
		<div class="lg:container">
			<a class="navbar-brand" data-first="<?= e(site('name')) ?>" data-second="net" aria-label="CSFnet" href="<?= e(home_url()) ?>"></a>
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
						<?= $off ? 'aria-disabled="true" tabindex="-1"' : 'href="' . url($to) . '"' ?>><?= e($sec['name']) ?></a>
					</li>
				<?php endforeach ?>
				</ul>
			</div>
			<div class="nav-tools">
				<button type="button" class="btn-menu btn-search">
					<span class="material-symbols-outlined">search</span>
				</button>

				<button type="button" class="btn-menu btn-setting" aria-label="Themes" data-bs-toggle="drawer" data-bs-target="#menuSettings" aria-controls="menuSettings">
					<span class="material-symbols-outlined">settings</span>
				</button>

				<button type="button" class="btn-sm btn-outline theme-primary rounded-pill">
					<div class="d-flex align-items-center gap-3">
						<span>Log In</span>
						<span class="material-symbols-outlined">account_circle</span>
					</div>
				</button>
			</div>
		</div>
	</nav>
	<?php if ($subs && (empty($menu['sections'][$section]['hidden']) || $section === 'admin')): ?>
	<div class="nav-sub">
		<div class="lg:container">
			<div class="nav-overflow" data-bs-toggle="nav-overflow">
				<ul class="nav">
					<?php foreach ($subs as $key => $label): $on = ($key === $page); ?>
					<li class="nav-item">
						<a class="nav-link<?= $on ? ' active' : '' ?>"
							<?= $on ? 'aria-current="page"' : '' ?>
							href="<?= url($section, $key) ?>"
							title="<?= e($label) ?>"><?= e($label) ?>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<?php endif; ?>
</header>