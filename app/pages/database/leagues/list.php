<?php
page_title('Leagues');
?>
<section class="leagues">
	<div class="lg:container">
		<div class="d-flex flex-column gap-7">
			<div class="d-flex flex-column">
				<h1 class="fs-xl fw-semibold">League Database</h1>
				<span class="fg-2">Explore <?= e(site('name')) ?>'s league divisions from top tier to regional competitions across <?= e(site('conti')) ?>.</span>
			</div>

			<div class="d-flex flex-column gap-5">
				<div class="nav-overflow" data-bs-toggle="nav-overflow">
					<ul class="nav" id="leagueTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="featured-tab" data-bs-toggle="tab" data-bs-target="#featured-tab-pane" type="button" role="tab" aria-controls="featured-tab-pane" aria-selected="true">Featured</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="leagues-tab" data-bs-toggle="tab" data-bs-target="#leagues-tab-pane" type="button" role="tab" aria-controls="leagues-tab-pane" aria-selected="false">All Leagues</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="country-tab" data-bs-toggle="tab" data-bs-target="#country-tab-pane" type="button" role="tab" aria-controls="country-tab-pane" aria-selected="false">By Country</button>
						</li>
					</ul>
				</div>

				<div class="tab-content" id="leagueTabContent">
					<div class="tab-pane show active" id="featured-tab-pane" role="tabpanel" aria-labelledby="featured-tab" tabindex="0">
						<div class="d-flex flex-column gap-5">
							<div class="d-flex flex-column gap-3">
								<span class="fw-semibold fs-lg">Top-5 Leagues</span>
								<div class="top-list">
									<?php for ($i=1; $i <= 5; $i++) :?>
									<a class="card" href="">
										<div class="card-body"></div>
										<div class="card-footer"></div>
									</a>
									<?php endfor; ?>
								</div>
							</div>
							<div class="d-flex flex-column gap-3">
								<span class="fw-semibold fs-lg">Other Leagues</span>
								<ul class="list-group list-group-flush">
									<?php for ($i=1; $i <= 5; $i++) :?>
									<li class="list-group-item">
										<div class="league-grid">
											<div class="d-flex align-items-center gap-3">
												<img src="...">
												<span>National</span>
											</div>
											<div class="d-flex align-items-center gap-3">
												<a role="button" class="btn-solid btn-sm" href="#">
													<div class="d-flex align-items-center gap-3">
														<img src="...">
														<span>League</span>
													</div>
												</a>
											</div>
										</div>
									</li>
									<?php endfor; ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="leagues-tab-pane" role="tabpanel" aria-labelledby="leagues-tab" tabindex="0">
						<div class="d-flex flex-column gap-3">
							<span class="fw-semibold fs-lg">All Leagues</span>
							<ul class="list-group list-group-flush">
								<?php for ($i=1; $i <= 5; $i++) :?>
								<li class="list-group-item">
									<div class="league-grid">
										<div class="d-flex align-items-center gap-3">
											<img src="...">
											<span>National</span>
										</div>
										<div class="d-flex align-items-center gap-3">
											<a role="button" class="btn-solid btn-sm" href="#">
												<div class="d-flex align-items-center gap-3">
													<img src="...">
													<span>League</span>
												</div>
											</a>
										</div>
									</div>
								</li>
								<?php endfor; ?>
							</ul>
						</div>
					</div>
					<div class="tab-pane" id="country-tab-pane" role="tabpanel" aria-labelledby="country-tab" tabindex="0">
						<div class="league-list">
							<?php for ($i=1; $i <= 10 ; $i++): ?>
								<div class="card" href="">
									<div class="card-header">
										<div class="d-flex align-items-center gap-3">
											<img src="...">
											<span>National</span>
										</div>
									</div>
									<div class="list-group list-group-flush">
										<a class="list-group-item" href="">
											<div class="d-flex justify-content-between align-items-center">
												<span>League</span>
												<span>D1</span>
											</div>
										</a>
										<a class="list-group-item" href="">
											<div class="d-flex justify-content-between align-items-center">
												<span>League</span>
												<span>D2</span>
											</div>
										</a>
									</div>
								</div>
							<?php endfor; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>