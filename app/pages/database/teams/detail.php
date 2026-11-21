<?php
$tabs = ['overview' => 'Overview', 'squad' => 'Squad', 'stats'   => 'Stats', 'history'  => 'History'];

$teamId = ctype_digit($args[0] ?? '') ? (int)$args[0] : 0;
$team   = $teamId ? team_by_id($teamId) : null;
$tab    = $args[2] ?? 'overview';

if (!$team || !isset($tabs[$tab])) {
	page_title('Not found');
	require APP . '/pages/errors/404.php';
	return;
}

if (($args[1] ?? '') !== team_slug($team['alt'], $team['name']) || ($tab === 'overview' && isset($args[2]))) {
	header('Location: ' . team_info_url($teamId, $team['alt'], $team['name'], $tab === 'overview' ? null : $tab), true, 302);
	exit;
}

page_title($team['name']);

$fallback = BASE_URL . '/asset/img/team/default.png';
$estYear = substr((string)$team['est'], 0, 4);
$estYear = ($estYear !== '' && $estYear !== '0000') ? $estYear : null;
?>
<div class="d-flex flex-column" style="<?= e(team_style($team['color'], $team['subcol'])) ?>">
	<div class="team-details">
		<div class="team-base lg:container">
			<div class="row">
				<div class="col-12 md:col align-self-start">
					<div class="d-flex align-items-center gap-5">
						<img class="logo-lg" src="<?= e(team_logo((int)$team['id'])) ?>" alt="" loading="lazy" decoding="async"
					     onerror="this.onerror=null;this.src='<?= e($fallback) ?>'">
						<div class="d-flex flex-column">
							<span class="team-name">
								<span class="sm:d-none"><?= e($team['alt']) ?></span>
								<span class="d-none sm:d-inline"><?= e($team['name']) ?></span>
								<span class="d-none sm:d-inline">(<?= e($team['short']) ?>)</span>
							</span>
							<?php if (trim((string)$team['entity']) !== ''): ?>
							<div class="badge align-self-start"><?= e($team['entity']) ?></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="dvd"></div>
				<div class="col-12 md:col align-self-center">
					<div class="team-profile">
						<div class="d-flex flex-column">
							<small class="fg-theme">Stadium</small>
							<strong class="lh-1"><?= e($team['stadium']) ?></strong>
						</div>

						<div class="d-flex flex-column">
							<small class="fg-theme">City</small>
							<strong class="lh-1"><?= e($team['city']) ?></strong>
						</div>

						<div class="d-flex flex-column">
							<small class="fg-theme">Founded</small>
							<strong class="lh-1"><?= e($estYear) ?></strong>
						</div>

						<div class="d-flex flex-column">
							<small class="fg-theme">Country</small>
							<strong class="lh-1"><?= e($team['region']) ?></strong>
						</div>
					</div>
				</div>
			</div>

			<div class="align-self-center">
				<ul class="nav nav-pills justify-content-center" aria-label="Team sections">
				<?php foreach ($tabs as $key => $label): $on = ($key === $tab); ?>
					<li class="nav-item">
						<a class="nav-link<?= $on ? ' active' : '' ?>"<?= $on ? ' aria-current="page"' : '' ?> href="<?= e(team_info_url($teamId, $team['alt'], $team['name'], $key === 'overview' ? null : $key)) ?>"><?= e($label) ?></a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<section>
		<?php require __DIR__ . "/tabs/$tab.php"; ?>
	</section>
</div>