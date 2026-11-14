<?php // app/layout/admin.php : isi <body> saat yang login admin (dipanggil main.php; scripts.php tetap dimuat main.php) ?>
<aside>
	<a href="<?= e(home_url()) ?>">ADMIN</a>
	<ul class="nav flex-column">
	<?php foreach ($menu['groups']['admin'] ?? [] as $key => $label): ?>
		<li class="nav-item"><a class="nav-link" href="<?= url('admin', $key) ?>"><?= e($label) ?></a></li>
	<?php endforeach; ?>
	</ul>
</aside>
<main><?= $content ?></main>
<?php ?>
<button id="btnBackToTop" class="btn-top" title="Back to top">
	<span class="material-symbols-outlined">keyboard_double_arrow_up</span>
</button>
