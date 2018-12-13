<?php
//-- Team
function create_pt_team() {
  register_post_type('membre',
    array(
      'labels' => array(
        'name'          => __('Équipe'),
        'singular_name' => __('Coéquipier'),
      ),
      'menu_icon'       => 'dashicons-groups',
      'public'          => true,
      'has_archive'     => false,
      'supports'        => array('title','thumbnail')
    )
  );
}
add_action('init', 'create_pt_team');
?>
