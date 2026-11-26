<dialog class="dialog dialog-lg" id="searchDialog">
	<div class="dialog-header">
		<h1 class="dialog-title">Search</h1>
		<button type="button" class="btn-close" data-bs-dismiss="dialog" aria-label="Close"></button>
	</div>
	<div class="dialog-body"></div>
	<div class="dialog-footer">
		<button type="button" class="btn-solid theme-secondary" data-bs-dismiss="dialog">Close</button>
		<button type="button" class="btn-solid theme-primary">Save changes</button>
	</div>
</dialog>
<footer>
	<div class="lg:container">
		<div class="py-9">
			<div class="d-flex flex-column gap-9">
				<div class="d-flex flex-wrap justify-content-between align-items-center gap-5">
					<div class="d-flex flex-column">
						<a class="footer-brand" data-first="<?= e(site('name')) ?>" data-second="<?= e(comp_data() ?? site('site')) ?>" aria-label="<?= e(site('name')).e(comp_data() ?? site('site')) ?>" href="<?= e(home_url()) ?>"style="font-size: 2.5rem;"></a>
						<small><?= e(site('assoc')) ?> &middot; Official Website</small>
					</div>
					<div class="footer-social">
						<i class="fa-brands fa-instagram"></i>
						<i class="fa-brands fa-youtube"></i>
						<i class="fa-brands fa-facebook"></i>
						<i class="fa-brands fa-square-x-twitter"></i>
					</div>
				</div>
				<div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
					<small><b>&copy;<?= site('since') ?>&ndash;<?= date('Y') ?> <?= e(site('name')).e(site('site')) ?></b>. All rights reserved.</small>
					<small class="d-flex align-items-center gap-4">
						<a href="<?= url('home') ?>">Home</a>
						<a href="<?= url('competition') ?>">Competition</a>
						<a href="<?= url('database') ?>">Database</a>
					</small>
				</div>
			</div>
		</div>
	</div>
</footer>
<div class="sticky-bottom">
	<div class="nav-bottom">
		<div class="nav-medium">
		<?php foreach (nav_items($menu, $section, $page) as $it): ?>
		<a class="navbottom-btn<?= $it['on'] ? ' active' : '' ?><?= $it['off'] ? ' disabled' : '' ?>" <?= $it['on'] ? 'aria-current="' . $it['cur'] . '"' : '' ?><?= $it['off'] ? 'aria-disabled="true" tabindex="-1"' : 'href="' . e($it['href']) . '"' ?>>
			<div class="navbottom-item">
				<span class="material-symbols-rounded"><?= e($it['icon']) ?></span>
				<small class="navbottom-link"><?= e($it['name']) ?></small>
			</div>
		</a>
		<?php endforeach; ?>
		</div>
	</div>
</div>