<?php

// Unhook All Default Storefront Homepage Sections
function capucafe_remove_storefront_homepage_sections() {
	remove_action( 'homepage', 'storefront_product_categories', 20 );
	remove_action( 'homepage', 'storefront_recent_products', 30 );
	remove_action( 'homepage', 'storefront_featured_products', 40 );
	remove_action( 'homepage', 'storefront_popular_products', 50 );
	remove_action( 'homepage', 'storefront_on_sale_products', 60 );
	remove_action( 'homepage', 'storefront_best_selling_products', 70 );
}
add_action( 'init', 'capucafe_remove_storefront_homepage_sections' );
