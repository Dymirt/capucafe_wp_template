<?php
defined('ABSPATH') || exit;

get_header('shop');

global $post;

// Conditionally load your custom template for "praliny"
if ($post && $post->post_type === 'product' && $post->post_name === 'praliny') {
	global $product;
	$product = wc_get_product($post); // ✅ setup $product
	setup_postdata($post);            // ✅ prepare WordPress loop vars
	include get_stylesheet_directory() . '/woocommerce/single-product/praliny.php';
} else {
	woocommerce_content();
}

get_footer('shop');
