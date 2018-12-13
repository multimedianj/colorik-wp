<?php
//-- Partenaires
function create_pt_partners() {
  register_post_type('partners',
    array(
      'labels' => array(
        'name'          => __('Partenaires'),
        'singular_name' => __('Partenaire'),
      ),
      'menu_icon'       => 'dashicons-heart',
      'public'          => true,
      'has_archive'     => true,
    )
  );
}
add_action('init', 'create_pt_partners');
?>
