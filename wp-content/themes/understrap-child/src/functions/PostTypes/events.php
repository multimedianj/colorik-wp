<?php
//-- Événements
function create_pt_events() {
  register_post_type('events',
    array(
      'labels' => array(
        'name'          => __('Événements'),
        'singular_name' => __('Événement'),
      ),
      'menu_icon'       => 'dashicons-calendar-alt',
      'public'          => true,
      'has_archive'     => true,
    )
  );
}
add_action('init', 'create_pt_events');
?>
