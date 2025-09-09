document.addEventListener('DOMContentLoaded', function () {
	const scrollContainer = document.getElementById('productScrollWrapper');
	const scrollLeftBtn = document.getElementById('scrollLeft');
	const scrollRightBtn = document.getElementById('scrollRight');
	if (!scrollContainer || !scrollLeftBtn || !scrollRightBtn) return;

	scrollLeftBtn.addEventListener('click', () => {
		if (scrollContainer.scrollLeft === 0) {
			scrollContainer.scrollTo({
				left: scrollContainer.scrollWidth,
				behavior: 'smooth'
			});
		} else {
			scrollContainer.scrollBy({
				left: -300,
				behavior: 'smooth'
			});
		}
	});
	scrollRightBtn.addEventListener('click', () => {
		if (scrollContainer.scrollLeft + scrollContainer.clientWidth >= scrollContainer.scrollWidth - 5) {
			scrollContainer.scrollTo({
				left: 0,
				behavior: 'smooth'
			});
		} else {
			scrollContainer.scrollBy({
				left: 300,
				behavior: 'smooth'
			});
		}
	});
});


// Function to toggle footer submenus
window.toggleSubmenu = function (id) {
	const allSubmenus = document.querySelectorAll('.submenu');
	allSubmenus.forEach((submenu) => {
		if (submenu.id === id) {
			submenu.classList.toggle('hidden');
		} else {
			submenu.classList.add('hidden');
		}
	});
};


document.addEventListener('DOMContentLoaded', () => {
	const scrollContainer = document.querySelector('.scroll-hidd');
	const navLinks = document.querySelectorAll('a[href^="#"]');

	if (!scrollContainer) return;

	navLinks.forEach(link => {
		const targetId = link.getAttribute('href').substring(1);
		const targetEl = document.getElementById(targetId);

		if (!targetEl) return;
		// TypeError
		link.addEventListener('click', e => {
			e.preventDefault();


			targetEl.scrollIntoView({
				behavior: 'smooth',
				block: 'nearest',
				inline: 'start'
			});


			if (location.hash !== `#${targetId}`) {
				history.pushState(null, '', `#${targetId}`);
			}
			else {
				history.replaceState(null, '', ' ');
				history.pushState(null, '', `#${targetId}`);
			}

		});
	});
});


const sections = document.querySelectorAll('section');
const dots = document.querySelectorAll('#dot-indicators span');

function updateActiveDot() {
	let closestSection = null;
	let minDistance = Infinity;

	sections.forEach(section => {
		const rect = section.getBoundingClientRect();
		const distance = Math.abs(rect.left);
		if (distance < minDistance) {
			minDistance = distance;
			closestSection = section;
		}
	});

	if (!closestSection) return;

	const targetId = closestSection.id;

	dots.forEach(dot => {
		if (dot.dataset.target === targetId) {
			dot.classList.add('bg-blue-500', 'opacity-100');
			dot.classList.remove('bg-black', 'opacity-30');
		} else {
			dot.classList.remove('bg-blue-500', 'opacity-100');
			dot.classList.add('bg-black', 'opacity-30');
		}
	});
}
if (scrollContainer) {
	scrollContainer.addEventListener('scroll', () => {
		updateActiveDot();
	});
}



