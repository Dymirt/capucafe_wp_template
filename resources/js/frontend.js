document.addEventListener('DOMContentLoaded', function() {
	const scrollContainer = document.getElementById('productScrollWrapper');
	const scrollLeftBtn = document.getElementById('scrollLeft');
	const scrollRightBtn = document.getElementById('scrollRight');

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
