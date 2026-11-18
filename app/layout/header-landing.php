<header class="sticky-top nav-home">
	<nav class="navbar">
		<div class="lg:container">
			<a class="navbar-brand" data-first="<?= e(site('name')) ?>" data-second="<?= e(site('site')) ?>" aria-label="<?= e(site('name')) ?><?= e(site('site')) ?>" href="<?= e(home_url()) ?>"></a>
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
</header>