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

		<header id="masthead" class="w-80 z-1 min-w-80 px-5 left-0 top-0 absolute bg-gradient-to-l from-black/0 via-black/30 to-black/70 inline-flex justify-between items-center fixed top-0 " role="banner" style="<?php storefront_header_styles(); ?>">
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

		<div data-property-1="mobile 2" class=" z-1 fixed w-full min-w-80 px-5 left-0 top-0 absolute bg-gradient-to-l from-black/0 via-black/30 to-black/70 inline-flex justify-between items-center">
			<div class="max-w-40 inline-flex flex-col justify-start items-start overflow-hidden">
				<div class="w-28 h-8 relative overflow-hidden">
					<?php echo get_custom_logo(); ?>
				</div>
			</div>
			<div class="h-16 flex justify-center items-center gap-4">
				<a href="http://cappucino.local/moje-konto/" data-property-1="Default" class="w-6 h-7 relative overflow-hidden">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
						<path d="M15.71 13.21C16.6904 12.4386 17.406 11.3809 17.7572 10.1839C18.1085 8.98694 18.0779 7.71024 17.6698 6.53145C17.2617 5.35265 16.4963 4.33037 15.4801 3.60683C14.4639 2.8833 13.2474 2.49448 12 2.49448C10.7525 2.49448 9.53611 2.8833 8.51993 3.60683C7.50374 4.33037 6.73834 5.35265 6.33021 6.53145C5.92208 7.71024 5.89151 8.98694 6.24276 10.1839C6.59401 11.3809 7.3096 12.4386 8.29 13.21C6.61007 13.883 5.14428 14.9993 4.04889 16.4399C2.95349 17.8805 2.26956 19.5913 2.07 21.39C2.05555 21.5213 2.06711 21.6542 2.10402 21.781C2.14093 21.9079 2.20246 22.0262 2.28511 22.1293C2.45202 22.3375 2.69478 22.4708 2.96 22.5C3.22521 22.5292 3.49116 22.4518 3.69932 22.2849C3.90749 22.118 4.04082 21.8752 4.07 21.61C4.28958 19.6552 5.22168 17.8498 6.68822 16.5388C8.15475 15.2278 10.0529 14.503 12.02 14.503C13.9871 14.503 15.8852 15.2278 17.3518 16.5388C18.8183 17.8498 19.7504 19.6552 19.97 21.61C19.9972 21.8557 20.1144 22.0826 20.2991 22.247C20.4838 22.4114 20.7228 22.5015 20.97 22.5H21.08C21.3421 22.4698 21.5817 22.3373 21.7466 22.1312C21.9114 21.9252 21.9881 21.6623 21.96 21.4C21.7595 19.5962 21.0719 17.881 19.9708 16.4382C18.8698 14.9954 17.3969 13.8795 15.71 13.21ZM12 12.5C11.2089 12.5 10.4355 12.2654 9.77772 11.8259C9.11992 11.3863 8.60723 10.7616 8.30448 10.0307C8.00173 9.29981 7.92251 8.49554 8.07686 7.71962C8.2312 6.94369 8.61216 6.23096 9.17157 5.67155C9.73098 5.11214 10.4437 4.73118 11.2196 4.57684C11.9956 4.4225 12.7998 4.50171 13.5307 4.80446C14.2616 5.10721 14.8863 5.6199 15.3259 6.2777C15.7654 6.93549 16 7.70885 16 8.49998C16 9.56084 15.5786 10.5783 14.8284 11.3284C14.0783 12.0786 13.0609 12.5 12 12.5Z" fill="white" />
					</svg>
				</a>
				<a href="http://cappucino.local/koszyk/" data-property-1="Default" class="w-6 h-6 relative overflow-hidden">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="21" viewBox="0 0 16 21" fill="none">
						<path d="M15 5.49998H12V4.49998C12 3.43911 11.5786 2.4217 10.8284 1.67155C10.0783 0.921405 9.06087 0.499977 8 0.499977C6.93913 0.499977 5.92172 0.921405 5.17157 1.67155C4.42143 2.4217 4 3.43911 4 4.49998V5.49998H1C0.734784 5.49998 0.48043 5.60533 0.292893 5.79287C0.105357 5.98041 0 6.23476 0 6.49998V17.5C0 18.2956 0.316071 19.0587 0.87868 19.6213C1.44129 20.1839 2.20435 20.5 3 20.5H13C13.7956 20.5 14.5587 20.1839 15.1213 19.6213C15.6839 19.0587 16 18.2956 16 17.5V6.49998C16 6.23476 15.8946 5.98041 15.7071 5.79287C15.5196 5.60533 15.2652 5.49998 15 5.49998ZM6 4.49998C6 3.96954 6.21071 3.46084 6.58579 3.08576C6.96086 2.71069 7.46957 2.49998 8 2.49998C8.53043 2.49998 9.03914 2.71069 9.41421 3.08576C9.78929 3.46084 10 3.96954 10 4.49998V5.49998H6V4.49998ZM14 17.5C14 17.7652 13.8946 18.0195 13.7071 18.2071C13.5196 18.3946 13.2652 18.5 13 18.5H3C2.73478 18.5 2.48043 18.3946 2.29289 18.2071C2.10536 18.0195 2 17.7652 2 17.5V7.49998H4V8.49998C4 8.76519 4.10536 9.01955 4.29289 9.20708C4.48043 9.39462 4.73478 9.49998 5 9.49998C5.26522 9.49998 5.51957 9.39462 5.70711 9.20708C5.89464 9.01955 6 8.76519 6 8.49998V7.49998H10V8.49998C10 8.76519 10.1054 9.01955 10.2929 9.20708C10.4804 9.39462 10.7348 9.49998 11 9.49998C11.2652 9.49998 11.5196 9.39462 11.7071 9.20708C11.8946 9.01955 12 8.76519 12 8.49998V7.49998H14V17.5Z" fill="white" />
					</svg>
					<div class="w-2.5 h-2.5 left-[13px] top-[13px] absolute bg-red-500 rounded-[30px] inline-flex flex-col justify-center items-center gap-2.5">
						<div class="justify-center text-white text-[6px] font-extrabold font-['Mulish'] uppercase leading-[7.80px]"><?php echo WC()->cart->get_cart_contents_count() ?></div>
					</div>
				</a>
				<div id="menu-toggle" class="w-6 h-6 relative overflow-hidden">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 25" fill="none">
						<path d="M3 7.49998H21C21.2652 7.49998 21.5196 7.39462 21.7071 7.20708C21.8946 7.01955 22 6.76519 22 6.49998C22 6.23476 21.8946 5.98041 21.7071 5.79287C21.5196 5.60533 21.2652 5.49998 21 5.49998H3C2.73478 5.49998 2.48043 5.60533 2.29289 5.79287C2.10536 5.98041 2 6.23476 2 6.49998C2 6.76519 2.10536 7.01955 2.29289 7.20708C2.48043 7.39462 2.73478 7.49998 3 7.49998ZM21 17.5H3C2.73478 17.5 2.48043 17.6053 2.29289 17.7929C2.10536 17.9804 2 18.2348 2 18.5C2 18.7652 2.10536 19.0195 2.29289 19.2071C2.48043 19.3946 2.73478 19.5 3 19.5H21C21.2652 19.5 21.5196 19.3946 21.7071 19.2071C21.8946 19.0195 22 18.7652 22 18.5C22 18.2348 21.8946 17.9804 21.7071 17.7929C21.5196 17.6053 21.2652 17.5 21 17.5ZM21 11.5H3C2.73478 11.5 2.48043 11.6053 2.29289 11.7929C2.10536 11.9804 2 12.2348 2 12.5C2 12.7652 2.10536 13.0195 2.29289 13.2071C2.48043 13.3946 2.73478 13.5 3 13.5H21C21.2652 13.5 21.5196 13.3946 21.7071 13.2071C21.8946 13.0195 22 12.7652 22 12.5C22 12.2348 21.8946 11.9804 21.7071 11.7929C21.5196 11.6053 21.2652 11.5 21 11.5Z" fill="white" />
					</svg>

				</div>
			</div>
		</div>

		<!-- Overlay Background -->
		<div id="menu-overlay" class="fixed inset-0 bg-black/50 z-40 hidden"></div>

		<!-- Side Menu -->
		<div id="side-menu" class="fixed top-0 right-0 w-64 h-full bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-50">
			<div class="p-4 border-b flex justify-between items-center">
				<h2 class="text-lg font-bold">Menu</h2>
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
			<?php
			wp_nav_menu([
				'theme_location' => 'mobile-menu',
			]);
			?>
		</div>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				const menuToggle = document.getElementById('menu-toggle');
				const menuClose = document.getElementById('menu-close');
				const sideMenu = document.getElementById('side-menu');
				const overlay = document.getElementById('menu-overlay');

				function openMenu() {
					sideMenu.classList.remove('translate-x-full');
					overlay.classList.remove('hidden');
				}

				function closeMenu() {
					sideMenu.classList.add('translate-x-full');
					overlay.classList.add('hidden');
				}

				menuToggle.addEventListener('click', openMenu);
				menuClose.addEventListener('click', closeMenu);
				overlay.addEventListener('click', closeMenu);

				// Optional: close with ESC key
				document.addEventListener('keydown', function(e) {
					if (e.key === 'Escape') closeMenu();
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
			<?php if (is_front_page()) : ?>
				<!-- Homepage -->
				<div class="w-full ">
				<?php else : ?>
					<!-- Not homepage -->
					<div class="col-full">
					<?php endif; ?>

					<?php
					do_action('storefront_content_top');
