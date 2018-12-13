<?php
//-- Homepage Slider
function create_pt_homepage_slider() {
  register_post_type('homepage_slider',
    array(
      'labels' => array(
        'name'          => __('Carousel'),
        'singular_name' => __('Slide'),
      ),
      'menu_icon'       => 'dashicons-images-alt',
      'public'             => true,
      'publicly_queryable' => false,
      'has_archive'        => false,
      'supports' => array('title','editor','thumbnail')
    )
  );
}
add_action('init', 'create_pt_homepage_slider');
?>
