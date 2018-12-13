<?php
//-- Testimonials
function create_pt_testimonials() {
  register_post_type('testimonials',
    array(
      'labels' => array(
        'name'          => __('Témoignages'),
        'singular_name' => __('Témoignage'),
      ),
      'menu_icon'       => 'dashicons-format-status',
      'public'          => true,
      'has_archive'     => true,
    )
  );
}
add_action('init', 'create_pt_testimonials');
?>
