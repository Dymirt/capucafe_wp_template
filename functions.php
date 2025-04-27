<?php

// Enqueue scripts/styles
require_once get_stylesheet_directory() . '/inc/functions/enqueue.php';

// Register custom post types
require_once get_stylesheet_directory() . '/inc/custom-post-types/slodki-stol.php';
require_once get_stylesheet_directory() . '/inc/functions/menu.php';


// Unhook All Default Storefront Homepage Sections
require_once get_stylesheet_directory() . '/inc/functions/storefront.php';

/**
 * The header container
 */
function storefront_header_container()
{
	echo '<div class="max-w-40 inline-flex flex-col justify-start items-start overflow-hidden">';
}

function storefront_primary_navigation_wrapper()
{
	echo '<div class="storefront-primary-navigation"><div class="h-16 flex justify-center items-center gap-4">';
}

/**
 * Site branding wrapper and display
 */

function storefront_site_title_or_logo($echo = true)
{
	if (function_exists('the_custom_logo') && has_custom_logo()) {
		$logo = get_custom_logo();
		$html = is_home() ? '<h1 class="w-28 h-8 relative overflow-hidden">' . $logo . '</h1>' : '<div class="w-28 h-8 relative overflow-hidden"' . $logo . '</div>';
	} else {
		$tag = is_home() ? 'h1' : 'div';

		$html = '<' . esc_attr($tag) . ' class="beta site-title"><a href="' . esc_url(home_url('/')) . '" rel="home">' . esc_html(get_bloginfo('name')) . '</a></' . esc_attr($tag) . '>';

		if ('' !== get_bloginfo('description')) {
			$html .= '<p class="site-description">' . esc_html(get_bloginfo('description', 'display')) . '</p>';
		}
	}

	if (! $echo) {
		return $html;
	}

	echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

function storefront_site_branding()
{
?>
	<div class="max-w-40 inline-flex flex-col justify-start items-start overflow-hidden">
		<?php storefront_site_title_or_logo(); ?>
	</div>
<?php
}

add_action('init', function() {
    remove_action( 'woocommerce_product_loop_start', 'woocommerce_product_loop_start', 10 );
    remove_action( 'woocommerce_product_loop_end', 'woocommerce_product_loop_end', 10 );
});

add_action('init', function() {
    remove_shortcode('best_selling_products');
    add_shortcode('best_selling_products', 'my_custom_best_selling_products_shortcode');
}, 100);

function my_custom_best_selling_products_shortcode( $atts ) {
    ob_start();

    $atts = shortcode_atts( array(
        'limit' => 6,
    ), $atts, 'best_selling_products' );

    $query = new WP_Query( array(
        'post_type' => 'product',
        'posts_per_page' => intval( $atts['limit'] ),
        'meta_key' => 'total_sales',
        'orderby' => 'meta_value_num',
    ) );

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            wc_get_template_part( 'content', 'product' );
        }
    }

    wp_reset_postdata();

    return ob_get_clean();
}


function custom_recent_posts_shortcode() {
    ob_start();
    $recent_posts = new WP_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
    ));

    if ( $recent_posts->have_posts() ) :
        echo '<div class="self-stretch flex flex-col justify-start items-center gap-10">';
        while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
            ?>
            <article class="self-stretch flex flex-col justify-start items-start">
                <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <img class="w-full aspect-square self-stretch py-4 object-cover" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title_attribute(); ?>">
                    <?php else : ?>
                        <img class="w-full aspect-square self-stretch py-4 object-cover" src="https://placehold.co/280x220" alt="Placeholder">
                    <?php endif; ?>
                </a>
                <div class="self-stretch flex flex-col justify-start items-start">
                    <div class="self-stretch pt-4 pb-2 inline-flex justify-start items-start gap-3">
                        <div class="justify-start text-zinc-500 text-xs font-normal font-['Mulish']">
                            <?php echo get_the_date('d F Y'); // example: 25 stycznia 2025 ?>
                        </div>
                    </div>
                    <div class="self-stretch border-stone-400 flex flex-col justify-start items-center gap-2.5">
                        <a href="<?php the_permalink(); ?>" class="self-stretch justify-start text-zinc-800 text-base font-bold font-['Mulish'] leading-snug">
                            <?php the_title(); ?>
                        </a>
                    </div>
                </div>
            </article>
            <?php
        endwhile;
        echo '</div>';
        wp_reset_postdata();
    else :
        echo '<p>No recent posts found.</p>';
    endif;

    return ob_get_clean();
}
add_shortcode('recent_posts', 'custom_recent_posts_shortcode');
?>
