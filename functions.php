<?php

// Enqueue scripts/styles
require_once get_stylesheet_directory() . '/inc/functions/enqueue.php';

// Register custom post types
#require_once get_stylesheet_directory() . '/inc/custom-post-types/slodki-stol.php';
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
		'orderby'        => 'date',
		'order'          => 'DESC',
		'post_status'    => 'publish',
	));

	if ($recent_posts->have_posts()) :
		echo '<div class="self-stretch flex flex-col sm:flex-row justify-start items-center gap-4 lg:gap-10">';
		while ($recent_posts->have_posts()) : $recent_posts->the_post();
	?>
			<div class="self-stretch flex flex-col justify-start items-start md:basis-64 w-64">
				<a href="<?php the_permalink(); ?>" class="w-full">
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
			</div>
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

/*
add_action('wp_footer', function () {
	if (!is_checkout()) return;
	?>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const fieldIds = [
				'billing_address_1_field',
				'billing_address_2_field',
				'billing_postcode_field',
				'billing_city_field',
				'billing_state_field',
			];

			function toggleBillingFields() {
				const selected = document.querySelector('input[name^="shipping_method"]');
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
*/

/*
add_action('wp_footer', function () {
	if (!is_checkout()) return;
?>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const invoiceCheckbox = document.getElementById('billing_invoice_ask');
			const companyField = document.getElementById('billing_company_field');

			function toggleCompanyField() {
				if (invoiceCheckbox.checked) {
					companyField.style.display = '';
				} else {
					companyField.style.display = 'none';
					const input = companyField.querySelector('input');
					if (input) input.value = ''; // opcjonalnie czyści pole
				}
			}

			// Wywołaj raz po załadowaniu
			toggleCompanyField();

			// Wywołuj przy każdej zmianie checkboxa
			invoiceCheckbox.addEventListener('change', toggleCompanyField);
		});
	</script>
<?php
});


add_action('wp_footer', function () {
	if (!is_checkout()) return;
?>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const companyField = document.getElementById('billing_company_field');
			if (!companyField || !companyField.nextElementSibling) return;

			const nextSibling = companyField.nextElementSibling;
			const parent = companyField.parentNode;

			// Move it below its next sibling
			if (nextSibling.nextSibling) {
				parent.insertBefore(companyField, nextSibling.nextSibling);
			} else {
				parent.appendChild(companyField);
			}
		});
	</script>
<?php
});
*/


// ADMIN UI: repeatable Nutritional Values (key = name, value = amount)
add_action('woocommerce_product_options_general_product_data', function () {
	global $post;

	$pairs = get_post_meta($post->ID, '_nutritional_values_kv', true);
	if (!is_array($pairs)) $pairs = [];

	// Security
	wp_nonce_field('save_nutritional_values_kv', 'nutritional_values_kv_nonce');

?>
	<div class="options_group">
		<p class="form-field">
			<label><?php _e('Wartości odżywcze', 'yourtextdomain'); ?></label>
		</p>

		<table class="widefat striped" id="nutritional-values-table" style="max-width:720px">
			<thead>
				<tr>
					<th style="width:50%"><?php _e('Składnik (np. Sól)', 'yourtextdomain'); ?></th>
					<th style="width:40%"><?php _e('Wartość (np. 0.1 g)', 'yourtextdomain'); ?></th>
					<th style="width:10%"></th>
				</tr>
			</thead>
			<tbody>
				<?php if (empty($pairs)) : ?>
					<tr>
						<td><input type="text" name="_nutri_key[]" class="short" placeholder="<?php esc_attr_e('Sól', 'yourtextdomain'); ?>"></td>
						<td><input type="text" name="_nutri_val[]" class="short" placeholder="<?php esc_attr_e('0.1 g', 'yourtextdomain'); ?>"></td>
						<td><button type="button" class="button remove-row">×</button></td>
					</tr>
					<?php else : foreach ($pairs as $k => $v) : ?>
						<tr>
							<td><input type="text" name="_nutri_key[]" class="short" value="<?php echo esc_attr($k); ?>"></td>
							<td><input type="text" name="_nutri_val[]" class="short" value="<?php echo esc_attr($v); ?>"></td>
							<td><button type="button" class="button remove-row">×</button></td>
						</tr>
				<?php endforeach;
				endif; ?>
			</tbody>
		</table>

		<p><button type="button" class="button" id="add-nutri-row"><?php _e('Dodaj pozycję', 'yourtextdomain'); ?></button></p>

		<script>
			(function() {
				const table = document.getElementById('nutritional-values-table').getElementsByTagName('tbody')[0];
				document.getElementById('add-nutri-row').addEventListener('click', function() {
					const tr = document.createElement('tr');
					tr.innerHTML = `
                    <td><input type="text" name="_nutri_key[]" class="short" placeholder="<?php echo esc_js(__('Sól', 'yourtextdomain')); ?>"></td>
                    <td><input type="text" name="_nutri_val[]" class="short" placeholder="<?php echo esc_js(__('0.1 g', 'yourtextdomain')); ?>"></td>
                    <td><button type="button" class="button remove-row">×</button></td>
                `;
					table.appendChild(tr);
				});

				table.addEventListener('click', function(e) {
					if (e.target && e.target.classList.contains('remove-row')) {
						const row = e.target.closest('tr');
						if (row && table.rows.length > 1) row.remove();
					}
				});
			})();
		</script>
	</div>
	<?php
});

// SAVE
add_action('woocommerce_admin_process_product_object', function (WC_Product $product) {
	if (
		!isset($_POST['nutritional_values_kv_nonce']) ||
		!wp_verify_nonce($_POST['nutritional_values_kv_nonce'], 'save_nutritional_values_kv')
	) {
		return;
	}

	$keys = isset($_POST['_nutri_key']) ? (array) $_POST['_nutri_key'] : [];
	$vals = isset($_POST['_nutri_val']) ? (array) $_POST['_nutri_val'] : [];

	$clean = [];
	$count = max(count($keys), count($vals));

	for ($i = 0; $i < $count; $i++) {
		$k = isset($keys[$i]) ? sanitize_text_field(wp_unslash($keys[$i])) : '';
		$v = isset($vals[$i]) ? sanitize_text_field(wp_unslash($vals[$i])) : '';
		if ($k !== '' && $v !== '') {
			$clean[$k] = $v; // associative array: "Sól" => "0.1 g"
		}
	}

	if (!empty($clean)) {
		$product->update_meta_data('_nutritional_values_kv', $clean);
	} else {
		$product->delete_meta_data('_nutritional_values_kv');
	}
});

// One tab that shows BOTH the textarea content and the key→value table
add_filter('woocommerce_product_tabs', function ($tabs) {
	$tabs['nutri'] = [
		'title'    => __('Wartości odżywcze', 'yourtextdomain'),
		'priority' => 25,
		'callback' => function () {
			// Get current product safely inside the callback
			$product = wc_get_product(get_the_ID());
			if (!$product) {
				return;
			}

			// 1) Free-text (from textarea)
			$vals = $product->get_meta('_nutritional_values');

			// 2) Key→Value pairs (array). If you stored JSON, decode it first.
			$kv = $product->get_meta('_nutritional_values_kv', true);
			if (is_string($kv)) {
				$decoded = json_decode($kv, true);
				if (json_last_error() === JSON_ERROR_NONE) {
					$kv = $decoded;
				}
			}

			// Nothing to show? Bail.
			if (empty($vals) && (empty($kv) || !is_array($kv))) {
				return;
			}
	?>
		<div class="self-stretch pt-4 pb-10 bg-white border-t border-neutral-200 flex flex-col justify-center items-center gap-5">
			<div class="self-stretch flex flex-col justify-center items-center gap-2.5">
				<?php
				$kv = get_post_meta(get_the_ID(), '_nutritional_values_kv', true);
				if (is_array($kv) && !empty($kv)) : ?>
					<div class="self-stretch inline-flex justify-start items-center gap-2.5">
						<div class="w-96 justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">Wartość odżywcza 100 g produktu</div>
					</div>

					<?php foreach ($kv as $k => $v): ?>
						<div class="self-stretch inline-flex justify-between items-center">
							<div class="flex-1 justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug"><?php echo esc_html($k); ?></div>
							<div class="justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug"><?php echo esc_html($v); ?></div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	<?php
		},
	];

	return $tabs;
});



add_action('wp_enqueue_scripts', function () {
    wp_add_inline_script(
        'wc-blocks-checkout', // если не уверены, см. альтернативу ниже
        "
(function(){
  // формат YYYY-MM-DD в локальном часовом поясе
  const pad = n => String(n).padStart(2,'0');
  const todayD = new Date();
  const todayStr = todayD.getFullYear()+'-'+pad(todayD.getMonth()+1)+'-'+pad(todayD.getDate());
  const tomorrowD = new Date(todayD.getFullYear(), todayD.getMonth(), todayD.getDate()+1);
  const tomorrowStr = tomorrowD.getFullYear()+'-'+pad(tomorrowD.getMonth()+1)+'-'+pad(tomorrowD.getDate());

  function markAndBlockToday(root=document) {
    root.querySelectorAll('.react-datepicker__day--today').forEach(el=>{
      el.classList.add('react-datepicker__day--disabled');
      el.setAttribute('aria-disabled','true');
      el.style.pointerEvents = 'none'; // на всякий
      el.removeAttribute('tabindex');
      el.removeAttribute('aria-selected');
    });
  }

  // Жёсткая блокировка кликов/клавиш на today (capture = true важно!)
  function interceptEvents(){
    const stopIfToday = (e) => {
      const cell = e.target.closest && e.target.closest('.react-datepicker__day');
      if (!cell) return;
      if (cell.classList.contains('react-datepicker__day--today')) {
        e.stopPropagation();
        e.preventDefault();
      }
    };
    ['click','mousedown','pointerdown','keydown','touchstart'].forEach(evt=>{
      document.addEventListener(evt, (e)=>{
        // по Enter/Space тоже блокируем
        if (evt==='keydown' && !(e.key==='Enter' || e.key===' ')) return;
        interceptEvents._handler && interceptEvents._handler(e); // noop если нет
        const cell = e.target.closest && e.target.closest('.react-datepicker__day');
        if (cell && cell.classList.contains('react-datepicker__day--today')) {
          e.stopPropagation();
          e.preventDefault();
        }
      }, true);
    });
  }

  function guardInput(){
    const input = document.querySelector('.pickup-date-picker');
    if (!input) return;

    const invalidate = (msg) => {
      // покажем ошибку под блоком (если есть контейнер WC Blocks)
      const err = input.closest('.th-datepicker-field')?.querySelector('.wc-block-components-validation-error p');
      if (err) err.textContent = msg || 'Wybierz datę od jutra.';
    };

    const enforce = () => {
      if (!input.value) return;
      // если сегодня или раньше — исправляем на завтра (или чистим)
      if (input.value <= todayStr) {
        // вариант A: автоставим завтра
        input.value = tomorrowStr;
        input.dispatchEvent(new Event('change', { bubbles:true }));
        invalidate('Dzisiejszy odbiór niedostępny — ustawiono jutro.');
      }
    };

    // начальное состояние
    if (input.value && input.value <= todayStr) {
      input.value = tomorrowStr; // или '' если хочешь заставить выбрать вручную
      input.dispatchEvent(new Event('change', { bubbles:true }));
      invalidate('Dzisiejszy odbiór niedostępny — ustawiono jutro.');
    }

    // слушатели
    input.addEventListener('change', enforce);
    input.addEventListener('input', enforce);
  }

  // Наблюдаем за ререндерами React
  const mo = new MutationObserver(() => {
    markAndBlockToday(document);
  });
  mo.observe(document.documentElement, { childList:true, subtree:true });

  document.addEventListener('DOMContentLoaded', function(){
    markAndBlockToday();
    interceptEvents();
    guardInput();
  });
})();
        "
    );
});



// Move tabs only on the product with slug "praliny"
add_action('wp', function () {
	if (! is_product()) return;

	$product = wc_get_product(get_queried_object_id());
	if (! $product || $product->get_slug() !== 'praliny') return;

	// 1) Stop tabs from rendering in the default spot (below summary)
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

	// 2) Fire your custom hook after the gallery (left column)
	// If you already put `do_action('ccafe_product_tabs_after_gallery')` in the template,
	// skip this "bridge".
	add_action('woocommerce_before_single_product_summary', function () {
		do_action('ccafe_product_tabs_after_gallery');
	}, 30);

	// 3) Attach the tabs output to your custom hook
	add_action('ccafe_product_tabs_after_gallery', 'woocommerce_output_product_data_tabs', 10);
});

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
	// counts
	ob_start(); ?>
	<span class="js-cart-count"><?php echo (int) WC()->cart->get_cart_contents_count(); ?></span>
	<?php $fragments['.js-cart-count'] = ob_get_clean();

	ob_start(); ?>
	<span class="js-cart-button-count"><?php echo (int) WC()->cart->get_cart_contents_count(); ?></span>
	<?php $fragments['.js-cart-button-count'] = ob_get_clean();

	// header badge (optional)
	ob_start(); ?>
	<span class="js-cart-badge text-[6px]"><?php echo (int) WC()->cart->get_cart_contents_count(); ?></span>
	<?php $fragments['.js-cart-badge'] = ob_get_clean();

	// subtotal
	ob_start(); ?>
	<span class="js-cart-subtotal"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
	<?php $fragments['.js-cart-subtotal'] = ob_get_clean();

	// --- NEW: per-line fragments ---
	foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
		$product = $cart_item['data'] ?? null;
		$qty     = (int) ($cart_item['quantity'] ?? 0);
		if (! $product || $qty <= 0) continue;

		// line subtotal
		ob_start(); ?>
		<span class="js-line-subtotal">
			<?php echo wp_kses_post(WC()->cart->get_product_subtotal($product, $qty)); ?>
		</span>
		<?php
		$fragments['[data-cart-item="' . $cart_item_key . '"] .js-line-subtotal'] = ob_get_clean();

		// qty (optional, to keep qty text in sync with server)
		ob_start(); ?>
		<span class="js-qty-val"><?php echo (int) $qty; ?></span>
<?php
		$fragments['[data-cart-item="' . $cart_item_key . '"] .js-qty-val'] = ob_get_clean();
	}

	// If you want your custom list to persist after AJAX, also return your mini-cart HTML
	// that lives inside .widget_shopping_cart_content:
	ob_start();
	// render the SAME loop you use in the popover (extract to a template part if you like)
	wc_get_template('cart/mini-cart.php'); // or include your own partial that outputs your custom HTML
	$fragments['.widget_shopping_cart_content'] = ob_get_clean();

	return $fragments;
}, 20);

// Make sure cart fragments script is loaded
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_script('wc-cart-fragments');
});




// AJAX: update cart item quantity (plus/minus in mini cart)
add_action('wp_ajax_ccafe_update_cart_item_qty', 'ccafe_update_cart_item_qty');
add_action('wp_ajax_nopriv_ccafe_update_cart_item_qty', 'ccafe_update_cart_item_qty');
function ccafe_update_cart_item_qty()
{
	check_ajax_referer('ccafe_update_qty', 'nonce');

	$key = isset($_POST['cart_item_key']) ? wc_clean(wp_unslash($_POST['cart_item_key'])) : '';
	$qty = isset($_POST['quantity']) ? (int) $_POST['quantity'] : -1;

	if ($key === '') {
		wp_send_json_error(['message' => 'Missing key'], 400);
	}

	if ($qty <= 0) {
		WC()->cart->remove_cart_item($key);
	} else {
		WC()->cart->set_quantity($key, $qty, true); // true = recalc totals
	}

	// Return refreshed fragments (same as Woo does)
	WC_AJAX::get_refreshed_fragments();
	wp_die();
}

// Ensure cart fragments are loaded (usually already)
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_script('wc-cart-fragments');
});
