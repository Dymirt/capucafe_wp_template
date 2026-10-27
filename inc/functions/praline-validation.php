<?php
/** Validate the actual variation and published flavour IDs, never client names/prices. */
function ccafe_is_praline_product($product_id) {
	$product = wc_get_product($product_id);
	return $product && $product->get_slug() === 'praliny';
}

function ccafe_praline_configuration($product_id, $variation_id, $raw) {
	$variation = wc_get_product($variation_id);
	if (!$variation instanceof WC_Product_Variation || $variation->get_parent_id() !== (int) $product_id) return new WP_Error('variation', 'Wybierz prawidłowy rozmiar pudełka.');
	$attributes = $variation->get_variation_attributes();
	$box = $attributes['attribute_ilosc-sztuk-w-opakowaniu'] ?? '';
	if (!preg_match('/^(6|12|16) sztuk$/D', $box, $match)) return new WP_Error('capacity', 'Ten rozmiar pudełka nie jest obsługiwany.');
	$capacity = (int) $match[1];
	if (!is_string($raw) || strlen($raw) > 8192) return new WP_Error('payload', 'Nieprawidłowe dane zestawu pralin.');
	$candies = json_decode($raw, true);
	if (!is_array($candies) || !array_is_list($candies) || !$candies || count($candies) > $capacity) return new WP_Error('payload', 'Wybierz praliny do swojego pudełka.');
	$normalized = [];
	$total = 0;
	foreach ($candies as $candy) {
		$id = is_array($candy) ? ccafe_integer($candy['id'] ?? null) : false;
		$quantity = is_array($candy) ? ccafe_integer($candy['quantity'] ?? null) : false;
		$post = $id ? get_post($id) : null;
		if (!$quantity || !$post || $post->post_type !== 'praliny_candy' || $post->post_status !== 'publish' || isset($normalized[$id])) return new WP_Error('flavour', 'Wybierz dostępne smaki i dodatnie, całkowite ilości bez duplikatów.');
		$total += $quantity;
		$normalized[$id] = ['id' => $id, 'name' => $post->post_title, 'quantity' => $quantity];
	}
	if ($total !== $capacity) return new WP_Error('total', sprintf('Pudełko musi zawierać dokładnie %d pralin. Wybrano: %d.', $capacity, $total));
	ksort($normalized); // Same selection has the same cart key regardless of click order.
	return ['custom_candies' => array_values($normalized), 'box_size' => $box];
}

function ccafe_praline_request($product_id, $variation_id) {
	$nonce = $_POST['ccafe_praline_nonce'] ?? null;
	if (!is_string($nonce) || !wp_verify_nonce(wp_unslash($nonce), ccafe_session_nonce_action('ccafe_pralines_' . $product_id))) return new WP_Error('nonce', 'Sesja konfiguratora wygasła. Odśwież stronę i spróbuj ponownie.');
	$raw = $_POST['custom_candies'] ?? null;
	return ccafe_praline_configuration($product_id, $variation_id, is_string($raw) ? wp_unslash($raw) : null);
}

add_filter('woocommerce_add_to_cart_validation', function ($passed, $product_id, $quantity, $variation_id = 0) {
	if (!ccafe_is_praline_product($product_id)) return $passed;
	$result = ccafe_praline_request($product_id, $variation_id);
	if (is_wp_error($result)) { wc_add_notice($result->get_error_message(), 'error'); return false; }
	return $passed;
}, 10, 4);

add_filter('woocommerce_add_cart_item_data', function ($data, $product_id, $variation_id) {
	if (!ccafe_is_praline_product($product_id)) return $data;
	// WC_Cart::add_to_cart can also be called without its form validation hook.
	$result = isset($data['custom_candies'])
		? ccafe_praline_configuration($product_id, $variation_id, wp_json_encode($data['custom_candies']))
		: ccafe_praline_request($product_id, $variation_id);
	if (is_wp_error($result)) throw new Exception($result->get_error_message());
	return array_merge($data, $result);
}, 10, 3);

// Recheck persisted carts too, including configurations created before these rules.
add_action('woocommerce_check_cart_items', function () {
	foreach (WC()->cart->get_cart() as $item) {
		if (!ccafe_is_praline_product($item['product_id'])) continue;
		$result = ccafe_praline_configuration($item['product_id'], $item['variation_id'], wp_json_encode($item['custom_candies'] ?? null));
		if (is_wp_error($result)) wc_add_notice('Zestaw pralin w koszyku wymaga ponownej konfiguracji. Usuń go i wybierz rozmiar oraz dostępne smaki.', 'error');
	}
});

// Establish the anonymous Woo session before rendering its session-bound form nonce.
add_action('template_redirect', function () {
	if (is_singular('product') && ccafe_is_praline_product(get_queried_object_id()) && WC()->session && !WC()->session->has_session()) WC()->session->set_customer_session_cookie(true);
}, 0);

add_filter('woocommerce_get_cart_item_from_session', function ($item) {
	if (!ccafe_is_praline_product($item['product_id'])) {
		unset($item['custom_candies'], $item['box_size']);
		return $item;
	}
	$result = ccafe_praline_configuration($item['product_id'], $item['variation_id'], wp_json_encode($item['custom_candies'] ?? null));
	if (is_wp_error($result)) {
		unset($item['custom_candies'], $item['box_size']);
		$item['ccafe_praline_invalid'] = true;
		return $item;
	}
	unset($item['ccafe_praline_invalid']);
	return array_merge($item, $result);
});
