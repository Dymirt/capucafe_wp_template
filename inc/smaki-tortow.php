<div data-layer="Frame 126" class="Frame126 w-full self-stretch  px-10 py-14 md:px-24 md:py-28 inline-flex flex-col justify-start items-start gap-10">
	<div data-layer="Frame 127" class="Frame127 self-stretch flex flex-col justify-start items-start gap-5">
		<div data-layer="title" class="Title self-stretch inline-flex justify-between items-center">
			<div data-layer="Poznaj smaki tortów" class="PoznajSmakiTortW w-[50%] justify-start text-stone-700 text-2xl md:text-5xl font-normal font-['Didot_LT_Pro'] break-words whitespace-normal overflow-hidden">Poznaj smaki tortów</div>
			<div data-layer="strzalki" class="Strzalki size- flex justify-start items-center gap-2.5">
				<div id="arrow-left" data-layer="Header" data-property-1="default" class="Header size-7 p-2 origin-top-left  rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden">
					<div data-layer="Vector" class="Vector size-3.5 rotate-180"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
							<path d="M12.127 7.94825H0.75C0.537167 7.94825 0.359 7.87642 0.2155 7.73275C0.0718332 7.58925 0 7.41108 0 7.19825C0 6.98542 0.0718332 6.80725 0.2155 6.66375C0.359 6.52008 0.537167 6.44825 0.75 6.44825H12.127L6.95775 1.279C6.80908 1.13033 6.73567 0.956332 6.7375 0.756999C6.7395 0.557665 6.818 0.380416 6.973 0.22525C7.12817 0.0804164 7.30383 0.00541641 7.5 0.00024974C7.69617 -0.00491693 7.87183 0.0700831 8.027 0.22525L14.3672 6.5655C14.4609 6.65917 14.5269 6.75792 14.5652 6.86175C14.6037 6.96558 14.623 7.07775 14.623 7.19825C14.623 7.31875 14.6037 7.43092 14.5652 7.53475C14.5269 7.63858 14.4609 7.73733 14.3672 7.831L8.027 14.1712C7.8885 14.3097 7.717 14.3806 7.5125 14.3837C7.308 14.3869 7.12817 14.3161 6.973 14.1712C6.818 14.0161 6.7405 13.8379 6.7405 13.6367C6.7405 13.4354 6.818 13.2572 6.973 13.102L12.127 7.94825Z" fill="#A9957B" />
						</svg></div>
				</div>
				<div id="arrow-right" data-layer="Header" data-property-1="default" class="Header size-7 p-2 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden">
					<div data-layer="Vector" class="Vector size-3.5 "><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
							<path d="M12.127 7.94825H0.75C0.537167 7.94825 0.359 7.87642 0.2155 7.73275C0.0718332 7.58925 0 7.41108 0 7.19825C0 6.98542 0.0718332 6.80725 0.2155 6.66375C0.359 6.52008 0.537167 6.44825 0.75 6.44825H12.127L6.95775 1.279C6.80908 1.13033 6.73567 0.956332 6.7375 0.756999C6.7395 0.557665 6.818 0.380416 6.973 0.22525C7.12817 0.0804164 7.30383 0.00541641 7.5 0.00024974C7.69617 -0.00491693 7.87183 0.0700831 8.027 0.22525L14.3672 6.5655C14.4609 6.65917 14.5269 6.75792 14.5652 6.86175C14.6037 6.96558 14.623 7.07775 14.623 7.19825C14.623 7.31875 14.6037 7.43092 14.5652 7.53475C14.5269 7.63858 14.4609 7.73733 14.3672 7.831L8.027 14.1712C7.8885 14.3097 7.717 14.3806 7.5125 14.3837C7.308 14.3869 7.12817 14.3161 6.973 14.1712C6.818 14.0161 6.7405 13.8379 6.7405 13.6367C6.7405 13.4354 6.818 13.2572 6.973 13.102L12.127 7.94825Z" fill="#A9957B" />
						</svg></div>
				</div>
			</div>
		</div>
	</div>
	<div data-layer="karusela" class="Karusela w-full overflow-x-auto whitespace-nowrap flex gap-6 snap-x scroll-smooth">
		<?php
		$smaki = get_posts([
			'post_type'      => 'torty_smaki',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
		]);

		foreach ($smaki as $smak):
			setup_postdata($smak);

			$title = get_the_title($smak);
			$image = get_the_post_thumbnail_url($smak, 'medium'); // or 'thumbnail', 'large'
			$opis  = get_post_meta($smak->ID, '_torty_smaki_opis', true);
		?>
			<div data-layer="karta" class="Karta w-60 min-h-72 p-6 md:w-96 md:min-h-72 md:p-10 bg-[#F2EDE7] rounded-sm inline-flex flex-col justify-start items-start gap-6 snap-start shrink-0">
				<div data-layer="Frame 125" class="Frame125 size-20 inline-flex justify-start items-center gap-2.5">
					<img data-layer="<?= esc_attr($title); ?>" class="flex-1 h-20 object-contain" src="<?= esc_url($image ?: 'https://placehold.co/80x80'); ?>" alt="<?= esc_attr($title); ?>" />
				</div>
				<div data-layer="txt" class="Txt self-stretch backdrop-blur-lg flex flex-col justify-center items-start">
					<div class="self-stretch justify-start text-stone-700 text-2xl md:text-3xl font-normal font-['Didot_LT_Pro'] break-words whitespace-normal overflow-hidden"><?= esc_html($title); ?></div>
					<div class="self-stretch justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug break-words whitespace-normal overflow-hidden"><?= esc_html($opis); ?></div>
				</div>
			</div>
		<?php endforeach;
		wp_reset_postdata(); ?>
	</div>
	<div data-layer="Frame 128" class="Frame128 self-stretch flex flex-col justify-start items-center gap-2.5 hidden">
		<div data-layer="Frame 120" class="Frame120 size- inline-flex justify-start items-center gap-2.5">
			<div data-layer="Ellipse 1" class="Ellipse1 size-2 bg-stone-400 rounded-full"></div>
			<div data-layer="Ellipse 2" class="Ellipse2 size-2 bg-stone-300 rounded-full"></div>
			<div data-layer="Ellipse 3" class="Ellipse3 size-2 bg-stone-300 rounded-full"></div>
			<div data-layer="Ellipse 4" class="Ellipse4 size-2 bg-stone-300 rounded-full"></div>
		</div>
	</div>
</div>


<script>
	document.getElementById('arrow-left').addEventListener('click', () => {
		document.querySelector('.Karusela').scrollBy({
			left: -300,
			behavior: 'smooth'
		});
	});

	document.getElementById('arrow-right').addEventListener('click', () => {
		document.querySelector('.Karusela').scrollBy({
			left: 300,
			behavior: 'smooth'
		});
	});
</script>
