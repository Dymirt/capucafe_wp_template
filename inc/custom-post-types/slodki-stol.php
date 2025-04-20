<?php
// Register Custom Post Type

function init_slodki_stol()
{
    $labels = array(
        'name'                  => _x('Słodkie Stoły', 'Post Type General Name', 'capucafe'),
        'singular_name'         => _x('Słodki Stół', 'Post Type Singular Name', 'capucafe'),
        'menu_name'             => __('Słodkie Stoły', 'capucafe'),
        'name_admin_bar'        => __('Słodkie Stoły', 'capucafe'),
        'archives'              => __('Archiwa', 'capucafe'),
        'attributes'            => __('Atrybuty', 'capucafe'),
        'parent_item_colon'     => __('Rodzic:', 'capucafe'),
        'all_items'             => __('Wszystkie Stoły', 'capucafe'),
        'add_new_item'          => __('Dodaj nowy słodki stół', 'capucafe'),
        'add_new'               => __('Dodaj Nowy', 'capucafe'),
        'new_item'              => __('Nowy stół', 'capucafe'),
        'edit_item'             => __('Edytuj stół', 'capucafe'),
        'update_item'           => __('Zaktualizuj stół', 'capucafe'),
        'view_item'             => __('Zobacz stół', 'capucafe'),
        'view_items'            => __('Zobacz stoły', 'capucafe'),
        'search_items'          => __('Wyszukaj stół', 'capucafe'),
        'not_found'             => __('Nie znaleziono', 'capucafe'),
        'not_found_in_trash'    => __('Nie znaleziono w koszu', 'capucafe'),
        'featured_image'        => __('Zdjęcie podglądowe', 'capucafe'),
        'set_featured_image'    => __('Ustaw zdjęcie podglądowe', 'capucafe'),
        'remove_featured_image' => __('Usuń zdjęcie podglądowe', 'capucafe'),
        'use_featured_image'    => __('Użyj zdjęcia podglądowego', 'capucafe'),
        'insert_into_item'      => __('Wstaw do stołu', 'capucafe'),
        'uploaded_to_this_item' => __('Wstawiono do stołu', 'capucafe'),
        'items_list'            => __('Lista stołów', 'capucafe'),
        'items_list_navigation' => __('Nawigacja stołów', 'capucafe'),
        'filter_items_list'     => __('Filtracja stołów', 'capucafe'),
    );
    $args = array(
        'label'                 => __('Słodki Stół', 'capucafe'),
        'description'           => __('Słodki Stół', 'capucafe'),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'content', 'thumbnail', 'custom-fields', 'page-attributes', 'post-formats' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-chart-pie',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type('slodki-stol', $args);
}
add_action('init', 'init_slodki_stol', 0);
