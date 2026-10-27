// Native details handle keyboard/touch; the media query only sets the initial layout.
document.addEventListener('DOMContentLoaded', () => {
	const groups = [...document.querySelectorAll('#colophon .ccafe-footer-group')];
	const wide = window.matchMedia('(min-width: 768px)');
	const updateGroups = () => groups.forEach((group) => {
		const hadFocus = group.contains(document.activeElement);
		group.open = wide.matches;
		if (!wide.matches && hadFocus) group.querySelector('summary')?.focus({ preventScroll: true });
	});
	updateGroups();
	wide.addEventListener('change', updateGroups);
});
