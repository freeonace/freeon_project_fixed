<div class="layout">
	<div class="lg:container">
		<div class="d-flex flex-column gap-5">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a class="breadcrumb-link" href="<?= e(home_url()) ?>"><?= e(site('name')) ?>net</a>
					</li>
					<li class="breadcrumb-divider">/</li>
					<li class="breadcrumb-item">
						<a class="breadcrumb-link active" href="<?= url('database') ?>">Database</a>
					</li>
				</ol>
			</nav>
			<div class="database-header">
				<h1 class="database-title"><?= e(site('name')) ?> database in five parts.</h1>
				<span class="database-subtitle"><?= e(site('site')) ?> brings together the essential records of football in five dedicated collections. Explore each one to find the information you need, from team identities and player careers to fixtures, competitions, and transfers.</span>
			</div>

			<div class="database-border">
				<i class="fa-regular fa-futbol"></i>
			</div>

			<div class="database-grid">
				<a class="database-card" href="<?= url('database', 'teams') ?>">
					<div class="d-flex justify-content-between align-items-start gap-5">
						<div class="d-flex align-items-start gap-5">
							<span class="material-symbols-outlined db-sym">shield</span>
							<div class="d-flex flex-column">
								<span class="database-menu">Teams</span>
								<small class="fg-3">Team Database</small>
								<p class="lh-1 mt-3">Browse teams across all <?= e(site('name')) ?> leagues and competitions.</p>
							</div>
						</div>
						<span class="material-symbols-outlined arrow">arrow_outward</span>
					</div>
				</a>
				<a class="database-card" href="<?= url('database', 'players') ?>">
					<div class="d-flex justify-content-between align-items-start gap-5">
						<div class="d-flex align-items-start gap-5">
							<span class="material-symbols-outlined db-sym">person</span>
							<div class="d-flex flex-column">
								<span class="database-menu">Players</span>
								<small class="fg-3">Player Database</small>
								<p class="lh-1 mt-3">Discover players, profiles and career statistics across <?= e(site('name')) ?>.</p>
							</div>
						</div>
						<span class="material-symbols-outlined arrow">arrow_outward</span>
					</div>
				</a>
				<a class="database-card" href="<?= url('database', 'fixtures') ?>">
					<div class="d-flex justify-content-between align-items-start gap-5">
						<div class="d-flex align-items-start gap-5">
							<span class="material-symbols-outlined db-sym">sports_score</span>
							<div class="d-flex flex-column">
								<span class="database-menu">Fixtures</span>
								<small class="fg-3">Fixture Database</small>
								<p class="lh-1 mt-3">Explore upcoming fixtures and match results across <?= e(site('name')) ?> competitions.</p>
							</div>
						</div>
						<span class="material-symbols-outlined arrow">arrow_outward</span>
					</div>
				</a>
				<a class="database-card" href="<?= url('database', 'leagues') ?>">
					<div class="d-flex justify-content-between align-items-start gap-5">
						<div class="d-flex align-items-start gap-5">
							<span class="material-symbols-outlined db-sym">trophy</span>
							<div class="d-flex flex-column">
								<span class="database-menu">Leagues</span>
								<small class="fg-3">League Database</small>
								<p class="lh-1 mt-3">Discover <?= e(site('name')) ?> leagues, cups and competition records.</p>
							</div>
						</div>
						<span class="material-symbols-outlined arrow">arrow_outward</span>
					</div>
				</a>
				<a class="database-card" href="<?= url('database', 'transfers') ?>">
					<div class="d-flex justify-content-between align-items-start gap-5">
						<div class="d-flex align-items-start gap-5">
							<span class="material-symbols-outlined db-sym">handshake</span>
							<div class="d-flex flex-column">
								<span class="database-menu">Transfers</span>
								<small class="fg-3">Transfer Database</small>
								<p class="lh-1 mt-3">Follow player movements and transfer activity across <?= e(site('name')) ?> clubs.</p>
							</div>
						</div>
						<span class="material-symbols-outlined arrow">arrow_outward</span>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>