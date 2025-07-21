<?php

// Enqueue scripts/styles
require_once get_stylesheet_directory() . '/inc/functions/enqueue.php';

// Register custom post types
require_once get_stylesheet_directory() . '/inc/custom-post-types/slodki-stol.php';
require_once get_stylesheet_directory() . '/inc/custom-post-types/praliny_candy.php';
require_once get_stylesheet_directory() . '/inc/custom-post-types/smaki-tortow.php';

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

add_action('init', function () {
	remove_action('woocommerce_product_loop_start', 'woocommerce_product_loop_start', 10);
	remove_action('woocommerce_product_loop_end', 'woocommerce_product_loop_end', 10);
});

add_action('init', function () {
	remove_shortcode('best_selling_products');
	add_shortcode('best_selling_products', 'my_custom_best_selling_products_shortcode');
}, 100);


add_action('template_redirect', function () {
	if (is_cart()) {
		remove_action('storefront_sidebar', 'storefront_get_sidebar', 10);
	}
});

function my_custom_best_selling_products_shortcode($atts)
{
	ob_start();

	$atts = shortcode_atts(array(
		'limit' => 6,
	), $atts, 'best_selling_products');

	$query = new WP_Query(array(
		'post_type' => 'product',
		'posts_per_page' => intval($atts['limit']),
		'meta_key' => 'total_sales',
		'orderby' => 'meta_value_num',
	));

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			wc_get_template_part('content', 'product');
		}
	}

	wp_reset_postdata();

	return ob_get_clean();
}


function custom_recent_posts_shortcode()
{
	ob_start();
	$recent_posts = new WP_Query(array(
		'post_type'      => 'post',
		'posts_per_page' => 10,
	));

	if ($recent_posts->have_posts()) :
		echo '<div class="self-stretch flex flex-col md:flex-row justify-start items-center gap-10">';
		while ($recent_posts->have_posts()) : $recent_posts->the_post();
	?>
			<article class="self-stretch flex flex-col justify-start items-start md:basis-64">
				<a href="<?php the_permalink(); ?>">
					<?php if (has_post_thumbnail()) : ?>
						<img class="!h-[220px] !w-full object-cover" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title_attribute(); ?>">
					<?php else : ?>
						<img src="https://placehold.co/280x220" alt="Placeholder">
					<?php endif; ?>
				</a>
				<div class="self-stretch flex flex-col justify-start items-start">
					<div class="self-stretch pt-4 pb-2 inline-flex justify-start items-start gap-3">
						<div class="justify-start text-zinc-500 text-xs font-normal font-['Mulish']">
							<?php echo get_the_date('d F Y'); // example: 25 stycznia 2025
							?>
						</div>
					</div>
					<div class="self-stretch border-stone-400 flex flex-col justify-start gap-2.5">
						<a href="<?php the_permalink(); ?>" class="font-bold !text-black font-['Mulish'] leading-snug">
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


function page_url_by_slug($slug)
{
	$page = get_page_by_path($slug);
	return $page ? get_permalink($page->ID) : '#';
}


add_filter('template_include', function ($template) {
	if (is_singular('product')) {
		global $post;
		if ($post && $post->post_name === 'praliny') {
			$custom_template = get_stylesheet_directory() . '/woocommerce/single-product/praliny.php';
			if (file_exists($custom_template)) {
				return $custom_template;
			}
		}
	}
	return $template;
});



add_action('template_redirect', function () {
	if (is_singular('product') && get_post_field('post_name', get_post()) === 'praliny') {
		remove_action('storefront_sidebar', 'storefront_get_sidebar', 10);
	}
});

/*
add_filter('woocommerce_get_item_data', function ($item_data, $cart_item) {
	if (!empty($cart_item['custom_candies'])) {
		foreach ($cart_item['custom_candies'] as $candy) {
			$item_data[] = [
				'key'   => esc_html($candy['name']),
				'value' => esc_html($candy['quantity']) . ' szt.'
			];
		}
	}
	if (!empty($cart_item['box_size'])) {
		$item_data[] = [
			'key'   => 'Rozmiar pudełka',
			'value' => esc_html($cart_item['box_size'])
		];
	}
	return $item_data;
}, 10, 2);
*/

// Praliny debugging
//add_action('woocommerce_before_cart', function () {
//	foreach (WC()->cart->get_cart() as $cart_item) {
//		echo '<pre>';
//		print_r($cart_item);
//		echo '</pre>';
//	}
//});

// Add custom candies and box size to order item meta
add_action('woocommerce_add_order_item_meta', function ($item_id, $values) {
	if (!empty($values['custom_candies'])) {
		$summary = '';
		foreach ($values['custom_candies'] as $candy) {
			$summary .= $candy['name'] . ' x ' . $candy['quantity'] . ', ';
		}
		$summary = rtrim($summary, ', ');
		wc_add_order_item_meta($item_id, 'Praliny', $summary);
	}
	if (!empty($values['box_size'])) {
		wc_add_order_item_meta($item_id, 'Rozmiar pudełka', $values['box_size']);
	}
}, 10, 2);


// AJAX handler to load shop header
add_action('wp_ajax_nopriv_load_shop_header', 'load_shop_header');
add_action('wp_ajax_load_shop_header', 'load_shop_header');

function load_shop_header()
{
	get_template_part('headers/header', 'shop'); // loads header-shop.php
	wp_die(); // stops further processing
}

// Add custom candies and box size to order item meta
add_filter('woocommerce_order_item_display_meta_key', function ($display_key, $meta_key) {
	if ($meta_key === 'Wybrane praliny') {
		$display_key = __('Wybrane praliny', 'woocommerce');
	}
	return $display_key;
}, 10, 2);

// Add custom candies and box size to cart item data
add_filter('woocommerce_add_cart_item_data', function ($cart_item_data, $product_id, $variation_id) {
	if (!empty($_POST['custom_candies'])) {
		$cart_item_data['custom_candies'] = json_decode(stripslashes($_POST['custom_candies']), true);
	}

	if (!empty($_POST['box_size'])) {
		$cart_item_data['box_size'] = sanitize_text_field($_POST['box_size']);
	}

	return $cart_item_data;
}, 10, 3);



// Display custom candies and box size in cart item name
add_filter('woocommerce_cart_item_name', function ($product_name, $cart_item, $cart_item_key) {
	if (!empty($cart_item['custom_candies'])) {
		$output = '<ul class="custom-candies-list" style="margin-top: 8px; font-size: 0.875rem;">';
		foreach ($cart_item['custom_candies'] as $candy) {
			$output .= '<li><strong>' . esc_html($candy['name']) . '</strong>: ' . esc_html($candy['quantity']) . ' szt.</li>';
		}
		$output .= '</ul>';
		$product_name .= $output;
	}

	if (!empty($cart_item['box_size'])) {
		$product_name .= '<div class="box-size-info" style="font-size: 0.875rem; color: #777;">Rozmiar pudełka: ' . esc_html($cart_item['box_size']) . '</div>';
	}

	return $product_name;
}, 10, 3);



// AJAX handler to load custom menus based on location
add_action('wp_ajax_load_menu', 'load_custom_menu');
add_action('wp_ajax_nopriv_load_menu', 'load_custom_menu');

function load_custom_menu()
{
	$location = $_GET['location'] ?? 'sopot';

	if ($location === 'sopot') {
		include get_stylesheet_directory() . '/inc/sopot-menu.php';
	} elseif ($location === 'jastarnia') {
		include get_stylesheet_directory() . '/inc/jastarnia-menu.php';
	} else {
		http_response_code(400);
		echo 'Invalid menu';
	}

	wp_die(); // important
}

// Remove storefront_woocommerce_brands from homepage
add_action('init', function () {
	remove_action('homepage', 'storefront_woocommerce_brands', 40);
});

// Hide shipping address for local pickup
add_filter('woocommerce_cart_needs_shipping_address', 'conditionally_hide_shipping_address', 10, 1);

function conditionally_hide_shipping_address($needs_shipping)
{
	$chosen_methods = WC()->session->get('chosen_shipping_methods');

	if (is_array($chosen_methods) && isset($chosen_methods[0])) {
		$shipping_method = $chosen_methods[0];

		// Replace "local_pickup" with the method ID you want to hide address for
		if (strpos($shipping_method, 'local_pickup') !== false) {
			return false; // Do not show shipping address
		}
	}

	return $needs_shipping;
}


add_action('wp_footer', function () {
	if (!is_checkout()) return;
	?>
	<script>
	document.addEventListener('DOMContentLoaded', function () {
		const fieldIds = [
			'billing_address_1_field',
			'billing_address_2_field',
			'billing_postcode_field',
			'billing_city_field',
			'billing_state_field',
		];

		function toggleBillingFields() {
			const selected = document.querySelector('input[name^="shipping_method"]:checked');
			const isPickup = selected && selected.value.includes('local_pickup');

			fieldIds.forEach(id => {
				const field = document.getElementById(id);
				if (field) {
					field.style.display = isPickup ? 'none' : '';
				}
			});
		}

		// Use small delay to ensure WooCommerce fields are fully initialized
		setTimeout(toggleBillingFields, 100);

		// Also run again after changes
		document.querySelectorAll('input[name^="shipping_method"]').forEach(input => {
			input.addEventListener('change', toggleBillingFields);
		});
	});
	</script>
	<?php
});

add_filter('woocommerce_checkout_fields', function ($fields) {
	$chosen_methods = WC()->session->get('chosen_shipping_methods');
	$local_pickup = isset($chosen_methods[0]) && strpos($chosen_methods[0], 'local_pickup') !== false;

	if ($local_pickup) {
		$fields['billing']['billing_address_1']['required'] = false;
		$fields['billing']['billing_postcode']['required'] = false;
		$fields['billing']['billing_city']['required'] = false;
		unset($fields['billing']['billing_postcode']['validate']);

	}
	return $fields;
});
