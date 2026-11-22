<script>
		(function () {
		var root = document.documentElement;
		var items = document.querySelectorAll('[data-theme-value]');
		var mq = matchMedia('(prefers-color-scheme: dark)');

		function apply(pref) {
			var dark = pref === 'dark' || (pref === 'system' && mq.matches);
			root.setAttribute('data-theme-pref', pref);
			root.setAttribute('data-bs-theme', dark ? 'dark' : 'light');
			root.style.colorScheme = dark ? 'dark' : 'light';
			items.forEach(function (el) {
				var on = el.dataset.themeValue === pref;
				el.classList.toggle('active', on);
				if (on) el.setAttribute('aria-current', 'true');
				else el.removeAttribute('aria-current');
			});
		}

		items.forEach(function (el) {
			el.addEventListener('click', function () {
				var pref = el.dataset.themeValue;
				try { localStorage.setItem('theme', pref); } catch (err) {}
				apply(pref);
			});
		});

		mq.addEventListener('change', function () {
			if (root.getAttribute('data-theme-pref') === 'system') apply('system');
		});

		addEventListener('storage', function (e) {
			if (e.key === 'theme') apply(e.newValue || 'system');
		});

		addEventListener('pageshow', function (e) {
			if (!e.persisted) return;
			var p = 'system';
			try { p = localStorage.getItem('theme') || 'system'; } catch (err) {}
			apply(p);
		});

		apply(root.getAttribute('data-theme-pref') || 'system');

		addEventListener('load', function () {
			requestAnimationFrame(function () {
				requestAnimationFrame(function () { root.classList.add('ready'); });
			});
		});

		var interacted = false;
		['pointerdown', 'keydown'].forEach(function (t) {
			addEventListener(t, function () { interacted = true; }, true);
		});
		var menuEl = document.querySelector('.menu');
		if (menuEl) {
			new MutationObserver(function () {
				if (menuEl.classList.contains('show') && !interacted) {
					console.warn('[menu] open', {
						ms: Math.round(performance.now()),
						readyState: document.readyState,
						ready: root.classList.contains('ready')
					});
				}
			}).observe(menuEl, { attributes: true, attributeFilter: ['class'] });
		}
	})();
</script>

<script>
	const btnTop = document.getElementById("btnBackToTop");

	window.addEventListener("scroll", () => {
		if (window.scrollY > 200) {
			btnTop.classList.add("show");
		} else {
			btnTop.classList.remove("show");
		}
	});
	
	btnTop.addEventListener("click", () => {
		window.scrollTo({
			top: 0,
			behavior: "smooth"
		});
	});
</script>

<script>
(() => {
	'use strict';

	// huruf kecil + tanpa aksen, jadi "eclair" menemukan "Éclair"
	const norm = (s) => s.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim();
	const pick = (sel) => (sel ? document.querySelector(sel) : null);

	const init = (list) => {
		const items    = [...list.children];
		const perPage  = parseInt(list.dataset.perPage, 10) || 18;
		const minChars = parseInt(list.dataset.minChars, 10) || 4;
		const input    = pick(list.dataset.search);
		const pager    = pick(list.dataset.pager);
		const empty    = pick(list.dataset.empty);
		const status   = pick(list.dataset.status);

		const keys = items.map((el) => norm(el.dataset.search ?? el.textContent));
		let matches = items.map((_, i) => i);   // indeks item yang lolos pencarian
		let page = 1;

		const pageItem = (label, { to = null, active = false, disabled = false, aria = '' } = {}) => {
			const li = document.createElement('li');
			li.className = 'page-item' + (active ? ' active' : '') + (disabled ? ' disabled' : '');
			const a = document.createElement(to !== null && !disabled ? 'a' : 'span');
			a.className = 'page-link';
			a.textContent = label;
			if (a.tagName === 'A') { a.href = '#'; a.dataset.to = to; }
			if (aria) a.setAttribute('aria-label', aria);
			if (active) a.setAttribute('aria-current', 'page');
			li.append(a);
			return li;
		};

		const drawPager = (pages) => {
			if (!pager) return;
			pager.replaceChildren();
			if (pages <= 1) return;   // satu halaman saja: pager tidak perlu

			pager.append(pageItem('\u00ab', { to: page - 1, disabled: page === 1, aria: 'Previous' }));
			let gap = false;
			for (let p = 1; p <= pages; p++) {
				if (p !== 1 && p !== pages && Math.abs(p - page) > 1) {
					if (!gap) pager.append(pageItem('\u2026', { disabled: true }));
					gap = true;
					continue;
				}
				gap = false;
				pager.append(pageItem(String(p), { to: p, active: p === page }));
			}
			pager.append(pageItem('\u00bb', { to: page + 1, disabled: page === pages, aria: 'Next' }));
		};

		const render = () => {
			const pages = Math.max(1, Math.ceil(matches.length / perPage));
			page = Math.min(Math.max(page, 1), pages);

			const start   = (page - 1) * perPage;
			const visible = new Set(matches.slice(start, start + perPage));
			items.forEach((el, i) => { el.hidden = !visible.has(i); });

			if (empty) empty.hidden = matches.length > 0;
			if (status) {
				status.textContent = matches.length
					? `Showing ${start + 1}-${start + visible.size} of ${matches.length}`
					: 'No results';
			}
			drawPager(pages);
		};

		const applySearch = () => {
			const q = input ? norm(input.value) : '';
			const tokens = q.length >= minChars ? q.split(/\s+/) : [];   // < minChars: tampilkan semua
			matches = [];
			keys.forEach((k, i) => { if (tokens.every((t) => k.includes(t))) matches.push(i); });
			page = 1;
			render();
		};

		input?.addEventListener('input', applySearch);

		pager?.addEventListener('click', (e) => {
			const a = e.target.closest('a[data-to]');
			if (!a) return;
			e.preventDefault();
			page = parseInt(a.dataset.to, 10);
			render();
			if (list.getBoundingClientRect().top < 0) list.scrollIntoView({ behavior: 'smooth', block: 'start' });
		});

		applySearch();   // keadaan awal; juga bila browser memulihkan isi kolom pencarian
	};

	document.querySelectorAll('[data-paginate]').forEach(init);
})();
</script>

<!--<script>
	const explorer = document.getElementById('competitionExplorer');
	const cards = [...document.querySelectorAll('.competition-card')];
	const panel = document.getElementById('competitionPanel');
	const closeButton = document.getElementById('closeCompetition');

	const panelContents = [...panel.querySelectorAll('[data-panel-content]')];
	const desktop = window.matchMedia('(min-width: 768px)');

	function animateLayout(open) {
		const first = cards.map(card => card.getBoundingClientRect());
		explorer.classList.toggle('is-open', open);
		const last = cards.map(card => card.getBoundingClientRect());
		cards.forEach((card, i) => {
			const dx = first[i].left - last[i].left;
			const dy = first[i].top - last[i].top;
			const sx = first[i].width / last[i].width;
			const sy = first[i].height / last[i].height;
			card.animate([
				{ transform: `translate(${dx}px, ${dy}px) scale(${sx}, ${sy})` },
				{ transform: 'none' }
			], { duration: 700, easing: 'cubic-bezier(.2,.8,.2,1)'}); }); }

		function openCompetition(card) {
			const target = card.dataset.competition;
			panelContents.forEach(content => {
				content.hidden = content.dataset.panelContent !== target; });
			cards.forEach(item => {
				const active = item === card;
				item.classList.toggle('active', active);
				item.setAttribute('aria-expanded', String(active));
			});
			if (!explorer.classList.contains('is-open')) {
				panel.setAttribute('aria-hidden', 'false');
				animateLayout(true);
			}
		}

		function closeCompetition() {
			if (!explorer.classList.contains('is-open')) return;
			cards.forEach(card => {
				card.classList.remove('active');
				card.setAttribute('aria-expanded', 'false');
			});
			panel.setAttribute('aria-hidden', 'true');
			animateLayout(false);
		}

		cards.forEach(card => {
			card.addEventListener('click', function(e) {
				if (!desktop.matches) return;
				e.preventDefault();
				openCompetition(this);
			});
		});
		closeButton.addEventListener('click', closeCompetition);
		desktop.addEventListener('change', function(e) {
			if (!e.matches) { closeCompetition(); }
	});
</script>-->

<!--<script>
	const navWrapper = document.querySelector('.nav-overflow');
	
	navWrapper.addEventListener('update.bs.navoverflow', (event) => {
		const isOverflowing = event.overflowCount > 0;
		navWrapper.setAttribute('data-bs-nav-overflow', isOverflowing);
	});

</script>-->

<!--<script>
	function widget() {
		const menu = document.getElementById("widgetMenu");
		const btn = document.querySelector(".btn-widget");
		const navbar = btn.closest("nav") || btn.closest("header") || btn.parentElement;
		
		menu.classList.toggle("show");
		if (menu.classList.contains("show")) {
			const btnRect = btn.getBoundingClientRect();
			const navRect = navbar.getBoundingClientRect();
			const menuWidth = menu.offsetWidth;
			const screenWidth = window.innerWidth;
			
			menu.style.top = navRect.bottom + "px";
			
			if (btnRect.left + menuWidth > screenWidth) {
				let leftPos = btnRect.right - menuWidth;
				if (leftPos < 0) leftPos = 10; 
				menu.style.left = leftPos + "px";
			} else {
				menu.style.left = btnRect.left + "px";
			}
		}
	}

	window.addEventListener("click", function(event) {
		if (!event.target.closest(".widget")) {
			const dropdowns = document.getElementsByClassName("widget-menu");
			for (let i = 0; i < dropdowns.length; i++) {
				dropdowns[i].classList.remove("show");
			}
		}
	});
	window.addEventListener("resize", () => document.getElementById("widgetMenu").classList.remove("show"));
</script>-->