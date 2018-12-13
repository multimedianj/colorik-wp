<?php
//-- Services
function create_pt_services() {
  register_post_type('services',
    array(
      'labels' => array(
        'name'          => __('Services'),
        'singular_name' => __('Service'),
      ),
      'menu_icon'       => 'dashicons-admin-tools',
      'public'          => true,
      'has_archive'     => true,
    )
  );
}
add_action('init', 'create_pt_services');
?>
