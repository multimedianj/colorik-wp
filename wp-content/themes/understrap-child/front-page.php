<?php the_post(); ?>
<?php get_header(); ?>

<?php get_template_part('src/templates/template-homepage-slider'); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
