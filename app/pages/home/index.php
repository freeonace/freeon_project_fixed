<div class="d-flex flex-column">
	<div class="layout">
		<div class="lg:container">
			<div class="d-flex flex-column gap-9">
				<div class="home-header">
					<div class="home-body">
						<h1 class="home-title">Stories, dates,<br>
							<span class="home-title-b">and developments.</span>
						</h1>
						<span class="home-subtitle">A selection of stories, perspectives and official information about <?= e(site('name')) ?> from the football community.</span>
					</div>
					<div class="home-date">
						<span class="home-day"><?php echo date('F j'); ?>,</span>
						<span class="home-year"><?php echo date('Y'); ?></span>
					</div>
				</div>

				<div class="row gy-5 gx-5">
					<div class="col-12 md:col-7">
						<div class="d-flex flex-column gap-4">
							<div class="news-card"></div>
							<div class="d-flex flex-column">
								<span>FEATURED</span>
								<span>Building a connected football community across sixteen nations.</span>
								<span>A closer look at the people, associations and ideas shaping the next chapter of football in Southernia.</span>
							</div>
						</div>
					</div>

					<div class="col-12 md:col-5">
						<ul class="news-list">
							<li class="news-item header">
								<span class="item-header">Latest News</span>
								<a class="item-link" href="<?= e(url('home', 'news')) ?>">All news</a>
							</li>
							<?php for ($i=1; $i <= 3 ; $i++): ?>
							<li class="news-item">
								<a class="news-link" href="" style="padding: .5rem;">
									<span class="news-date">Nov 1</span>
									<div class="news-desc">
										<span class="news-theme">A</span>
										<span class="news-topic">B</span>
										<span class="news-subs">C</span>
									</div>
									<span class="material-symbols-outlined">arrow_outward</span>
								</a>
							</li>
							<?php endfor ?>
						</ul>
					</div>
				</div>

				<div class="d-flex flex-column gap-4">
					<span>Explore <?= e(site('name').site('site')) ?></span>
					<div class="home-grid">
					<?php foreach ($menu['sections'] as $key => $sec):
						if (!empty($sec['hidden'])) continue;
						$to  = $sec['url'] ?? $key;
						$group = $sec['group'] ?? $key;
						$subs  = $menu['groups'][$group] ?? [];
						$grp = $menu['sections'][$to]['group'] ?? $sec['group'] ?? '';
						$off = empty($menu['groups'][$grp]);
						$on  = !$off && ($to === $section); ?>
						<a class="home-navbar<?= $on ? ' active' : '' ?><?= $off ? ' disabled' : '' ?>" <?= $off ? 'aria-disabled="true"' : 'href="' . url($to) . '"' ?>>
							<div class="d-flex flex-column" style="padding: 1rem;">
								<span class="home-menu"><?= e($sec['name']) ?></span>
								<div>
								<?php
								$totalSubs = count($subs);
								$i = 0; foreach ($subs as $subKey => $label): ?>
									<small class="fg-2"><?= e($label) ?><?= ++$i < $totalSubs ? ' &middot;' : '' ?></small>
								<?php endforeach; ?>
								</div>
							</div>
						</a>
					<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>