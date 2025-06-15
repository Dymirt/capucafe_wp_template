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
