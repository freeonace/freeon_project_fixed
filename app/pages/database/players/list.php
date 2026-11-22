<?php
?>
<section class="players">
	<div class="lg:container">
		<div class="d-flex flex-column gap-7">
			<div class="d-flex flex-column">
				<h1 class="fs-xl fw-semibold">Player Database</h1>
				<span class="fg-2"><?= e(site('name')) ?> Players in All Teams.</span>
			</div>

			<div class="nav-overflow" data-bs-toggle="nav-overflow">
				<ul class="nav nav-underline">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="">All</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="">Free Agents</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="">National Players</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="">Retired</a>
					</li>
				</ul>
			</div>

			<div class="row g-5">
				<div class="col-12 md:col-5 lg:col-4">
					<button type="button" class="btn-solid btn-sm theme-primary btn-advance" data-bs-toggle="dialog" data-bs-target="#advanceSearch">Advance Search</button>
					<dialog class="dialog dialog-instant md-down:dialog-fullscreen" id="advanceSearch">
						<div class="dialog-header">
							<h1 class="dialog-title">Instant dialog</h1>
							<button type="button" class="btn-close" data-bs-dismiss="dialog" aria-label="Close"></button>
						</div>
						<div class="dialog-body overflow-auto">
							<?php component('search-bar'); ?>
						</div>
					</dialog>
					<div class="card card-body advance-search">
						<?php component('search-bar'); ?>
					</div>
				</div>

				<div class="col-12 md:col-7 lg:col-8">
					<div class="d-flex flex-column gap-9">
						<form class="form-field">
							<label for="searchPlayer" class="form-label mb-2">Search player</label>
							<div class="input-group">
								<input type="text" class="form-control" id="searchPlayer" placeholder="Search Player..." style="width: 100%; max-width: 700px; outline: none;">
								<button class="btn-solid theme-primary input-group-btn" type="submit">
									<span class="material-symbols-outlined">search</span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>