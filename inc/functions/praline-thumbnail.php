<?php
defined('ABSPATH') || exit;
/** Reuse the configurator's measured grid for a session-owned cart composition. */
function ccafe_praline_cart_thumbnail($thumbnail, $item, $key) {
    if (empty($item['product_id']) || !ccafe_is_praline_product($item['product_id'])) return $thumbnail;
    $configuration = ccafe_praline_configuration($item['product_id'], $item['variation_id'] ?? 0, wp_json_encode($item['custom_candies'] ?? null));
    if (is_wp_error($configuration)) return $thumbnail;
    $capacity = (int) $configuration['box_size'];
    $overlay = '';
    foreach ($configuration['custom_candies'] as $candy) {
        $extra_id = (int) get_post_meta($candy['id'], '_extra_image_id', true);
        $image_id = $extra_id ?: get_post_thumbnail_id($candy['id']);
        $image = wp_get_attachment_image($image_id, 'thumbnail', false, ['alt'=>'', 'loading'=>'lazy', 'class'=>'ccafe-praline-piece']);
        if (!$image && $extra_id) $image = wp_get_attachment_image(get_post_thumbnail_id($candy['id']), 'thumbnail', false, ['alt'=>'', 'loading'=>'lazy', 'class'=>'ccafe-praline-piece']);
        if (!$image) $image = wc_placeholder_img('thumbnail', ['class'=>'ccafe-praline-piece', 'alt'=>'']);
        $overlay .= str_repeat($image, $candy['quantity']);
    }
    return '<span class="ccafe-praline-thumbnail" role="img" aria-label="' . esc_attr(sprintf('Zestaw %d pralin w wybranych smakach', $capacity)) . '">'
        . $thumbnail . '<span class="ccafe-praline-image-grid" data-capacity="' . $capacity . '" aria-hidden="true">' . $overlay . '</span></span>';
}
add_filter('woocommerce_cart_item_thumbnail', 'ccafe_praline_cart_thumbnail', 20, 3);
