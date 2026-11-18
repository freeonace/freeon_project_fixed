<?php // variabel: $menu (dari menu.php) ?>
<?php
$meta = $menu['meta']['competition'] ?? [];
?>
<div class="layout">
	<div class="lg:container">
		<div class="d-flex flex-column gap-5">
			<div class="competition-header">
				<h1 class="competition-title"><?= e(site('name')) ?> Four competitions. <br>
					<span class="competition-title-b">One football system.</span>
				</h1>
				<span class="competition-subtitle">Explore the national and continental club tournaments organized under <?= e(site('name')) ?>.</span>
			</div>

			<div class="competition-grid">
			<?php foreach ($menu['groups']['competition'] as $key => $label):
				$t     = $meta[$key] ?? [];
				$title = $t['title'] ?? $label;
				$id    = $t['id']  ?? 0;
				$tier  = $t['tier']  ?? $label;
				$var   = $t['var'] ?? '000';
			?>
				<a class="competition-card <?= slugify($label) ?>" href="<?= e(url('competition', $key)) ?>" style="--comp-var: #<?= e($var) ?>;">
					<div class="competition-card-body">
						<div class="comp-desc">
							<div class="d-flex flex-column">
								<div class="d-flex flex-wrap justify-content-between align-items-start column-gap-5">
									<div class="d-flex flex-column" style="margin-bottom: .75rem;">
										<span class="comp-title"><?= e($title) ?></span>
										<span class="comp-sub"><?= e($tier) ?></span>
									</div>
									<span class="material-symbols-outlined">arrow_outward</span>
								</div>
							</div>
						</div>
					</div>
					<div class="competition-card-footer">
						<div class="comp-footer">
							<span>Explore <?= e($label) ?></span>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>