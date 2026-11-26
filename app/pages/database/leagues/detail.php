<?php
$tabs = ['overview' => 'Overview', 'standings' => 'Standings',
         'matches'  => 'Matches',  'history'   => 'History'];

$leagueId = ctype_digit($args[0] ?? '') ? (int)$args[0] : 0;
$league   = $leagueId ? league_by_id($leagueId) : null;
$tab      = $args[2] ?? 'overview';

if (!$league || !isset($tabs[$tab])) {
	page_title('Not found');
	require APP . '/pages/errors/404.php';
	return;
}

page_title($league['name'] . ($tab === 'overview' ? '' : ' - ' . $tabs[$tab]));
?>
<div>
	<div>
		<div>
			<div></div>
		</div>
	</div>
</div>