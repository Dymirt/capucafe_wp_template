// Native dialog supplies modality and Escape; JS manages focus, scroll and consistent Tab wrapping.
document.addEventListener('DOMContentLoaded', () => {
	const menu = document.getElementById('side-menu');
	if (!menu) return;
	let opener;
	let previousOverflow;
	document.addEventListener('click', (event) => {
		const button = event.target.closest('.ccafe-menu-open');
		if (!button) return;
		opener = button;
		previousOverflow = document.body.style.overflow;
		menu.showModal();
		document.body.style.overflow = 'hidden';
		document.documentElement.classList.add('ccafe-menu-is-open');
		button.setAttribute('aria-expanded', 'true');
	});
	menu.querySelector('#menu-close').addEventListener('click', () => menu.close());
	menu.addEventListener('close', () => {
		document.body.style.overflow = previousOverflow || '';
		document.documentElement.classList.remove('ccafe-menu-is-open');
		opener?.setAttribute('aria-expanded', 'false');
		opener?.focus();
	});
	menu.addEventListener('keydown', (event) => {
		if (event.key !== 'Tab') return;
		const controls = [...menu.querySelectorAll('a[href], button:not(:disabled), summary')].filter((element) => element.getClientRects().length && getComputedStyle(element).visibility !== 'hidden');
		const first = controls[0];
		const last = controls[controls.length - 1];
		if (event.shiftKey && document.activeElement === first) { event.preventDefault(); last?.focus(); }
		if (!event.shiftKey && document.activeElement === last) { event.preventDefault(); first?.focus(); }
	});
	menu.addEventListener('click', (event) => {
		if (event.target === menu && event.clientX < menu.getBoundingClientRect().left) menu.close();
	});
	window.matchMedia('(min-width: 1280px)').addEventListener('change', (event) => {
		if (event.matches && menu.open) menu.close();
	});
});

// The homepage uses a hero header and a fixed shop header: expose only the visible one.
document.addEventListener('DOMContentLoaded', () => {
	const heroHeader = document.getElementById('menuu');
	const shopHeader = document.querySelector('.header-shop');
	if (!heroHeader || !shopHeader) return;
	new IntersectionObserver(([entry]) => {
		shopHeader.inert = entry.isIntersecting;
		shopHeader.style.visibility = entry.isIntersecting ? 'hidden' : '';
		shopHeader.setAttribute('aria-hidden', String(entry.isIntersecting));
	}, { threshold: 0 }).observe(heroHeader);
});
