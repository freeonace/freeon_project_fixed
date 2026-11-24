<?php
$cards = [];
foreach (associations_all() as $a) {
	$cards[] = [$a, assocs_url((int)$a['id'], $a['short'])];
}
?>
<div class="layout">
	<div class="lg:container">
		<div class="assocs-grid">
		<?php foreach ($cards as [$a, $href]): ?>
			<a class="assocs" href="<?= e($href) ?>" title="<?= e($a['name']) ?>">
				<div class="assocs-card">
					<img class="assocs-img" src="..." alt="">
					<div class="assocs-reg"><img src="..." alt=""></div>
				</div>
				<span><?= e($a['region']) ?></span>
			</a>
		<?php endforeach; ?>
		</div>
	</div>
</div>