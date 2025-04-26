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

function storefront_primary_navigation_wrapper() {
	echo '<div class="storefront-primary-navigation"><div class="h-16 flex justify-center items-center gap-4">';
}

/**
 * Site branding wrapper and display
 */

 function storefront_site_title_or_logo( $echo = true ) {
	if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
		$logo = get_custom_logo();
		$html = is_home() ? '<h1 class="w-28 h-8 relative overflow-hidden">' . $logo . '</h1>' : '<div class="w-28 h-8 relative overflow-hidden"' . $logo . '</div>';
	} else {
		$tag = is_home() ? 'h1' : 'div';

		$html = '<' . esc_attr( $tag ) . ' class="beta site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $tag ) . '>';

		if ( '' !== get_bloginfo( 'description' ) ) {
			$html .= '<p class="site-description">' . esc_html( get_bloginfo( 'description', 'display' ) ) . '</p>';
		}
	}

	if ( ! $echo ) {
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




