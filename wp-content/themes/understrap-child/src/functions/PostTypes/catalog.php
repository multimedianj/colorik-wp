<?php
//-- Catalogue de produits
function create_pt_catalog() {
  register_post_type('catalog',
    array(
      'labels' => array(
        'name'          => __('Catalogue'),
        'singular_name' => __('Produit'),
      ),
      'menu_icon'       => 'dashicons-products',
      'public'          => true,
      'has_archive'     => true,
    )
  );
}
add_action('init', 'create_pt_catalog');
?>
