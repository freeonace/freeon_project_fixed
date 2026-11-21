<div class="nav-sub">
	<div class="lg:container">
		<div class="nav-overflow" data-bs-toggle="nav-overflow">
			<ul class="nav" aria-label="Competition tabs">
				<?php foreach ($cup['tabs'] as $key => $label): ?>
				<li class="nav-item">
					<a class="nav-link<?= $key === $tab ? ' active' : '' ?>" href="<?= e(cup_url($cup['slug'], $key)) ?>"><?= e($label) ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>