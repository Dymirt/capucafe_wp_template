<?php

add_action('init', function () {
    register_post_type('praliny_candy', [
        'label' => 'Praliny Smaki',
        'public' => false,
        'show_ui' => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-carrot',
        'supports' => ['title', 'thumbnail'],
        'has_archive' => false,
        'show_in_rest' => true,
        'labels' => [
            'name' => 'Smaki Pralin',
            'singular_name' => 'Smak Praliny',
            'add_new' => 'Dodaj smak',
        ]
    ]);
});

add_action('add_meta_boxes', function () {
	add_meta_box(
		'praliny_candy_extra_image',
		'Dodatkowy obrazek',
		'extra_image_meta_box_callback',
		'praliny_candy',
		'side',
		'default'
	);
});


function extra_image_meta_box_callback($post) {
	wp_nonce_field('save_extra_image_nonce', 'extra_image_nonce');

	$image_id = get_post_meta($post->ID, '_extra_image_id', true);
	$image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';

	echo '<div>';
	echo '<img id="extra-image-preview" src="' . esc_url($image_url) . '" style="max-width:100%; display:block; margin-bottom:10px;" />';
	echo '<input type="hidden" id="extra_image_id" name="extra_image_id" value="' . esc_attr($image_id) . '" />';
	echo '<button type="button" class="button" id="upload-extra-image">Wybierz obrazek</button>';
	echo '</div>';

	// Enqueue media uploader
	?>
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		let frame;
		const button = document.getElementById('upload-extra-image');
		const input = document.getElementById('extra_image_id');
		const preview = document.getElementById('extra-image-preview');

		button.addEventListener('click', function(e) {
			e.preventDefault();

			if (frame) {
				frame.open();
				return;
			}

			frame = wp.media({
				title: 'Wybierz obrazek',
				button: { text: 'Użyj tego obrazka' },
				multiple: false
			});

			frame.on('select', function() {
				const attachment = frame.state().get('selection').first().toJSON();
				input.value = attachment.id;
				preview.src = attachment.url;
			});

			frame.open();
		});
	});
	</script>
	<?php
}


add_action('save_post_praliny_candy', function ($post_id) {
	if (!isset($_POST['extra_image_nonce']) || !wp_verify_nonce($_POST['extra_image_nonce'], 'save_extra_image_nonce')) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	if (isset($_POST['extra_image_id'])) {
		update_post_meta($post_id, '_extra_image_id', intval($_POST['extra_image_id']));
	}
});
