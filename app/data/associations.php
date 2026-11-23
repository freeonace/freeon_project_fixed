<?php
function assocs_url(int $id, ?string $alt = null, ?string $tab = null): string {
	$u = url('home', 'association') . '/' . $id . '/' . (slugify($alt) ?: 'association');
	return $tab ? $u . '/' . $tab : $u;
}