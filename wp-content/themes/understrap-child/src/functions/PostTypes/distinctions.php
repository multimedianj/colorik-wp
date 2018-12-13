<?php
//-- Distinctions
function create_pt_distinctions() {
  register_post_type('distinctions',
    array(
      'labels' => array(
        'name'          => __('Prix & Distinctions'),
        'singular_name' => __('Distinction'),
      ),
      'menu_icon'       => 'dashicons-awards',
      'public'          => true,
      'has_archive'     => true,
    )
  );
}
add_action('init', 'create_pt_distinctions');
?>
