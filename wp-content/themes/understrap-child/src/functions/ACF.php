<?php
//-- Theme Options
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
        'position'      => 1,
        'icon_url'      => 'https://colorik.com/favicon/favicon-theme-settings.png',
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Colorik Options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
}


//-- Save JSON file
function my_acf_json_save_point( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/src/functions/acf-json';
    
    // return
    return $path;
}
add_filter('acf/settings/save_json', 'my_acf_json_save_point');


//-- Load JSON file
function my_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    
    // append path
    $paths[] = get_stylesheet_directory() . '/src/functions/acf-json';
    
    // return
    return $paths;
}
add_filter('acf/settings/load_json', 'my_acf_json_load_point');


//-- Google Maps API KEY
function my_acf_google_map_api($api) {
	$api['key'] = 'AIzaSyCaaSz-iQiVbm1K8rj-IwH_hqYIiiej3uo';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
?>
