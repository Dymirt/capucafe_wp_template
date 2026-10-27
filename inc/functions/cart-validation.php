<?php
/** Server-owned rules shared by the cart endpoint and WooCommerce forms. */
function ccafe_session_nonce_action($action) {
	return $action . '_' . (WC()->session ? WC()->session->get_customer_id() : '');
}
function ccafe_integer($value, $allow_zero = false) {
	if (!is_string($value) && !is_int($value)) return false;
	if (!preg_match('/^(0|[1-9][0-9]{0,8})$/D', (string) $value)) return false;
	$number = (int) $value;
	return ($allow_zero || $number > 0) ? $number : false;
}

function ccafe_cart_quantity_error($cart, $key, $raw_quantity) {
	$quantity = ccafe_integer($raw_quantity, true);
	if ($quantity === false) return new WP_Error('quantity', 'Podaj prawidłową, całkowitą liczbę sztuk.');
	if (!is_string($key) || !isset($cart->get_cart()[$key])) return new WP_Error('item', 'Ta pozycja nie istnieje już w Twoim koszyku. Odśwież stronę.');
	if ($quantity === 0) return null; // Explicit zero alone means removal of an owned line.
	$item = $cart->get_cart()[$key];
	$product = $item['data'] ?? null;
	if (!$product instanceof WC_Product || !$product->exists()) return new WP_Error('product', 'Produkt jest niedostępny.');
	if (!$product->is_purchasable() || !$product->is_in_stock()) return new WP_Error('availability', 'Produkt jest obecnie niedostępny.');
	if ($product->is_sold_individually() && $quantity > 1) return new WP_Error('single', 'Ten produkt można kupić tylko pojedynczo.');
	$max = $product->get_max_purchase_quantity();
	if ($quantity < $product->get_min_purchase_quantity() || ($max >= 0 && $quantity > $max)) return new WP_Error('limit', 'Wybrana ilość przekracza dozwolony limit produktu.');
	$stock_id = $product->get_stock_managed_by_id();
	$stock_product = wc_get_product($stock_id);
	$stock_quantity = $quantity;
	foreach ($cart->get_cart() as $other_key => $other) {
		if ($other_key !== $key && $other['data']->get_stock_managed_by_id() === $stock_id) $stock_quantity += $other['quantity'];
	}
	if ($stock_product && !$stock_product->has_enough_stock($stock_quantity)) return new WP_Error('stock', 'Brak wystarczającej liczby sztuk w magazynie.');
	if ($stock_product && $stock_product->managing_stock() && !$stock_product->backorders_allowed()) {
		$held = wc_get_held_stock_quantity($stock_product, absint(WC()->session->get('order_awaiting_payment', 0)));
		if ($stock_product->get_stock_quantity() < $held + $stock_quantity) return new WP_Error('held_stock', 'Dostępny zapas jest obecnie zarezerwowany. Zmniejsz ilość.');
	}
	return null;
}

add_filter('woocommerce_update_cart_validation', function ($passed, $key, $item, $quantity) {
	$error = ccafe_cart_quantity_error(WC()->cart, $key, $quantity);
	if ($error) { wc_add_notice($error->get_error_message(), 'error'); return false; }
	return $passed;
}, 10, 4);

function ccafe_cart_response($message = '', $status = 200) {
    header('Vary: HX-Request');
    if (!wp_doing_ajax()) {
        if ($message) wc_add_notice($message, $status >= 400 ? 'error' : 'success');
        wp_safe_redirect(wc_get_cart_url());
        exit;
    }
    if (($_SERVER['HTTP_HX_REQUEST'] ?? '') === 'true') {
        status_header($status);
        nocache_headers();
        header('Content-Type: text/html; charset=' . get_option('blog_charset'));
        get_template_part('headers/parts/mini-cart', null, ['message' => $message]);
        echo '<span class="js-cart-badge text-[6px]" hx-swap-oob="outerHTML:.js-cart-badge">' . (int) WC()->cart->get_cart_contents_count() . '</span>';
        wp_die('', '', ['response' => $status]);
    }
    if ($status >= 400) wp_send_json_error(['message' => $message], $status);
    WC_AJAX::get_refreshed_fragments();
}

function ccafe_update_cart_item_qty() {
    if (!WC()->cart) wc_load_cart();
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') ccafe_cart_response('Wymagane jest żądanie POST.', 405);
    if (!isset($_POST['nonce']) || !is_string($_POST['nonce']) || !wp_verify_nonce(wp_unslash($_POST['nonce']), ccafe_session_nonce_action('ccafe_update_qty'))) ccafe_cart_response('Sesja formularza wygasła. Odśwież stronę.', 403);
    $cart = WC()->cart;
    $key = isset($_POST['cart_item_key']) && is_string($_POST['cart_item_key']) ? wp_unslash($_POST['cart_item_key']) : null;
    $quantity = isset($_POST['quantity']) ? ccafe_integer($_POST['quantity'], true) : false;
    $error = ccafe_cart_quantity_error($cart, $key, $quantity === false ? null : $quantity);
    if ($error) ccafe_cart_response($error->get_error_message(), 422);
    if (!apply_filters('woocommerce_update_cart_validation', true, $key, $cart->get_cart()[$key], $quantity)) {
        $notices = wc_get_notices('error');
        wc_clear_notices();
        ccafe_cart_response(wp_strip_all_tags($notices[0]['notice'] ?? 'Nie można zmienić ilości tego produktu.'), 422);
    }
    $changed = $quantity === 0 ? $cart->remove_cart_item($key) : $cart->set_quantity($key, $quantity, true);
    if (!$changed) ccafe_cart_response('Nie można teraz zmienić tej pozycji koszyka.', 422);
    ccafe_cart_response('Koszyk został zaktualizowany.');
}
add_action('wp_ajax_ccafe_update_cart_item_qty', 'ccafe_update_cart_item_qty');
add_action('wp_ajax_nopriv_ccafe_update_cart_item_qty', 'ccafe_update_cart_item_qty');
add_action('admin_post_ccafe_update_cart_item_qty', 'ccafe_update_cart_item_qty');
add_action('admin_post_nopriv_ccafe_update_cart_item_qty', 'ccafe_update_cart_item_qty');

// Invalidate pre-migration browser fragments (old controls and non-session nonce).
add_filter('woocommerce_cart_fragment_name', function ($name) { return $name . '_ccafe_v2'; });
