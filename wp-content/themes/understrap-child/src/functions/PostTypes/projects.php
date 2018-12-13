<?php
//-- Projects
function create_pt_projects() {
  register_post_type('projet',
    array(
      'labels' => array(
        'name'          => __('Réalisations'),
        'singular_name' => __('Réalisation'),
      ),
      'menu_icon'       => 'dashicons-admin-home',
      'public'          => true,
      'has_archive'     => true,
      'supports'        => array('title','thumbnail','editor')
    )
  );
}
add_action('init', 'create_pt_projects');
?>
