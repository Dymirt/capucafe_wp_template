<?php
add_action('init', function () {
    register_post_type('torty_smaki', [
        'label' => 'Torty Smaki',
        'public' => false,
        'show_ui' => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-carrot',
        'supports' => ['title', 'thumbnail'],
        'has_archive' => false,
        'show_in_rest' => true,
        'labels' => [
            'name' => 'Smaki Tortów',
            'singular_name' => 'Smak tortu',
            'add_new' => 'Dodaj smak',
        ]
    ]);
});

add_action('add_meta_boxes', function () {
	add_meta_box(
		'torty_smaki_opis',
		'Opis smaku',
		function ($post) {
			$value = get_post_meta($post->ID, '_torty_smaki_opis', true);
			echo '<input type="text" name="torty_smaki_opis" value="' . esc_attr($value) . '" style="width:100%;" />';
		},
		'torty_smaki',
		'normal',
		'default'
	);
});

add_action('save_post_torty_smaki', function ($post_id) {
	if (isset($_POST['torty_smaki_opis'])) {
		update_post_meta($post_id, '_torty_smaki_opis', sanitize_text_field($_POST['torty_smaki_opis']));
	}
});
