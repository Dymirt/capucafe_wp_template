<?php
class Footer_Walker_Nav_Menu extends Walker_Nav_Menu {

    private $submenu_id = 0;

    function start_lvl(&$output, $depth = 0, $args = []) {
        $this->submenu_id++;
        $output .= '<div id="submenu-' . $this->submenu_id . '" class="submenu ml-4 flex flex-col gap-2 hidden">';
    }

    function end_lvl(&$output, $depth = 0, $args = []) {
        $output .= '</div>';
    }

    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        // Only for top-level items
        if ($depth === 0) {
            $current_id = $this->submenu_id + 1; // because start_lvl increments after

            $output .= '<div class="self-stretch inline-flex justify-between items-center">';
            $output .= '<div class="flex-1 h-3.5 justify-start text-stone-400 text-sm font-bold font-[\'Mulish\'] uppercase leading-tight">';
            $output .= esc_html($item->title);
            $output .= '</div>';
            $output .= '<div class="w-6 h-6 bg-zinc-300 flex justify-center items-center cursor-pointer" onclick="toggleSubmenu(\'submenu-' . $current_id . '\')">';
            $output .= '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12.6001L15.9 8.7001C16.0833 8.51676 16.3167 8.4251 16.6 8.4251C16.8833 8.4251 17.1167 8.51676 17.3 8.7001C17.4833 8.88343 17.575 9.11676 17.575 9.4001C17.575 9.68343 17.4833 9.91676 17.3 10.1001L12.7 14.7001C12.6 14.8001 12.4917 14.8709 12.375 14.9126C12.2583 14.9543 12.1333 14.9751 12 14.9751C11.8667 14.9751 11.7417 14.9543 11.625 14.9126C11.5083 14.8709 11.4 14.8001 11.3 14.7001L6.69999 10.1001C6.51665 9.91676 6.42499 9.68343 6.42499 9.4001C6.42499 9.11676 6.51665 8.88343 6.69999 8.7001C6.88332 8.51676 7.11665 8.4251 7.39999 8.4251C7.68332 8.4251 7.91665 8.51676 8.09999 8.7001L12 12.6001Z" fill="#A9957B"/>
                        </svg>';
            $output .= '</div>';
            $output .= '</div>';
        } else {
            $output .= '<div class="flex-1 h-3 justify-start text-stone-300 text-xs font-bold font-[\'Mulish\'] uppercase leading-tight pl-4">';
            $output .= esc_html($item->title);
            $output .= '</div>';
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = []) {
        // nothing needed
    }
}


register_nav_menus(
	array(
		'top-menu' => 'Top menu location',
		'mobile-menu' => "Mobile menu location",
		'footer-menu-location' => 'Footer menu location'
	)
);

?>
<!--
<div class="self-stretch inline-flex justify-between items-center">
<div class="flex-1 h-3.5 justify-start text-stone-400 text-sm font-bold font-['Mulish'] uppercase leading-tight">Sklep</div>
<div class="w-6 h-6 bg-zinc-300"></div>
<div class="w-1.5 h-3 origin-top-left rotate-180 bg-stone-400"></div>
</div>
-->
