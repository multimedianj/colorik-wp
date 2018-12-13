<?php
/*
 * Template Name: Team
 */
?>

<?php
$teamArgs = array(
    'post_type'=> 'membre',
    'order'    => 'ASC'
);
$team = new WP_Query($teamArgs);
?>

<?php the_post(); ?>
<?php get_header(); ?>

<div class="container">
    <div class="row team">
        <?php if ($team->have_posts()) : ?>
            <?php while ($team->have_posts()) : $team->the_post(); ?>
                <div class="card member col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php $img = wp_get_attachment_url(get_post_thumbnail_id()); ?>
                        <img class="card-img-top" src="<?php echo $img; ?>">
                    <?php else : ?>
                        <img class="card-img-top" src="<?php echo esc_url(home_url('/')) . 'wp-content/themes/understrap-child/src/img/img-placeholder.jpg'; ?>">
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?php the_title(); ?></h5>
                        <p class="card-text"><?php the_field('team_job'); ?></p>
                        <a href="mailto:<?php the_field('team_email'); ?>" class="btn btn-primary"><?php _e('Me contacter', APPDOMAIN); ?></a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
    </div>
</div>

<?php get_footer(); ?>
