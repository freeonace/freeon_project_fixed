<?php
// variabel: $t (baris dari teams_by_entities), $fallback (opsional)
$fallback = $fallback ?? (BASE_URL . '/asset/img/team/default.png');
?>
<div class="card-team" style="<?= e(team_style($t['color'], $t['subcol'])) ?>">
	<a class="card-team-body" href="<?= e(team_info_url((int)$t['id'], $t['alt'], $t['name'])) ?>">
		<div class="card-team-img">
			<img class="card-team-logo" src="<?= e(team_logo((int)$t['id'])) ?>" alt="" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='<?= e($fallback) ?>'">
		</div>
		<div class="card-team-label">
				<span class="card-team-name">
					<span><?= e($t['name']) ?></span>
					<span class="d-none md:d-inline">(<?= e($t['short']) ?>)</span>
				</span>
			<div class="card-team-info">
				<div class="card-team-stadium">
					<span class="material-symbols-outlined">stadium</span>
					<span><?= e($t['stadium'] ?? '') ?></span>
				</div>
				<div class="card-team-city">
					<span class="material-symbols-outlined">map</span>
					<span><?= e($t['city']) ?></span>
				</div>
			</div>
		</div>
	</a>
	<div class="card-team-footer">A</div>
</div>