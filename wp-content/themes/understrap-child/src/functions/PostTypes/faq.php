<?php
//-- FAQ
function create_pt_faq() {
  register_post_type('faq',
    array(
      'labels' => array(
        'name'          => __('FAQ'),
        'singular_name' => __('FAQ'),
      ),
      'menu_icon'       => 'dashicons-format-quote',
      'public'          => true,
      'has_archive'     => true,
    )
  );
}
add_action('init', 'create_pt_faq');
?>
