<?php
//-- Login Styles
function login_styles() {
    $the_theme = wp_get_theme();
    wp_enqueue_style('login-styles', get_stylesheet_directory_uri() . '/css/login-styles.css', array(), $the_theme->get('Version'));
}
add_action('login_enqueue_scripts', 'login_styles' );
?>
