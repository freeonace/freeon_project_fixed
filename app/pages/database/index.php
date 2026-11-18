<?php // variabel: $menu (dari menu.php) ?>
<?php
$site = site('name');
$meta = $menu['meta']['database'] ?? [];
?>
<div class="layout">
	<div class="lg:container">
		<div class="d-flex flex-column gap-5">
			<div class="database-header">
				<h1 class="database-title"><?= e(site('name')) ?> database in<br>
					<span class="database-title-b">six parts.</span>
				</h1>
				<span class="database-subtitle"><?= e(site('name')).e(site('site')) ?> brings together the essential records of football in six dedicated collections. Explore each one to find the information you need, from team identities and player careers to fixtures, competitions,  transfers, and coaches.</span>
			</div>

			<div class="database-border">
				<i class="fa-regular fa-futbol"></i>
			</div>

			<div class="database-grid">
			<?php foreach ($menu['groups']['database'] as $key => $label):
				$c     = $meta[$key] ?? [];
				$title = $c['title'] ?? $label;
				$icon  = $c['icon']  ?? 'database';
				$sub   = $c['sub']   ?? "$label Database";
				$desc  = str_replace('{site}', $site, $c['desc'] ?? '');
			?>
				<a class="database-card" href="<?= e(url('database', $key)) ?>">
					<div class="d-flex justify-content-between align-items-start gap-5">
						<div class="d-flex align-items-start gap-5">
							<span class="material-symbols-outlined db-sym"><?= e($icon) ?></span>
							<div class="d-flex flex-column">
								<span class="database-menu"><?= e($title) ?></span>
								<small class="fg-3"><?= e($sub) ?></small>
								<?php if ($desc !== ''): ?>
									<p class="lh-1 mt-3"><?= e($desc) ?></p>
								<?php endif; ?>
							</div>
						</div>
						<span class="material-symbols-outlined arrow">arrow_outward</span>
					</div>
				</a>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>