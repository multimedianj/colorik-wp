<?php
/*
 * Template Name: Réalisations
 */
?>

<?php
$projectsArgs = array(
    'post_type'=> 'projet',
    'order'    => 'ASC'
);
$projet = new WP_Query($projectsArgs);

//-- Get all taxonomies from projects Post Type
$post_type = 'projet';
$taxonomies = get_object_taxonomies((object) array('post_type' => $post_type));
// Gets every "category" (term) in this taxonomy to get the respective posts
$taxonomy = 'categorie';
$terms = get_terms($taxonomy);
?>

<?php the_post(); ?>
<?php get_header(); ?>

<!-- Loop trought taxonomies -->
<?php foreach ($taxonomies as $taxonomy) : ?>
    <?php foreach ($terms as $term) : ?>
        <?php
        $taxArgs = array(
            'taxonomy'       => $taxonomy,
            'term'           => $term->slug,
            'posts_per_page' => 2
        );
        $posts = new WP_Query($taxArgs);
        ?>
        
        <?php if ($posts->have_posts()) : ?>
            <?php while ($posts->have_posts()) : $posts->the_post(); ?>
                <!-- Do you general query loop here -->
                <a href="<?php echo get_term_link($term); ?>">
                    <?php echo $term->name ?>
                </a>
            <?php endwhile; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>
<?php wp_reset_query(); ?>

<div class="container">
    <div class="row projects">
        <?php if ($projet->have_posts()) : ?>
            <?php while ($projet->have_posts()) : $projet->the_post(); ?>
                <div class="card member col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php $img = wp_get_attachment_url(get_post_thumbnail_id()); ?>
                        <img class="card-img-top" src="<?php echo $img; ?>">
                    <?php else : ?>
                        <img class="card-img-top" src="<?php echo esc_url(home_url('/')) . 'wp-content/themes/understrap-child/src/img/img-placeholder.jpg'; ?>">
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?php the_title(); ?></h5>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
    </div>
</div>




<?php
add_action( 'wp_ajax_nopriv_load-filter', 'prefix_load_cat_posts' );
    add_action( 'wp_ajax_load-filter', 'prefix_load_cat_posts' );

    function prefix_load_cat_posts () {
        var_dump('test');
   ob_start (); 
 
     $cat_id = $_POST[ 'data' ];

 $pages = get_posts(array(
    'post_type' => 'projet',
    'tax_query' => array(
        array(
        'taxonomy' => 'categorie',
        'terms' =>$cat_id)
    ))
);

foreach ($pages as $mypost) {
    echo 'bob1234';
      echo $mypost->post_title . '<br/>';
      echo $mypost->post_content . '<br/>';

}

      $response = ob_get_contents();
      ob_end_clean();

      echo $response;
 
   die();

    }
    ?>

 <ul>
  <?php
 
   $terms = get_terms('categorie');

   foreach ( $terms as $term ) {
    
      echo  '<li><a href="#" data-slug="' . $term->term_id . '" class="js-category-button">' . $term->name. '</a></li>';
    
    
   }
  ?>
 </ul>
<div class="the-news">
</div>


<script>
jQuery(document).ready(function($){
jQuery.noConflict();
    $('.js-category-button').on('click', function(e){
      e.preventDefault();
      var catID = $(this).attr('data-slug');
 
   //alert(catID);
      var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ) ?>';
 
   jQuery.post(
   ajaxurl,
   {
    'action': 'load-filter',
    'data':   catID
   },
   function(response){
    //alert(response);
     $(".the-news").html(response);
   }
  );

    }) 
 
 });





<?php get_footer(); ?>
