<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

//$count = WC()->cart->get_cart_contents_count();

$count = 0;

if ( function_exists( 'WC' ) ) {
    $wc = WC();

    if ( $wc && isset( $wc->cart ) && $wc->cart instanceof WC_Cart ) {
        $count = $wc->cart->get_cart_contents_count();
    }
}

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

        <dialog id="side-menu" class="ccafe-mobile-menu" aria-label="Menu główne">
            <div class="ccafe-menu-heading"><span>Menu</span><button type="button" id="menu-close" aria-label="Zamknij menu">×</button></div>
            <nav aria-label="Nawigacja mobilna">
                <?php wp_nav_menu([
                    'theme_location' => 'mobile-menu', 'walker' => new Header_Walker_Nav_Menu(),
                    'container' => false, 'items_wrap' => '%3$s', 'fallback_cb' => '',
                ]); ?>
            </nav>
        </dialog>

		<script>
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
				|| is_page('o-nas') // TODO redo with container
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
					<h1 class="hidden"><?php echo esc_html(wp_get_document_title()); ?></h1>
<?php
$desc = '';

if ( function_exists('is_product_category') && is_product_category() ) {
    // Product category archive
    $term = get_queried_object(); // WP_Term
    $desc = get_term_meta( $term->term_id, 'wpseo_desc', true );

    if ( ! $desc && function_exists('wpseo_replace_vars') ) {
        $opts = get_option( 'wpseo_titles', [] );
        $raw  = $opts['metadesc-tax-product_cat'] ?? '';
        if ( $raw ) { $desc = wpseo_replace_vars( $raw, $term ); }
    }

} elseif ( function_exists('is_product_tag') && is_product_tag() ) {
    // Product tag archive
    $term = get_queried_object(); // WP_Term
    $desc = get_term_meta( $term->term_id, 'wpseo_desc', true );

    if ( ! $desc && function_exists('wpseo_replace_vars') ) {
        $opts = get_option( 'wpseo_titles', [] );
        $raw  = $opts['metadesc-tax-product_tag'] ?? '';
        if ( $raw ) { $desc = wpseo_replace_vars( $raw, $term ); }
    }

} elseif ( function_exists('is_shop') && is_shop() ) {
    // WooCommerce Shop (product archive)
    $shop_id = wc_get_page_id( 'shop' );          // actual Page ID behind /sklep/
    $desc    = get_post_meta( $shop_id, '_yoast_wpseo_metadesc', true );

    if ( ! $desc && function_exists('wpseo_replace_vars') ) {
        $opts = get_option( 'wpseo_titles', [] );
        // Yoast template for product post type archive
        $raw  = $opts['metadesc-ptarchive-product'] ?? '';
        if ( $raw ) { $desc = wpseo_replace_vars( $raw, get_post( $shop_id ) ); }
    }

} else {
    // Fallback for other singulars
    $post_id = get_queried_object_id();
    if ( $post_id ) {
        $desc = get_post_meta( $post_id, '_yoast_wpseo_metadesc', true );
    }
}

// Optional last-resort fallback:
if ( ! $desc ) {
    // DON’T force something if you truly want “Yoast meta only”;
    // otherwise you can use site tagline or nothing.
    // $desc = get_bloginfo('description');
}
?>
<?php if ( $desc ) : ?>
    <h2 class="hidden"><?php echo esc_html( $desc ); ?></h2>
<?php endif; ?>					<?php
					do_action('storefront_content_top');
