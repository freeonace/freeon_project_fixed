<?php
$tabs = ['overview' => 'Overview', 'squad' => 'Squad', 'stats'   => 'Stats', 'history'  => 'History', 'matches' => 'Matches'];

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

if ((int)$team['entity_id'] === 1) {   // entity tim nasional
	$assoc = association_by_region((int)$team['region_id']);
	if ($assoc) {
		header('Location: ' . assocs_team_url((int)$assoc['id'], $assoc['short'], (int)$team['id'], $team['alt'], $team['name']), true, 302);
		exit;
	}
}

page_title($team['name']);

$fallback = BASE_URL . '/asset/img/team/default.png';
$estYear = substr((string)$team['est'], 0, 4);
$estYear = ($estYear !== '' && $estYear !== '0000') ? $estYear : null;
$stadium = trim((string)$team['stadium']);
$seats   = (int)$team['capacity'] > 0 ? number_format((int)$team['capacity'], 0, ',', '.') : null;
$estTs  = $estYear !== null ? strtotime((string)$team['est']) : false;
$estTxt = $estTs ? date('d F Y', $estTs) : null;
$age    = $estTs ? (new DateTime('@' . $estTs))->diff(new DateTime())->y : null;
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
								<span class="d-none xl:d-inline">(<?= e($team['short']) ?>)</span>
							</span>
							<div class="team-comp">
								<?php if (trim((string)$team['entity']) !== ''): ?>
								<div class="badge badge-comp"><?= e($team['entity']) ?></div>
								<?php endif; ?>
								<a class="badge badge-league" href="">Elite League</a>
							</div>
						</div>
					</div>
				</div>
				<div class="dvd"></div>
				<div class="col-12 md:col align-self-center">
					<div class="team-profile">
						<div class="d-flex flex-column">
							<small class="fg-theme">League position</small>
							<strong class="fs-lg">6th</strong>
						</div>

						<div class="d-flex flex-column">
							<small class="fg-theme">Matches played</small>
							<strong class="fs-lg">11</strong>
						</div>

						<div class="d-flex flex-column">
							<small class="fg-theme">Matches won</small>
							<strong class="fs-lg">5</strong>
						</div>

						<div class="d-flex flex-column">
							<small class="fg-theme">Goal scored</small>
							<strong class="fs-lg">22</strong>
						</div>
					</div>
				</div>
			</div>

			<div class="nav-team" aria-label="Team sections">
				<ul class="nav">
				<?php foreach ($tabs as $key => $label): $on = ($key === $tab); ?>
					<li class="nav-item">
						<a class="nav-link<?= $on ? ' active' : '' ?>"<?= $on ? ' aria-current="page"' : '' ?> href="<?= e(team_info_url($teamId, $team['alt'], $team['name'], $key === 'overview' ? null : $key)) ?>"><?= e($label) ?></a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<section class="detail team-content lg:container">
		<div class="row gy-9">
			<div class="col-12 xl:col-8">
				<?php require __DIR__ . "/tabs/$tab.php"; ?>
			</div>
			<div class="col-12 xl:col-4">
				<div class="card card-body gap-6">
					<div class="d-flex flex-column">
						<span class="team-title">Team informations</span>
						<div class="mt-3">
							<p class="text-justify"><?= e($team['name']) ?> is a football club based in <?= e($team['city']) ?>, <?= e($team['region']) ?>. <?= e($team['alt']) ?> competing in the <?= e($team['entity']) ?>. <?= e($team['alt']) ?> established in <?= e(date('d F Y', strtotime($team['est']))) ?>, participating in most of <?= e(site('name')) ?> competitions and leagues since <?= (new DateTime($team['est']))->diff(new DateTime())->y ?> years ago.</p>
						</div>

						<div class="team-information">
							<?php if ($stadium !== ''): ?>
							<span>Stadium</span>
							<span><?= e($team['stadium']) ?></span>
							<?php endif; ?>

							<?php if ($seats !== null): ?>
							<span>Capacity</span>
							<span><?= e($seats) ?> seats</span>
							<?php endif; ?>

							<?php if (trim((string)$team['city']) !== ''): ?>
							<span>City</span>
							<span><?= e($team['city']) ?></span>
							<?php endif; ?>

							<?php if ($estTxt !== null): ?>
							<span>Founded:</span>
							<span><?= e($estTxt) ?> (<?= (int)$age ?> Years)</span>
							<?php endif; ?>

							<span>Club color</span>
							<div class="d-flex gap-2 align-items-center">
								<div class="team-color"></div>
								<div class="team-color-sub"></div>
							</div>
						</div>
					</div>
					<div>
						<span class="team-title">Title</span>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>