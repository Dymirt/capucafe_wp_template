<?php
/** Shared first render, WooCommerce fragment and htmx response. */
$cart = WC()->cart;
?>
<div class="ccafe-mini-cart" aria-label="Podgląd koszyka">
    <p class="font-bold">Koszyk (<?php echo (int) $cart->get_cart_contents_count(); ?>)</p>
    <p class="ccafe-cart-message" role="status" aria-live="polite"><?php echo esc_html($args['message'] ?? ''); ?></p>
    <?php if ($cart->is_empty()) : ?>
        <p>Twój koszyk jest pusty.</p>
    <?php else : foreach ($cart->get_cart() as $key => $item) :
        $product = $item['data'];
        if (!$product || !$product->exists()) continue;
        $qty = (int) $item['quantity']; ?>
        <div class="ccafe-cart-row" data-cart-item="<?php echo esc_attr($key); ?>">
            <?php echo apply_filters('woocommerce_cart_item_thumbnail', $product->get_image('woocommerce_thumbnail'), $item, $key); ?>
            <div class="min-w-0">
                <a href="<?php echo esc_url($product->get_permalink($item)); ?>"><?php echo esc_html($product->get_name()); ?></a>
                <?php echo wc_get_formatted_cart_item_data($item); ?>
                <?php if (!empty($item['ccafe_praline_invalid'])) : ?><p>Zestaw wymaga ponownej konfiguracji.</p><?php endif; ?>
                <?php if (!empty($item['custom_candies'])) : ?><ul class="text-xs">
                    <?php foreach ($item['custom_candies'] as $candy) : ?><li><?php echo esc_html($candy['name'] . ' × ' . $candy['quantity']); ?></li><?php endforeach; ?>
                </ul><?php endif; ?>
                <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
                    hx-post="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" hx-target="closest .ccafe-mini-cart" hx-swap="outerHTML"
                    hx-sync="#page:drop" hx-request='{"timeout":15000}' hx-disabled-elt=".ccafe-mini-cart button" class="ccafe-cart-quantity">
                    <input type="hidden" name="action" value="ccafe_update_cart_item_qty">
                    <input type="hidden" name="cart_item_key" value="<?php echo esc_attr($key); ?>">
                    <?php wp_nonce_field(ccafe_session_nonce_action('ccafe_update_qty'), 'nonce', false); ?>
                    <button type="submit" name="quantity" value="<?php echo $qty - 1; ?>" aria-label="Mniej: <?php echo esc_attr($product->get_name()); ?>">−</button>
                    <span aria-label="Liczba sztuk"><?php echo $qty; ?></span>
                    <button type="submit" name="quantity" value="<?php echo $qty + 1; ?>" aria-label="Więcej: <?php echo esc_attr($product->get_name()); ?>">+</button>
                    <button type="submit" name="quantity" value="0" aria-label="Usuń: <?php echo esc_attr($product->get_name()); ?>">Usuń</button>
                </form>
                <span><?php echo wp_kses_post($cart->get_product_subtotal($product, $qty)); ?></span>
            </div>
        </div>
    <?php endforeach; ?>
        <p class="ccafe-cart-total">Razem: <?php echo wp_kses_post($cart->get_cart_subtotal()); ?></p>
    <?php endif; ?>
    <a class="ccafe-cart-link" href="<?php echo esc_url(wc_get_cart_url()); ?>">Przejdź do koszyka</a>
</div>
