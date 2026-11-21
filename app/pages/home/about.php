<div class="about-page">
	<div class="lg:container">
		<div class="d-flex flex-column">
			<div class="d-flex flex-column md:flex-row gap-8">
				<div class="about-card">
					<span class="about-title"><?= e(site('name')) ?></span>
				</div>
				<div class="d-flex flex-column gap-5">
					<h1 style="font-size: clamp(2rem, 1rem + 2.5vw, 5rem); font-weight: 700;">The continental home of football.</h1>
					<span class="text-justify" style="font-size: clamp(1rem, .75rem + .5vw, 1.5rem);">SCFF brings together sixteen national football associations from across Southernia.</span>
					<span class="text-justify" style="font-size: clamp(.875rem, .25rem + .75vw, 1.5rem);">We work with our members to provide a shared platform for the organisation, representation and development of football.</span>
					<a href="<?= e(url('home', 'association')) ?>">Explore our structure</a>
				</div>
			</div>
		</div>
	</div>
</div>