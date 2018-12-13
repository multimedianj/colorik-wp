<?php
//-- Menu Admin Custom Class
function admin_menu_custom_class()  {
    global $menu;

    foreach ($menu as $key => $value) {
        if (
            'menu-posts-homepage_slider' == $value[5] ||
            'menu-posts-store_locator'   == $value[5] ||
            'menu-posts-projet'          == $value[5] ||
            'menu-posts-services'        == $value[5] ||
            'menu-posts-career'          == $value[5] ||
            'menu-posts-membre'          == $value[5] ||
            'menu-posts-testimonials'    == $value[5] ||
            'menu-posts-partners'        == $value[5] ||
            'menu-posts-distinctions'    == $value[5] ||
            'menu-posts-faq'             == $value[5] ||
            'menu-posts-toolbox'         == $value[5] ||
            'menu-posts-events'          == $value[5] ||
            'menu-posts-catalog'         == $value[5]
        ) {
            $menu[$key][4] .= " colorik-theme-style";
        }
    }
}
add_action('admin_init','admin_menu_custom_class');

//-- Admin Styles
function admin_enqueue_styles() {
	$the_theme = wp_get_theme();
    wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/css/admin-styles.css', array(), $the_theme->get('Version'));
}
add_action('admin_head', 'admin_enqueue_styles');
?>
