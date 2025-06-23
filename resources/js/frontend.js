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

window.toggleSubmenu = function(id) {
    const allSubmenus = document.querySelectorAll('.submenu');
    allSubmenus.forEach((submenu) => {
        if (submenu.id === id) {
            submenu.classList.toggle('hidden');
        } else {
            submenu.classList.add('hidden');
        }
    });
};
 

window.addEventListener('scroll', () => {
  const menui = document.getElementById('menuu');
  const scrollY = window.scrollY || document.documentElement.scrollTop;
  const vh = window.innerHeight;

  if (scrollY > vh - 100 ) {
    menui.classList.add('menu-anim');
  } else {
    menui.classList.remove('menu-anim');
  }
});

(function () {
  const text = document.getElementById('mssg');

  if (!text) return;

  // Get the initial position of the text relative to the document
  const initialOffsetTop = text.offsetTop;
  const initialLeft = text.getBoundingClientRect().left;
  const initialWidth = text.offsetWidth;

  const handleScroll = () => {
    const scrollY = window.scrollY || window.pageYOffset;

    if (scrollY >= initialOffsetTop) {
      text.style.position = 'fixed';
      text.style.top = '0';
      text.style.left = `${initialLeft}px`;
      text.style.width = `${initialWidth}px`;
      text.style.zIndex = '1000'; // Optional: keep it above other content
    } else {
      text.style.position = 'relative';
      text.style.top = '0';
      text.style.left = 'auto';
      text.style.width = 'auto';
      text.style.zIndex = 'auto';
    }
  };

  window.addEventListener('scroll', handleScroll, { passive: true });
})();

