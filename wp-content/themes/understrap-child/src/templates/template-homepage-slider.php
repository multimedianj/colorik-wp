<?php
/*
 * Template Name: Store Locator
 */
?>

<?php
$homepageSliderArgs = array(
    'post_type'=> 'homepage_slider',
    'order'    => 'ASC',
    'oderby' => 'menu_order',
    'posts_per_page' => -1
);
$homepageSlider = new WP_Query($homepageSliderArgs);
?>

<div class="container-fluid container-home-slider">
    <div class="row">
        <div class="col-12">
            <?php if ($homepageSlider->have_posts()) : ?>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php $index = 0; ?>
                        <?php while ($homepageSlider->have_posts()) : $homepageSlider->the_post(); $index++; ?>
                            <?php $url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
                            <div class="carousel-item <?php if ($index==1) : ?>active<?php endif; ?>">
                                <div class="d-block img-fluid" style="background-image:url('<?php echo $url; ?>');">
                                    <div class="carousel-caption">
                                        <h2><?php the_title(); ?></h2>
                                        <p><?php the_content(); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <?php if ($index > 1) : ?>
                        <ol class="carousel-indicators">
                            <?php $index = 0; ?>
                            <?php while ($homepageSlider->have_posts()) : $homepageSlider->the_post(); $index++; ?>
                                <li
                                    data-target="#carouselExampleIndicators"
                                    data-slide-to="<?= $index; ?>"
                                    class="<?php if ($index==1) : ?>active<?php endif; ?>">
                                </li>
                            <?php endwhile; ?>
                        </ol>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php wp_reset_query(); ?>
