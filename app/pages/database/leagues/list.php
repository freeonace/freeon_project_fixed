<?php
$topIds   = [10, 11, 12, 13, 16];
$fallback = BASE_URL . '/asset/img/team/default.png';

$found = leagues_by_ids($topIds);
$topCards = [];
foreach ($topIds as $id) {
	if (isset($found[$id])) $topCards[] = [$found[$id], league_url($id, $found[$id]['alt'])];
}

$groups = [];
foreach (leagues_by_entity() as $rows) {
	$items = [];
	foreach ($rows as $c) {
		if (!isset($found[$c['id']])) $items[] = [$c, league_url($c['id'], $c['alt'])];
	}
	if ($items) $groups[] = [$rows[0]['entity'], $items];
}
?>
<section class="leagues">
	<div class="lg:container">
		<div class="d-flex flex-column gap-7">
			<div class="d-flex flex-column">
				<h1 class="fs-xl fw-semibold">League Database</h1>
				<span class="fg-2">Explore <?= e(site('name')) ?>'s league divisions from top tier to regional competitions across <?= e(site('conti')) ?>.</span>
			</div>

			<div class="d-flex flex-column gap-7">
				<div class="d-flex flex-column gap-3">
					<span class="fw-semibold fs-lg">Top-5 Leagues</span>
					<div class="top-list">
					<?php foreach ($topCards as [$c, $href]): compact('c', 'href', 'fallback'); ?>
						<a class="card" href="<?= e($href) ?>">
							<div class="card-body"></div>
							<div class="card-footer"><?= e($c['name']) ?></div>
						</a>
					<?php endforeach; ?>
					</div>
				</div>
				<div class="d-flex flex-column gap-3">
					<span class="fw-semibold fs-lg">Other Leagues</span>
					<ul class="list-group list-group-flush">
						<?php foreach ($groups as [$entity, $items]): ?>
						<li class="list-group-item">
							<div class="league-grid">
								<div class="d-flex align-items-center gap-3">
									<img src="...">
									<span><?= e($entity) ?></span>
								</div>
								<div class="d-flex flex-wrap align-items-center gap-3">
								<?php foreach ($items as [$c, $href]): ?>
									<a role="button" class="btn btn-sm <?= e(slugify($c['alt'])) ?>" href="<?= e($href) ?>" style="<?= e(league_style($c['color'], $c['subcol'])) ?>">
										<div class="d-flex align-items-center gap-3">
											<img src="...">
											<span><?= e($c['name']) ?></span>
										</div>
									</a>
								<?php endforeach; ?>
								</div>
							</div>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>