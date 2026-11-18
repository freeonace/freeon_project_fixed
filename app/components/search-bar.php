<form>
	<div class="d-flex flex-column gap-5">
		<div class="d-flex flex-column gap-3">
			<small class="fg-body fg-50" style="user-select: none;">General Info</small>
			<div class="d-flex flex-column gap-5">
				<div>
					<label for="nationality" class="form-label">Nationality</label>
					<select class="form-control form-control-sm" id="nationality" name="nat" form="player-filter">
						<option value="" disabled selected hidden>Nationality</option>
					</select>
				</div>
				<div>
					<label for="league" class="form-label">League</label>
					<select class="form-control form-control-sm" id="league">
						<option value="" disabled selected hidden>League</option>
					</select>
				</div>
				<div>
					<label for="team" class="form-label">Team</label>
					<select class="form-control form-control-sm" id="team">
						<option value="" disabled selected hidden>Team</option>
					</select>
				</div>
				<div>
					<label for="age-min" class="form-label">Age</label>
					<div class="row g-5">
						<div class="col">
							<input type="text" inputmode="numeric" class="form-control form-control-sm" placeholder="Min" aria-label="min-age" id="age-min" name="amin" form="player-filter">
						</div>
						<div class="col">
							<input type="text" inputmode="numeric" class="form-control form-control-sm" placeholder="Max" aria-label="max-age" id="age-max" name="amax" form="player-filter">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="d-flex flex-column gap-3">
			<small class="fg-body fg-50" style="user-select: none;">Select Position</small>
			<div class="d-flex flex-column gap-5">
				<div>
					<label for="pos1" class="form-label">Position</label>
					<select class="form-control form-control-sm" id="pos1">
						<option value="" disabled selected hidden>Primary Position</option>
					</select>
				</div>
			</div>
		</div>
		<div class="d-flex flex-column gap-3">
			<small class="fg-body fg-50" style="user-select: none;">Ability Search</small>
			<div class="d-flex flex-column gap-5">
				<div>
					<label for="min-ovr" class="form-label">Overall</label>
					<div class="row g-5">
						<div class="col">
							<input type="text" inputmode="numeric" class="form-control form-control-sm" placeholder="Min" aria-label="min-ovr" id="ovr-min" name="omin" form="player-filter">
						</div>
						<div class="col">
							<input type="text" inputmode="numeric" class="form-control form-control-sm" placeholder="Max" aria-label="max-ovr" id="ovr-max" name="omax" form="player-filter">
						</div>
					</div>
				</div>
			</div>
		</div>
		<button type="submit" class="btn-solid btn-sm theme-primary align-self-start">Search</button>
	</div>
</form>