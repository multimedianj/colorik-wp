<?php
//-- Career
function create_pt_career() {
  register_post_type('career',
    array(
      'labels' => array(
        'name'          => __('Emplois'),
        'singular_name' => __('Emploi'),
      ),
      'menu_icon'       => 'dashicons-businessman',
      'public'          => true,
      'has_archive'     => true,
    )
  );
}
add_action('init', 'create_pt_career');
?>
