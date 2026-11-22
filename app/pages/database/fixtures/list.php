<?php
?>
<section class="fixtures">
	<div class="lg:container">
		<div class="d-flex flex-column gap-7">
			<div class="d-flex flex-column">
				<h1 class="fs-xl fw-semibold">Fixture Database</h1>
				<span class="fg-2"><?= e(site('name')) ?> Match schedule, results and upcoming games across <?= e(site('conti')) ?>.</span>
			</div>

			<form>
				<div class="d-flex align-items-center gap-3">
					<div class="form-field">
						<select id="fixtureSeason" class="form-control form-control-sm">
							<option selected>Season 2005</option>
							<option>...</option>
						</select>
					</div>
					<div class="form-field">
						<select id="fixtureComp" class="form-control form-control-sm">
							<option selected>All competition</option>
							<option>...</option>
						</select>
					</div>
					<button type="submit" class="btn-solid btn-sm theme-primary">
						<span>Show</span>
					</button>
				</div>
			</form>

			<div class="d-flex flex-column gap-3">
				<div class="d-flex flex-wrap column-gap-9 justify-content-between align-items-center">
					<strong class="fs-lg">Monday, November 9</strong>
				</div>
				<div class="d-flex justify-content-between align-items-center gap-3">
					<button class="btn">
						<span class="material-symbols-outlined">chevron_backward</span>
					</button>
					<div class="mw-fixture" style="width: 100%;">
						<?php for ($i=1; $i <= 30; $i++): ?>
						<button class="card-mw" id="match-mw">
							<div class="mw-view">
								<span class="mw-day">MW</span>
								<span class="mw-date"><?= $i ?></span>
							</div>
						</button>
						<?php endfor; ?>
					</div>
					<button class="btn">
						<span class="material-symbols-outlined">chevron_forward</span>
					</button>
				</div>
			</div>

			<div class="row row-cols-1 g-5">
				<div class="col">
					<div class="d-flex flex-column gap-4">
						<a class="match-card elite-league">
							<div class="row">
								<div class="col-12 lg:col-3 xl:col-2 text-start">
									<div class="d-flex lg:flex-column justify-content-between">
										<span>Mon, 1 Jan</span>
										<span>20:00</span>
									</div>
								</div>
								<div class="col-12 lg:col-6 xl:col-8 text-center">
									<div class="d-flex flex-column gap-3">
										<div>Stadium</div>
										<div class="row">
											<div class="col-5">A</div>
											<div class="col-2">B</div>
											<div class="col-5">C</div>
										</div>
									</div>
								</div>
								<div class="col-12 lg:col-3 xl:col-2 text-end">
									<div class="d-flex gap-3 align-items-center lg:align-items-end lg:gap-0 lg:flex-column">
										<span>Matchweek X</span>
										<span>League</span>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col"></div>

				<div class="col"></div>
			</div>
		</div>
	</div>
</section>