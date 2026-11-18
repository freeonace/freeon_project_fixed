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