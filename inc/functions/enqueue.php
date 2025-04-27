<?php
function tailwind_enqueue_scripts() {
    // Load Tailwind compiled CSS
    wp_enqueue_style(
        'tailwind',
        get_stylesheet_directory_uri() . '/public/css/tailwind.css',
        array(), // No dependencies
        filemtime(get_stylesheet_directory() . '/assets/css/tailwind.css')
    );
}
add_action('wp_enqueue_scripts', 'tailwind_enqueue_scripts', 20);

function capucafe_enqueue_assets()
{

	$asset = include get_theme_file_path( 'public/css/screen.asset.php' );

	// Frontend Styles (LTR)
	wp_register_style(
		'capucafe-style',
		get_stylesheet_directory_uri() . '/public/css/screen.css',
		array('storefront-child-style'),
		$asset['version']
	);

	// RTL version
	wp_style_add_data('capucafe-style', 'rtl', 'replace');

	// Enqueue the correct version based on language direction
	wp_enqueue_style('capucafe-style');
}
add_action('wp_enqueue_scripts', 'capucafe_enqueue_assets');

function capucafe_add_editor_styles()
{
	add_editor_style('public/css/editor.css');

	// Optional: handle RTL manually if needed
	if (is_rtl()) {
		add_editor_style('public/css/editor-rtl.css');
	}
}
add_action('after_setup_theme', 'capucafe_add_editor_styles');


function capucafe_enqueue_frontend_scripts()
{
	$asset = include get_theme_file_path( 'public/css/frontend.asset.php' );

	wp_enqueue_script(
		'capucafe-frontend-js',
		get_stylesheet_directory_uri() . '/public/js/frontend.js',
		$asset['dependencies'],
		$asset['version'],
		true
	);
}
add_action('wp_enqueue_scripts', 'capucafe_enqueue_frontend_scripts');


function capucafe_enqueue_editor_script() {
    $asset = include get_stylesheet_directory() . '/public/js/editor.asset.php';

    wp_enqueue_script(
        'capucafe-editor-js',
        get_stylesheet_directory_uri() . '/public/js/editor.js',
        $asset['dependencies'],
        $asset['version'],
        true
    );
}
add_action('enqueue_block_editor_assets', 'capucafe_enqueue_editor_script');


function enqueue_custom_fonts() {
    wp_enqueue_style(
        'custom-google-fonts',
        'https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;600;700&display=swap',
        false
    );
}
add_action('wp_enqueue_scripts', 'enqueue_custom_fonts');
