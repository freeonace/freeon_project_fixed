<div class="d-flex flex-column gap-5">
	<div class="card card-body">
		<span class="team-title">Competition campaign</span>
		<div class="table-responsive">
			<table class="table table-team">
				<thead>
					<tr>
						<th>#</th>
						<th>Team</th>
						<th>P</th>
						<th>W</th>
						<th>D</th>
						<th>L</th>
						<th>GF</th>
						<th>GA</th>
						<th>GD</th>
						<th>Pts</th>
					</tr>
				</thead>
				<tbody>
					<tr class="table-active">
						<td>6</td>
						<td><a href="">
							<div class="d-flex align-items-center gap-2">
								<img class="logo-sm" src="...">
								<span>Ackertonville</span>
							</div>
						</a></td>
						<td>11</td>
						<td>5</td>
						<td>3</td>
						<td>3</td>
						<td>22</td>
						<td>13</td>
						<td>+9</td>
						<td>18</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="team-match-grid">
	<?php for ($i=1; $i <= 5; $i++): component('fixture-teams'); ?>
	<?php endfor; ?>
	</div>
</div>