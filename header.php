<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

$count = WC()->cart->get_cart_contents_count();

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<?php do_action('storefront_before_site'); ?>


	<div id="page" class="hfeed site">



		<?php do_action('storefront_before_header'); ?>

		<header id="masthead" class="w-80  min-w-80 px-5 left-0 top-0 a\ bg-gradient-to-l from-black/0 via-black/30 to-black/70 inline-flex justify-between items-center fixed z-50" role="banner" style="<?php storefront_header_styles(); ?>">
			<?php
			/**
			 * Functions hooked into storefront_header action
			 *
			 * @hooked storefront_header_container                 - 0
			 * @hooked storefront_skip_links                       - 5
			 * @hooked storefront_social_icons                     - 10
			 * @hooked storefront_site_branding                    - 20
			 * @hooked storefront_secondary_navigation             - 30
			 * @hooked storefront_product_search                   - 40
			 * @hooked storefront_header_container_close           - 41
			 *
			 * @hooked storefront_primary_navigation_wrapper       - 42
			 * @hooked storefront_primary_navigation               - 50
			 * @hooked storefront_header_cart                      - 60
			 * @hooked storefront_primary_navigation_wrapper_close - 68
			 */
			//do_action('storefront_header');
			?>
		</header><!-- #masthead -->
		<?php get_template_part('headers/header', 'shop'); ?>

		<div id="menu-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-[2]"></div>
		<!-- Side Menu -->
		<div id="side-menu" class="fixed inset-0 shadow-lg transform translate-x-full transition-transform duration-300 z-[4] overflow-y-auto bg-transparent">
			<div class="p-4 border-b flex justify-end items-center h-[100px]">
				<div id="menu-close" class="hover:colour-red">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<mask id="mask0_419_5348" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
							<rect width="24" height="24" fill="#D9D9D9" />
						</mask>
						<g mask="url(#mask0_419_5348)">
							<path d="M12 13.4L7.09999 18.3C6.91665 18.4834 6.68332 18.575 6.39999 18.575C6.11665 18.575 5.88332 18.4834 5.69999 18.3C5.51665 18.1167 5.42499 17.8834 5.42499 17.6C5.42499 17.3167 5.51665 17.0834 5.69999 16.9L10.6 12L5.69999 7.10005C5.51665 6.91672 5.42499 6.68338 5.42499 6.40005C5.42499 6.11672 5.51665 5.88338 5.69999 5.70005C5.88332 5.51672 6.11665 5.42505 6.39999 5.42505C6.68332 5.42505 6.91665 5.51672 7.09999 5.70005L12 10.6L16.9 5.70005C17.0833 5.51672 17.3167 5.42505 17.6 5.42505C17.8833 5.42505 18.1167 5.51672 18.3 5.70005C18.4833 5.88338 18.575 6.11672 18.575 6.40005C18.575 6.68338 18.4833 6.91672 18.3 7.10005L13.4 12L18.3 16.9C18.4833 17.0834 18.575 17.3167 18.575 17.6C18.575 17.8834 18.4833 18.1167 18.3 18.3C18.1167 18.4834 17.8833 18.575 17.6 18.575C17.3167 18.575 17.0833 18.4834 16.9 18.3L12 13.4Z" fill="#333333" />
						</g>
					</svg>
				</div>
			</div>
			<div class="collapse duration-150"></div> <!--tailwindcss collapse class to hide the menu items by default-->
			<?php
			wp_nav_menu([
				'theme_location' => 'mobile-menu',
				'walker'         => new Header_Walker_Nav_Menu(),
				'container'      => false,
				'items_wrap'     => '%3$s', // no ul
				'fallback_cb'    => '',     // IMPORTANT! <- Empty string, not false!
			]);
			?>
		</div>

		<script>
			function openMenu() {
				const sideMenu = document.getElementById('side-menu');
				const overlay = document.getElementById('menu-overlay');
				const menuClose = document.getElementById('menu-close');

				sideMenu.classList.remove('translate-x-full');
				overlay.classList.remove('hidden');
				menuClose.addEventListener('click', closeMenu);
				overlay.addEventListener('click', closeMenu);

				document.addEventListener('keydown', function(e) {
					if (e.key === 'Escape') closeMenu();
				});

			};

			function closeMenu() {
				const sideMenu = document.getElementById('side-menu');
				const overlay = document.getElementById('menu-overlay');
				sideMenu.classList.add('translate-x-full');
				overlay.classList.add('hidden');
			};

			function toggleMenuSiblings(button) {
				const parent = button.parentNode.parentNode; // Get the parent of the button's parent (the menu item)
				const siblings = Array.from(parent.children).slice(1);

				console.log(siblings);

				const areHidden = siblings
					.filter(el => el !== button)
					.every(el => el.classList.contains('!collapse'));

				siblings.forEach(el => {
					if (el !== button) {
						if (areHidden) {
							el.classList.remove('!collapse');
							button.querySelector('.BoundingBox').classList.remove('rotate-180');
						} else {
							el.classList.add('!collapse');
							button.querySelector('.BoundingBox').classList.add('rotate-180');
						}
					}
				});
			};

			document.addEventListener('DOMContentLoaded', () => {
				document.querySelectorAll('.menu-item-swap').forEach((el) => {
					const link = el.querySelector('a');
					if (link) {
						const href = link.getAttribute('href');
						const text = link.textContent || link.innerText;

						if (text.trim().toLowerCase().endsWith('-swap')) {
							let cleanText = text.trim().slice(0, -5); // remove "-swap"

							// Create new wrapper
							const newDiv = document.createElement('div');
							newDiv.className = 'relative h-full';
							newDiv.innerHTML = `
					<a href="${href}" class="text-stone-700 hover:underline">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/${cleanText.toLowerCase()}-icon.png"
						     class="!w-full !h-full object-cover rounded mb-2" alt="${cleanText} Icon">
						<div class="absolute left-8 top-1/2 -translate-y-1/2 text-center text-4xl text-left text-white font-['Didot_LT_Pro']">
							${cleanText}
						</div>
					</a>
				`;

							// Move newDiv to be sibling after el's parent
							const parent = el.parentElement;
							const grandparent = parent?.parentElement;

							if (parent && grandparent) {
								grandparent.insertBefore(newDiv, parent.nextSibling);
								el.remove(); // remove original
								//if parent is empty, remove it
								if (parent.children.length === 0) {
									parent.remove();
								}
							}
						}
					}
				});
			});
		</script>

		<?php
		/**
		 * Functions hooked in to storefront_before_content
		 *
		 * @hooked storefront_header_widget_region - 10
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action('storefront_before_content');
		?>

		<div id="content" class="site-content" tabindex="-1">
			<?php if (
				is_front_page()
				|| is_page('o-nas')
				|| is_page('menu')
				|| is_page('torty-weselne')
				|| is_page('torty-okazjonalne')
				|| is_page('rozana-romantyka')
				|| is_page('naturalna-elegancja')
				|| is_page('lesna-harmonia')
			): ?>
				<!-- Homepage -->
				<div class="w-full ">
				<?php else : ?>
					<!-- Not homepage -->
					<div class="col-full">
					<?php endif; ?>

					<?php
					do_action('storefront_content_top');
