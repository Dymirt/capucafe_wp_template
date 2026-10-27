<?php
defined('ABSPATH') || exit;

/** Local attachment files only; never fetch image URLs during checkout. */
function ccafe_praline_image_file($attachment_id, $size) {
    $upload = wp_upload_dir();
    $intermediate = image_get_intermediate_size($attachment_id, $size);
    $file = $intermediate && !empty($intermediate['path'])
        ? $upload['basedir'] . '/' . $intermediate['path']
        : get_attached_file($attachment_id);
    $root = realpath($upload['basedir']);
    $path = $file ? realpath($file) : false;
    if (!$root || !$path || strpos($path, $root . DIRECTORY_SEPARATOR) !== 0 || !is_readable($path)) return false;
    $dimensions = wp_getimagesize($path);
    if (!$dimensions || $dimensions[0] > 4096 || $dimensions[1] > 4096 || filesize($path) > 8 * MB_IN_BYTES) return false;
    return $path;
}

/** Blocks accept one URL, so cache a small composition instead of injecting DOM/JS. */
function ccafe_praline_checkout_image($item) {
    if (empty($item['product_id']) || !ccafe_is_praline_product($item['product_id']) || !function_exists('imagecreatetruecolor')) return false;
    $config = ccafe_praline_configuration($item['product_id'], $item['variation_id'] ?? 0, wp_json_encode($item['custom_candies'] ?? null));
    if (is_wp_error($config)) return false;
    $product = wc_get_product($item['variation_id']);
    $box = ccafe_praline_image_file($product->get_image_id(), 'woocommerce_thumbnail');
    if (!$box) return false;
    $capacity = (int) $config['box_size'];
    $pieces = [];
    foreach ($config['custom_candies'] as $candy) {
        $file = ccafe_praline_image_file((int) get_post_meta($candy['id'], '_extra_image_id', true), 'thumbnail');
        if (!$file) $file = ccafe_praline_image_file(get_post_thumbnail_id($candy['id']), 'thumbnail');
        if (!$file) return false;
        $pieces[] = ['file' => $file, 'quantity' => $candy['quantity']];
    }
    $sources = array_merge([$box], array_column($pieces, 'file'));
    $signature = array_map(function ($file) { return [$file, filemtime($file), filesize($file)]; }, $sources);
    $hash = hash('sha256', wp_json_encode(['v1', $capacity, $pieces, $signature]));
    $uploads = wp_upload_dir();
    if ($uploads['error']) return false;
    $dir = $uploads['basedir'] . '/ccafe-praline-previews';
    $name = 'praline-' . $hash . '.png';
    $file = $dir . '/' . $name;
    $url = $uploads['baseurl'] . '/ccafe-praline-previews/' . $name;
    if (is_file($file)) return $url;
    if (!wp_mkdir_p($dir)) return false;
    // Bounded cache: only disposable generated previews, never original media.
    $cached = glob($dir . '/praline-*.png') ?: [];
    if (count($cached) >= 200) {
        usort($cached, function ($a, $b) { return filemtime($b) <=> filemtime($a); });
        foreach (array_slice($cached, 199) as $old) wp_delete_file($old);
    }
    $base = @imagecreatefromstring(file_get_contents($box));
    if (!$base) return false;
    $size = 300;
    $canvas = imagecreatetruecolor($size, $size);
    imagealphablending($canvas, false);
    imagesavealpha($canvas, true);
    imagefill($canvas, 0, 0, imagecolorallocatealpha($canvas, 0, 0, 0, 127));
    imagecopyresampled($canvas, $base, 0, 0, 0, 0, $size, $size, imagesx($base), imagesy($base));
    imagedestroy($base);
    imagealphablending($canvas, true);
    // Same measured insert bounds and 84% contain-fit as .ccafe-praline-image-grid.
    $grids = [6 => [0.2544, 0.4556, 0.3925, 0.2594, 3, 2], 12 => [0.135, 0.3988, 0.5244, 0.3919, 4, 3], 16 => [0.1211, 0.3362, 0.5271, 0.5214, 4, 4]];
    [$left, $top, $width, $height, $columns, $rows] = $grids[$capacity];
    $cell_w = $width * $size / $columns;
    $cell_h = $height * $size / $rows;
    $index = 0;
    foreach ($pieces as $piece) {
        $image = @imagecreatefromstring(file_get_contents($piece['file']));
        if (!$image) { imagedestroy($canvas); return false; }
        $scale = min($cell_w * 0.84 / imagesx($image), $cell_h * 0.84 / imagesy($image));
        $w = max(1, (int) round(imagesx($image) * $scale));
        $h = max(1, (int) round(imagesy($image) * $scale));
        for ($i = 0; $i < $piece['quantity']; $i++, $index++) {
            $x = (int) round($left * $size + ($index % $columns) * $cell_w + ($cell_w - $w) / 2);
            $y = (int) round($top * $size + intdiv($index, $columns) * $cell_h + ($cell_h - $h) / 2);
            imagecopyresampled($canvas, $image, $x, $y, 0, 0, $w, $h, imagesx($image), imagesy($image));
        }
        imagedestroy($image);
    }
    $temp = tempnam($dir, 'preview-');
    $saved = $temp && imagepng($canvas, $temp, 6);
    imagedestroy($canvas);
    if (!$saved || !rename($temp, $file)) {
        if ($temp) wp_delete_file($temp);
        return false;
    }
    chmod($file, defined('FS_CHMOD_FILE') ? FS_CHMOD_FILE : 0644);
    return $url;
}

add_filter('woocommerce_store_api_cart_item_images', function ($images, $item, $key) {
    $url = ccafe_praline_checkout_image($item);
    if (!$url || empty($images)) return $images;
    $image = clone $images[0];
    $image->src = $url;
    $image->thumbnail = $url;
    $image->srcset = '';
    $image->sizes = '';
    $image->alt = 'Zestaw pralin w wybranych smakach';
    return [$image];
}, 20, 3);
