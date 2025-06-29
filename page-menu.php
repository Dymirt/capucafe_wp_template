<?php

get_header(); ?>


<div data-layer="all" class="All flex">
	<div data-layer="L kategorie i filtry" class="LKategorieIFiltry self-stretch px-[5%] py-10 bg-stone-200 justify-start items-center hidden lg:flex lg:flex-col">
		<div data-layer="lista" class="Lista self-stretch min-w-72 pt-4 pb-6 flex flex-col justify-start items-center gap-3.5">
			<div data-layer="title" class="Title self-stretch pr-2 py-2.5 inline-flex justify-start items-start gap-3">
				<div data-layer="Szybka nawigacja" class="SzybkaNawigacja flex-1 justify-start text-stone-700 text-xl font-bold font-['Mulish']">Szybka nawigacja</div>
			</div>
			<div data-layer="Frame 3" class="Frame3 self-stretch inline-flex justify-start items-start gap-3">
				<div data-layer="Kategorie" class="Kategorie flex-1 inline-flex flex-col justify-start items-start gap-4">
				</div>
			</div>
		</div>
	</div>
	<div data-layer="R" class="R w-full px-20 pt-14 pb-28 bg-stone-50 inline-flex flex-col justify-start items-center gap-8">
		<div data-layer="Title" class="Title self-stretch pb-4 flex flex-col justify-start items-center">
			<div data-layer="Menu" class="Menu justify-start text-stone-700 text-6xl font-normal font-['Didot_LT_Pro']">Menu</div>
			<div data-layer="Frame 125" class="Frame125 size- inline-flex justify-start items-center gap-10">
				<div onclick="loadMenu('sopot')" data-layer="Frame 123" class="Frame123 size- py-1.5  border-stone-400 flex justify-center items-center gap-2.5">
					<div id="btn-sopot" data-layer="Sopot" class="Sopot justify-start text-stone-400 text-xl font-bold font-['Mulish']">Sopot</div>
				</div>
				<div onclick="loadMenu('jastarnia')" data-layer="Frame 124" class="Frame124 size- py-1.5 flex justify-center items-center gap-2.5">
					<div id="btn-jastarnia" data-layer="Jastarnia" class="Jastarnia justify-start text-zinc-800 text-xl font-bold font-['Mulish']">Jastarnia</div>
				</div>
			</div>
		</div>
		<div id="menu-container" class="w-full"></div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

<script>
	function loadMenu(location) {
		const kategorieTarget = document.querySelector('.Kategorie'); // Get .Kategorie div
		kategorieTarget.innerHTML = '';

		fetch(`/wp-admin/admin-ajax.php?action=load_menu&location=${location}`)
			.then(response => {
				if (!response.ok) throw new Error('Menu not found');
				return response.text();
			})
			.then(html => {
				document.getElementById('menu-container').innerHTML = html;
				setActiveButton(location); // update active button style

				const titleDivs = document.querySelectorAll('#menu-container div[data-layer="Title"]');

				titleDivs.forEach((titleDiv, index) => {
					const firstChildDiv = titleDiv.querySelector('div'); // Get first inner div
					if (firstChildDiv) {



						const text = firstChildDiv.textContent.trim(); // Get its text
						console.log('Title:', text);

						titleDiv.setAttribute('data-bs-toggle', 'collapse');
						titleDiv.setAttribute('data-bs-target', `#${'collapse-' + index}`);
						titleDiv.setAttribute('aria-expanded', 'true');
						titleDiv.setAttribute('aria-controls', 'collapse-' + index);

						firstChildDiv.nextElementSibling.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <mask id="mask0_4012_25807" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
    <rect x="24" y="-6.10352e-05" width="24" height="24" transform="rotate(90 24 -6.10352e-05)" fill="#D9D9D9"/>
  </mask>
  <g mask="url(#mask0_4012_25807)">
    <path d="M12.0002 10.7999L8.10019 14.6999C7.91686 14.8833 7.68353 14.9749 7.40019 14.9749C7.11686 14.9749 6.88353 14.8833 6.7002 14.6999C6.51686 14.5166 6.42519 14.2833 6.42519 13.9999C6.42519 13.7166 6.51686 13.4833 6.7002 13.2999L11.3002 8.69993C11.4002 8.59993 11.5085 8.52909 11.6252 8.48743C11.7419 8.44576 11.8669 8.42493 12.0002 8.42493C12.1335 8.42493 12.2585 8.44576 12.3752 8.48743C12.4919 8.52909 12.6002 8.59993 12.7002 8.69993L17.3002 13.2999C17.4835 13.4833 17.5752 13.7166 17.5752 13.9999C17.5752 14.2833 17.4835 14.5166 17.3002 14.6999C17.1169 14.8833 16.8835 14.9749 16.6002 14.9749C16.3169 14.9749 16.0835 14.8833 15.9002 14.6999L12.0002 10.7999Z" fill="#A9957B"/>
  </g>
</svg>`;
							firstChildDiv.nextElementSibling.classList.remove('bg-stone-400'); // Show the arrow icon


// Add collapse class to the sibling div

						const anchorId = 'title-anchor-' + index;
						titleDiv.setAttribute('id', anchorId);

						// Create new div with the text (e.g. "Espresso")
						const newDiv = document.createElement('div');
						newDiv.setAttribute('data-layer', text);
						newDiv.className = 'Espresso justify-start text-stone-400 text-lg font-bold font-[\'Mulish\'] leading-relaxed';
						newDiv.textContent = text;

						newDiv.addEventListener('click', () => {
							const yOffset = -150;
							const y = titleDiv.getBoundingClientRect().top + window.scrollY + yOffset;
							window.scrollTo({
								top: y,
								behavior: 'smooth'
							});
						});

						// Append to nearest .Kategorie
						if (kategorieTarget) {
							kategorieTarget.appendChild(newDiv);
						} else {
							console.warn('No .Kategorie found for:', titleDiv);
						}

						const nextElement = titleDiv.nextElementSibling;
						if (nextElement && nextElement.classList.contains('KartaProduktu')) {
							nextElement.id = 'collapse-' + index; // Set ID for collapse
							nextElement.classList.add('collapse'); // Add collapse class
						}

					}
				});
			})
			.catch(err => {
				console.error('Error loading menu:', err);
				document.getElementById('menu-container').innerHTML = '<p class="text-red-500">Error loading menu</p>';
			});
	}


	function setActiveButton(location) {
		const btnSopot = document.getElementById('btn-sopot');
		const btnJastarnia = document.getElementById('btn-jastarnia');

		if (location === 'sopot') {
			btnSopot.classList.add('text-stone-400', 'border-b-2', 'border-stone-400');
			btnSopot.classList.remove('text-zinc-800');
			btnJastarnia.classList.remove('text-stone-400', 'border-b-2', 'border-stone-400');
			btnJastarnia.classList.add('text-zinc-800');
		} else {
			btnJastarnia.classList.add('text-stone-400', 'border-b-2', 'border-stone-400');
			btnJastarnia.classList.remove('text-zinc-800');
			btnSopot.classList.remove('text-stone-400', 'border-b-2', 'border-stone-400');
			btnSopot.classList.add('text-zinc-800');
		}
	}

	// Load Sopot menu by default on page load
	document.addEventListener('DOMContentLoaded', () => {
		loadMenu('sopot');
	});
</script>

<?php get_footer(); ?>
