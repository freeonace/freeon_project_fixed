<?php
page_title('Teams');
?>
<section class="teams">
	<div class="lg:container">
		<div class="d-flex flex-column gap-7">
			<div class="d-flex flex-column">
				<h1 class="fs-xl fw-semibold">Team Database</h1>
				<span class="fg-2">Explore the teams represented <?= e(site('conti')) ?>, in <?= e(site('name')).e(site('site')) ?> football database.</span>
			</div>

			<div class="row g-5">
				<div class="col-12 md:col-3">
					<div class="d-flex flex-column gap-3">
						<span class="fw-semibold">BROWSE CATEGORIES</span>
						<ul class="nav" id="teamTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane" aria-selected="true">All</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="league-tab" data-bs-toggle="tab" data-bs-target="#league-tab-pane" type="button" role="tab" aria-controls="league-tab-pane" aria-selected="true">League</button>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-12 md:col-9">
					<div class="d-flex flex-column gap-9">
						<div class="team-list-search">
							<label for="searchInput" class="form-label">Search team</label>
							<label class="form-control form-adorn">
								<div class="form-adorn-icon" aria-hidden="true">
									<span class="material-symbols-outlined">search</span>
								</div>
								<input type="search" class="form-ghost" id="searchInput" placeholder="Search...">
							</label>
						</div>
						<div class="tab-content" id="teamTabContent">
							<div class="tab-pane show active" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0">
								<div class="team-list">
								<?php for ($i = 1; $i <= 10; $i++): ?>
									<a class="card-team" href="">
										<div class="card-team-img">
											<img class="card-team-logo" src="../asset/img/team/default.png">
										</div>
										<div class="card-team-label">
											<div class="card-team-info">
												<span class="card-team-name">Lorem Ipsum</span>
												<span class="card-team-stadium">Dolor sit ame</span>
												<span class="card-team-city">City</span>
											</div>
										</div>
									</a>
								<?php endfor; ?>
								</div>
							</div>
							<div class="tab-pane" id="league-tab-pane" role="tabpanel" aria-labelledby="league-tab" tabindex="0">
								<div class="team-list">
								<?php for ($i = 1; $i <= 5; $i++): ?>
									<a class="card-team" href="">
										<div class="card-team-img">
											<img class="card-team-logo" src="../asset/img/team/default.png">
										</div>
										<div class="card-team-label">
											<div class="card-team-info">
												<span class="card-team-name">Lorem Ipsum</span>
												<span class="card-team-stadium">Dolor sit ame</span>
												<span class="card-team-city">City</span>
											</div>
										</div>
									</a>
								<?php endfor; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>