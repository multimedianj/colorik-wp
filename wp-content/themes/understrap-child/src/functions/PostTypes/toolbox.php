<?php
//-- Boîte à outils
function create_pt_toolbox() {
  register_post_type('toolbox',
    array(
      'labels' => array(
        'name'          => __('Boîte à outils'),
        'singular_name' => __('item'),
      ),
      'menu_icon'       => 'dashicons-hammer',
      'public'          => true,
      'has_archive'     => true,
    )
  );
}
add_action('init', 'create_pt_toolbox');
?>
