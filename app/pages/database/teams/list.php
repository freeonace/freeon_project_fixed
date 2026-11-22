<?php
$leagues  = team_leagues();
$byEntity = teams_by_entities(array_column($leagues, 'id'));

$byId = $leagues;
usort($byId, fn($a, $b) => (int)$a['id'] <=> (int)$b['id']);

$allTeams = [];
foreach ($byId as $l) {
	foreach ($byEntity[(int)$l['id']] ?? [] as $t) $allTeams[] = $t;
}
?>
<section class="teams">
	<div class="lg:container">
		<div class="d-flex flex-column gap-7">
			<div class="d-flex flex-column">
				<h1 class="fs-xl fw-semibold">Team Database</h1>
				<span class="fg-2">Explore the teams represented <?= e(site('conti')) ?>, in <?= e(site('name')).e(site('site')) ?> football database.</span>
			</div>

			<?php if (!$leagues): ?>
			<p class="info-error">No teams yet.</p>
			<?php else: ?>
			<div class="row g-5">
				<div class="col-12 lg:col-3">
					<div class="d-flex flex-column gap-3">
						<span class="fw-semibold">BROWSE CATEGORIES</span>
						<ul class="nav" id="teamTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane" aria-selected="true">All</button>
							</li>
							<?php foreach ($leagues as $l): ?>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="league-e<?= (int)$l['id'] ?>-tab" data-bs-toggle="tab" data-bs-target="#league-e<?= (int)$l['id'] ?>-tab-pane" type="button" role="tab" aria-controls="league-e<?= (int)$l['id'] ?>-tab-pane" aria-selected="false"><?= e($l['name']) ?></button>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>

				<div class="col-12 lg:col-9">
					<div class="tab-content" id="teamTabContent">
						<div class="tab-pane show active" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0">
							<div class="d-flex flex-column gap-5">
								<div style="display: grid; grid-template-columns: 1fr 4fr; align-items: center; gap: 1rem;">
									<label for="searchTeam" class="form-label">Search Team</label>
									<input class="form-control" type="search" id="searchTeam" placeholder="Search..." aria-label="Search Team" autocomplete="off">
								</div>

								<div class="team-list" data-paginate data-per-page="18" data-min-chars="4" data-search="#searchTeam" data-pager="#teamPager" data-empty="#teamEmpty" data-status="#teamStatus">
								<?php foreach ($allTeams as $t): ?>
									<?php component('card-teams', compact('t')); ?>
								<?php endforeach; ?>
								</div>

								<p class="info-error" id="teamEmpty" hidden>No teams found.</p>
								<p class="visually-hidden" id="teamStatus" aria-live="polite"></p>

								<nav aria-label="Team Pages">
									<ul class="pagination pagination-sm theme-primary" id="teamPager"></ul>
								</nav>
							</div>
						</div>

						<?php foreach ($leagues as $l): $teams = $byEntity[(int)$l['id']] ?? []; ?>
						<div class="tab-pane" id="league-e<?= (int)$l['id'] ?>-tab-pane" role="tabpanel" aria-labelledby="league-e<?= (int)$l['id'] ?>-tab" tabindex="0">
						<?php if (!$teams): ?>
							<p class="info-error">No teams yet.</p>
						<?php else: ?>
							<div class="team-list">
							<?php foreach ($teams as $t): ?>
								<?php component('card-teams', compact('t')); ?>
							<?php endforeach; ?>
							</div>
						<?php endif; ?>
						</div>
						<?php endforeach; ?>

					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>