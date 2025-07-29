<?php
class Footer_Walker_Nav_Menu extends Walker_Nav_Menu
{

	private $submenu_id = 0;

	function start_lvl(&$output, $depth = 0, $args = [])
	{
		$this->submenu_id++;
		$output .= '<div id="submenu-' . $this->submenu_id . '" class="submenu flex flex-col gap-2 hidden md:flex">';
	}

	function end_lvl(&$output, $depth = 0, $args = [])
	{
		$output .= '</div>'; // Close the submenu container
		$output .= '</div>'; // Close the parent wrapper
	}

	function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
	{
		if ($depth === 0) {
			$has_children = !empty($item->has_children);
			if ($has_children){
				$output .= '<div>';
			}

			$output .= '<div class="w-full md:w-48 min-w-44 flex flex-row md:flex-col content-start">';
			$output .= '<a class="justify-start !text-stone-400 text-sm font-bold font-[\'Mulish\'] uppercase !no-underline" href="' . esc_url($item->url) . '">';
			$output .= esc_html($item->title);
			$output .= '</a>';

			// 🛠 Check if this item has children
			//$has_children = !empty($args->has_children);

			if ($has_children) {
				$submenu_id = $this->submenu_id + 1; // next submenu created in start_lvl
				$output .= '<div class="w-6 h-6 md:hidden flex justify-center items-center cursor-pointer content-start" onclick="toggleSubmenu(\'submenu-' . $submenu_id . '\')">';
				$output .= '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12.6001L15.9 8.7001C16.0833 8.51676 16.3167 8.4251 16.6 8.4251C16.8833 8.4251 17.1167 8.51676 17.3 8.7001C17.4833 8.88343 17.575 9.11676 17.575 9.4001C17.575 9.68343 17.4833 9.91676 17.3 10.1001L12.7 14.7001C12.6 14.8001 12.4917 14.8709 12.375 14.9126C12.2583 14.9543 12.1333 14.9751 12 14.9751C11.8667 14.9751 11.7417 14.9543 11.625 14.9126C11.5083 14.8709 11.4 14.8001 11.3 14.7001L6.69999 10.1001C6.51665 9.91676 6.42499 9.68343 6.42499 9.4001C6.42499 9.11676 6.51665 8.88343 6.69999 8.7001C6.88332 8.51676 7.11665 8.4251 7.39999 8.4251C7.68332 8.4251 7.91665 8.51676 8.09999 8.7001L12 12.6001Z" fill="#A9957B"/>
                            </svg>';
				$output .= '</div>';
				$output .= '</div>';
			} else {
				$output .= '</div>';
			}
		} else {
			$output .= '<a class="justify-start font-[\'Mulish\'] pl-4 !no-underline self-stretch justify-start !text-white text-sm font-normal leading-tight basis-full" href="' . esc_url($item->url) . '">';
			$output .= esc_html($item->title);
			$output .= '</a>';
		}
	}

	function end_el(&$output, $item, $depth = 0, $args = [])
	{
		// Nothing to close
	}

	// 🛠 This is needed to pass "has_children"
	public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args = [], &$output = '')
	{
		if (!$element) return;
		$id_field = $this->db_fields['id'];

		// Check if has children
		if (!empty($children_elements[$element->$id_field])) {
			$element->has_children = true;
		}

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}

class Header_Walker_Nav_Menu extends Walker_Nav_Menu
{
	private $submenu_id = 0;

	function start_lvl(&$output, $depth = 0, $args = [])
	{
		// Start submenu container inside the parent wrapper
		$output .= '<div class="Frame56 self-stretch flex flex-col justify-start items-start gap-3 duration-150 bg-white">';
	}

	function end_lvl(&$output, $depth = 0, $args = [])
	{
		$output .= '</div>'; // End submenu container
	}

	function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
	{
		$has_children = !empty($item->has_children);
		$title = esc_html($item->title);
		$url = esc_url($item->url);

		if ($depth === 0) {
			$output .= '<div class="Frame56 self-stretch w-full px-6 pt-8 pb-5 border-b border-neutral-100 inline-flex flex-col justify-between items-start gap-3 bg-white">';
			$output .= '<div class="Frame79 self-stretch inline-flex justify-start items-center">';
			$output .= '<a href="' . $url . '" class="Sklep flex-1 h-3.5 justify-start text-zinc-800 text-sm font-bold font-[\'Mulish\'] uppercase leading-tight">';
			$output .= $title . '</a>';

			if ($has_children) {
				$output .= '<div class="BoundingBox size-6" onclick="toggleMenuSiblings(this)">';
				$output .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><mask id="mask0_474_36488" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24"><rect x="24" width="24" height="24" transform="rotate(90 24 0)" fill="#D9D9D9"/></mask><g mask="url(#mask0_474_36488)"><path d="M12.0001 10.8L8.10007 14.7C7.91674 14.8834 7.68341 14.975 7.40007 14.975C7.11674 14.975 6.88341 14.8834 6.70007 14.7C6.51674 14.5167 6.42507 14.2834 6.42507 14C6.42507 13.7167 6.51674 13.4834 6.70007 13.3L11.3001 8.70005C11.4001 8.60005 11.5084 8.52922 11.6251 8.48755C11.7417 8.44588 11.8667 8.42505 12.0001 8.42505C12.1334 8.42505 12.2584 8.44588 12.3751 8.48755C12.4917 8.52922 12.6001 8.60005 12.7001 8.70005L17.3001 13.3C17.4834 13.4834 17.5751 13.7167 17.5751 14C17.5751 14.2834 17.4834 14.5167 17.3001 14.7C17.1167 14.8834 16.8834 14.975 16.6001 14.975C16.3167 14.975 16.0834 14.8834 15.9001 14.7L12.0001 10.8Z" fill="#A9957B"/></g></svg>';
				$output .= '</div>'; // End BoundingBox
			}

			$output .= '</div>'; // End Frame79
			// Note: submenu div will open in start_lvl()
		} else {
			$output .= '<div class="justify-start text-zinc-800 text-sm font-normal font-[\'Mulish\'] leading-tight">';
			$output .= '<a href="' . $url . '">' . $title . '</a>';
			$output .= '</div>';
		}
	}

	function end_el(&$output, $item, $depth = 0, $args = [])
	{
		if ($depth === 0) {
			$output .= '</div>'; // close the outer Frame56
		}
	}

	public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args = [], &$output = '')
	{
		if (!$element) return;

		$id_field = $this->db_fields['id'];
		if (!empty($children_elements[$element->$id_field])) {
			$element->has_children = true;
		}

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
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
