<?php
//-- Store Locator
function create_pt_store_locator() {
  register_post_type('store_locator',
    array(
      'labels' => array(
        'name'             => __('Store Locator'),
        'singular_name'    => __('Store'),
      ),
      'menu_icon'          => 'dashicons-location',
      'public'             => true,
      'publicly_queryable' => false,
      'has_archive'        => false,
      'supports' => array('title','thumbnail')
    )
  );
}
add_action('init', 'create_pt_store_locator');
?>
