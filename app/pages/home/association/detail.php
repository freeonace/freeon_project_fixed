<?php
$tabs = ['overview' => 'Overview', 'news' => 'News', 'national' => 'National Team'];

$assocId = ctype_digit($args[0] ?? '') ? (int)$args[0] : 0;
$assoc   = $assocId ? association_by_id($assocId) : null;
$tab     = $args[2] ?? 'overview';

$nationals = $assoc ? association_national_teams($assoc) : [];

$team = null;
if ($assoc && $tab === 'national' && isset($args[3])) {
	$teamId = ctype_digit($args[3]) ? (int)$args[3] : 0;
	foreach ($nationals as $n) {
		if ((int)$n['id'] === $teamId) $team = $n;
	}
	if (!$team) $assoc = null;
}

if (!$assoc || !isset($tabs[$tab])) {
	page_title('Not found');
	require APP . '/pages/errors/404.php';
	return;
}

if ($tab === 'national' && !$team && count($nationals) === 1) {
	$n = $nationals[0];
	header('Location: ' . assocs_team_url($assocId, $assoc['short'], (int)$n['id'], $n['alt'], $n['name']), true, 302);
	exit;
}

$canon = $team
	? [$assocId, assocs_slug($assoc['short']), 'national', $team['id'], team_slug($team['alt'], $team['name'])]
	: array_values(array_filter([$assocId, assocs_slug($assoc['short']), $tab === 'overview' ? null : $tab], fn($v) => $v !== null));

if (array_map('strval', $args) !== array_map('strval', $canon)) {
	$to = $team
		? assocs_team_url($assocId, $assoc['short'], (int)$team['id'], $team['alt'], $team['name'])
		: assocs_url($assocId, $assoc['short'], $tab === 'overview' ? null : $tab);
	header('Location: ' . $to, true, 302);
	exit;
}

page_title($team ? $team['name'] : $assoc['name']);
?>
<div class="d-flex flex-column" style="<?= e(assocs_style($assoc['color'], $assoc['subcol'])) ?>">
	<div class="assocs-details assocs-<?= e(assocs_slug($assoc['short'])) ?>">
		<div class="assocs-content lg:container">
			<div class="assocs-info">
				<div class="d-flex flex-column">
					<h1 class="assocs-name"><?= e($assoc['name']) ?></h1>
					<div class="assocs-region">
						<img class="flag-sm" src="...">
						<span><?= e($assoc['region']) ?></span>
					</div>
				</div>
				<img class="logo-lg" src="...">
			</div>
			<div class="justify-self-start">
				<ul class="nav" aria-label="Association sections">
				<?php foreach ($tabs as $key => $label): $on = ($key === $tab); ?>
					<li class="nav-item">
						<a class="nav-link<?= $on ? ' active' : '' ?>"<?= $on ? ' aria-current="page"' : '' ?> href="<?= e(assocs_url($assocId, $assoc['short'], $key === 'overview' ? null : $key)) ?>"><?= e($label) ?></a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="detail lg:container">
		<?php require __DIR__ . "/tabs/$tab.php"; ?>
	</div>
</div>
<div class="lg:container">
	<div class="row g-5">
	<?php for ($i=1; $i <= 14; $i++): ?>
		<?php
		$pat = $i % 6;
		if ($pat == 1 || $pat == 2 ) {
			$colClass = 'col-12 md:col-3';
			$bgClass  = 'bg-primary fg-white';
		} elseif ($pat == 3) {
			$colClass = 'col-12 md:col-6';
			$bgClass  = 'bg-secondary fg-white';
		} elseif ($pat == 4) {
			$colClass = 'col-12 md:col-6';
			$bgClass  = 'bg-white fg-black border';
		} else {
			$colClass = 'col-12 md:col-3';
			$bgClass  = 'theme-warning theme-subtle border';
		}?>
		<div class="<?= $colClass ?>">
			<div class="bento-card <?= $bgClass ?>">
				<div>
					<span class="badge mb-2">Item #<?= $i ?></span>
					<h4 class="fw-bold">Bento <?= $i ?></h4>
				</div>
				<p class="mb-0 opacity-75">Testing for bento pattern-<?= $i ?>.</p>
			</div>
		</div>
	<?php endfor; ?>
	</div>
</div>