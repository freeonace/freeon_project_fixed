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
	<section class="detail lg:container">
		<div class="row g-5">
			<div class="col-12 md:col-7 lg:col-7 xl:col-8 order-2 md:order-1">
				<?php require __DIR__ . "/tabs/$tab.php"; ?>
			</div>
			<div class="col-12 md:col-5 lg:col-5 xl:col-4 d-flex flex-column gap-5 order-1 md:order-2">
				<div class="card card-body">
					<div class="d-flex flex-column">
						<span class="team-title">Team informations</span>
						<div>
							<p class="text-justify"><?= e($team['name']) ?> is a football club based in <?= e($team['city']) ?>, <?= e($team['region']) ?>. <?= e($team['alt']) ?> competing in the <?= e($team['entity']) ?>. <?= e($team['alt']) ?> established in <?= e(date('d F Y', strtotime($team['est']))) ?>, participating in most of <?= e(site('name')) ?> competitions and leagues since <?= (new DateTime($team['est']))->diff(new DateTime())->y ?> years ago.</p>
						</div>

						<div class="team-information">
							<?php if ($stadium !== ''): ?>
							<span>Stadium</span>
							<span><?= e($team['stadium']) ?></span>
							<?php endif; ?>

							<?php if ($seats !== ''): ?>
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
				<div class="card card-body d-none md:d-flex">
					<span class="team-title">Current season</span>
					<div class="team-form">
						<div class="team-form-w">W</div>
						<div class="team-form-l">L</div>
						<div class="team-form-d">D</div>
						<div class="team-form-w">W</div>
						<div class="team-form-d">D</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>