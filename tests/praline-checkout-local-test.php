<?php
if (PHP_SAPI !== 'cli' || !defined('ABSPATH')) { http_response_code(404); exit; }
if (wp_get_environment_type() !== 'local') throw new RuntimeException('Local only.');
$GLOBALS['ccafe_checkout_checks'] = 0;
function ccafe_checkout_assert($ok, $message) {
    if (!$ok) throw new RuntimeException('FAIL: ' . $message);
    $GLOBALS['ccafe_checkout_checks']++;
}
$parent = get_page_by_path('praliny', OBJECT, 'product');
$flavours = get_posts(['post_type'=>'praliny_candy','post_status'=>'publish','numberposts'=>2]);
$urls = [];
foreach (wc_get_product($parent->ID)->get_children() as $id) {
    $variation = wc_get_product($id);
    $capacity = (int) $variation->get_attribute('ilosc-sztuk-w-opakowaniu');
    if (!in_array($capacity, [6,12,16], true)) continue;
    $config = ccafe_praline_configuration($parent->ID, $id, wp_json_encode([
        ['id'=>$flavours[0]->ID,'quantity'=>$capacity-1], ['id'=>$flavours[1]->ID,'quantity'=>1],
    ]));
    $item = array_merge($config, ['product_id'=>$parent->ID,'variation_id'=>$id,'quantity'=>1]);
    $url = ccafe_praline_checkout_image($item);
    ccafe_checkout_assert(is_string($url) && strpos($url, '/ccafe-praline-previews/praline-') !== false, 'generated image ' . $capacity);
    $upload = wp_upload_dir();
    $path = $upload['basedir'] . '/ccafe-praline-previews/' . wp_basename($url);
    $size = getimagesize($path);
    ccafe_checkout_assert($size[0] === 300 && $size[1] === 300 && $size['mime'] === 'image/png', 'valid bounded PNG');
    $original = (object) ['id'=> $variation->get_image_id(), 'src'=>'https://example.test/box.png','thumbnail'=>'https://example.test/box.png','srcset'=>'old box 300w','sizes'=>'300px'];
    $filtered = apply_filters('woocommerce_store_api_cart_item_images', [$original], $item, 'local-test');
    ccafe_checkout_assert($filtered[0]->src === $url && $filtered[0]->thumbnail === $url, 'Store API image URLs');
    ccafe_checkout_assert($filtered[0]->srcset === '' && $original->srcset !== '', 'no stale srcset or mutation');
    $mtime = filemtime($path);
    ccafe_checkout_assert(ccafe_praline_checkout_image($item) === $url && filemtime($path) === $mtime, 'cache reuse');
    $item['quantity'] = 2;
    ccafe_checkout_assert(ccafe_praline_checkout_image($item) === $url, 'box quantity does not change preview');
    $item['custom_candies'] = [['id'=>$flavours[1]->ID,'quantity'=>$capacity]];
    ccafe_checkout_assert(ccafe_praline_checkout_image($item) !== $url, 'different flavours have different cache');
    unset($item['custom_candies']);
    ccafe_checkout_assert(ccafe_praline_checkout_image($item) === false, 'invalid configurations safe fallback');
    $urls[$capacity] = $url;
}
ccafe_checkout_assert(count($urls) === 3, 'all capacities exercised');
ccafe_checkout_assert(ccafe_praline_checkout_image(['product_id'=>1383]) === false, 'ordinary product unchanged');
ccafe_checkout_assert(ccafe_praline_image_file(0, 'thumbnail') === false, 'missing image fallback');
echo 'PASS: ' . $GLOBALS['ccafe_checkout_checks'] . " checkout image checks\n";
echo wp_json_encode($urls) . "\n";
