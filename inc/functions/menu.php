<?php
class Footer_Walker_Nav_Menu extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = []) {
        $output .= '<ul class="ccafe-footer-submenu">';
    }
    function end_lvl(&$output, $depth = 0, $args = []) { $output .= '</ul>'; }
    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        $children = in_array('menu-item-has-children', (array) $item->classes, true);
        $output .= '<li class="ccafe-footer-menu-item">';
        if ($children) {
            $output .= '<details class="ccafe-footer-group"><summary>' . esc_html($item->title) . '</summary>';
            if (substr($item->url, -1) !== '#') $output .= '<a class="ccafe-footer-overview" href="' . esc_url($item->url) . '">Zobacz: ' . esc_html($item->title) . '</a>';
        } else {
            $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        }
    }
    function end_el(&$output, $item, $depth = 0, $args = []) {
        if (in_array('menu-item-has-children', (array) $item->classes, true)) $output .= '</details>';
        $output .= '</li>';
    }
}

class Header_Walker_Nav_Menu extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = []) { $output .= '<div class="ccafe-menu-children">'; }
    function end_lvl(&$output, $depth = 0, $args = []) { $output .= '</div>'; }
    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        $children = !empty($this->has_children);
        $output .= '<div class="ccafe-menu-item">';
        if ($children) {
            $output .= '<details><summary>' . esc_html($item->title) . '</summary>';
            if (substr($item->url, -1) !== '#') $output .= '<a class="ccafe-menu-parent" href="' . esc_url($item->url) . '">Zobacz: ' . esc_html($item->title) . '</a>';
        } else {
            $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        }
    }
    function end_el(&$output, $item, $depth = 0, $args = []) {
        $output .= !empty($item->classes) && in_array('menu-item-has-children', $item->classes, true) ? '</details></div>' : '</div>';
    }
}
class Top_Walker_Nav_Menu extends Walker_Nav_Menu
{

	function start_lvl(&$output, $depth = 0, $args = [])
	{
		// No default submenu
	}

	function end_lvl(&$output, $depth = 0, $args = [])
	{
		// No submenu close
	}

	function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
	{
		if ($depth === 0) {
			$has_children = !empty($args->has_children);

			$output .= '<div class="relative group flex justify-center items-center gap-2.5">';

			$output .= '<a href="' . esc_url($item->url) . '" class="text-zinc-800 text-base font-light uppercase">' . esc_html($item->title) . '</a>';

			if ($has_children && !empty($args->child_menu_items)) {


				if ($has_children && !empty($args->child_menu_items)) {
					$with_thumbnails = [];
					$without_thumbnails = [];

					// First pass: sort children
					foreach ($args->child_menu_items as $child) {
						$thumbnail = get_the_post_thumbnail_url($child->object_id, 'large');
						if ($thumbnail) {
							$with_thumbnails[] = [
								'item' => $child,
								'thumbnail' => $thumbnail
							];
						} else {
							$without_thumbnails[] = $child;
						}
					}

					$output .= '
				<div class="fixed flex justify-center  basis-full items-center top-[100px] h-72 left-0 mt-2 w-full py-8 bg-white border border-stone-300 shadow-lg rounded text-sm !text-stone-800
							opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 gap-10">
					';

					// 🔤 Group: without thumbnails
					if (!empty($without_thumbnails)) {
						$output .= '<div class="flex flex-col min-w-80 items-start ">';
						foreach ($without_thumbnails as $child) {
							$output .= '<div class="py-1 menu-item-swap">';
							$output .= '<a href="' . esc_url($child->url) . '" class="!text-stone-600 hover:underline">';
							$output .= esc_html($child->title);
							$output .= '</a>';
							$output .= '</div>';
						}
						$output .= '</div>';
					}

					// 🖼️ Group: with thumbnails
					if (!empty($with_thumbnails)) {
						foreach ($with_thumbnails as $item_data) {
							$child = $item_data['item'];
							$thumb = $item_data['thumbnail'];

							$title = esc_html($child->title);
							$words = explode(' ', $title);
							$multiline_title = implode('<br>', $words);



							$output .= '<div class="relative h-full">';
							$output .= '<a href="' . esc_url($child->url) . '" class="text-stone-700 hover:underline">';
							$output .= '<img src="' . esc_url($thumb) . '" class="!w-full !h-full object-cover rounded mb-2" alt="' . esc_attr($child->title) . '">';
							$output .= '<div class="absolute left-8 top-1/2 -translate-y-1/2 text-center text-4xl text-left text-white font-[\'Didot_LT_Pro\']">' . $multiline_title . '</div>';
							$output .= '</a>';
							$output .= '</div>';
						}
					}



					$output .= '</div>'; // close modal
				}
			}

			$output .= '</div>';
		}
	}

	function end_el(&$output, $item, $depth = 0, $args = [])
	{
		// Nothing to close
	}

	public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args = [], &$output = '')
	{
		$id_field = $this->db_fields['id'];

		// Set has_children flag
		$args[0]->has_children = !empty($children_elements[$element->$id_field]);

		// If children exist, pass them to the element renderer
		if (!empty($args[0]->has_children)) {
			$args[0]->child_menu_items = $children_elements[$element->$id_field];
		} else {
			$args[0]->child_menu_items = [];
		}

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}


register_nav_menus(
	array(
		'top-menu' => 'Top menu location',
		'mobile-menu' => "Mobile menu location",
		'footer-mobile-menu-location' => 'Footer mobile menu location',
		'footer-desktop-menu-location' => 'Footer desktop menu location'
	)
);
