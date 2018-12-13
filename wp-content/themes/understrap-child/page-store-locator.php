<?php
/*
 * Template Name: Store Locator
 */
?>

<?php
$storeLocatorArgs = array(
    'post_type'=> 'store_locator',
    'order'    => 'ASC'
);
$storeLocator = new WP_Query($storeLocatorArgs);
?>

<?php get_header(); ?>

<div class="row store-locator">
    <div id="locations-map" class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="locations">
            <?php if ($storeLocator->have_posts()) : ?>
            	<?php while ($storeLocator->have_posts()) : $storeLocator->the_post(); ?>
                    <?php if (have_rows('store_locator_votre_magasin')) : ?>
                        <?php while (have_rows('store_locator_votre_magasin')) : the_row(); ?>
                            <?php $location = get_sub_field('store_locator_map_localisation'); ?>
                            <?php $telephone = get_sub_field('store_locator_telephone'); ?>
                            <?php $subtitle = get_sub_field('store_locator_titre_magasin'); ?>
                            <div class="location mb-3" data-id="<?= get_the_ID(); ?>" data-name="<?php the_title(); ?>" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" data-territory="" data-id="910" data-name="ADVANCED&nbsp;Traffic Products, Inc.">
                                <span></span>
                                <h2><?php the_title(); ?></h2>
                                <?php if (!empty($subtitle)) : ?>
                                    <h3><?php the_title(); ?></h3>
                                <?php endif; ?>
                                <p class="map_adresse">
                                    <?php echo $location['address']; ?>
                                </p>
                                <?php if (!empty($telephone)) : ?>
                                    <p>
                                        Tel: <a href="tel:<?php echo $telephone; ?>"><?php echo $telephone; ?></a>
                                    </p>
                                <?php endif; ?>
                                <div class="table">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr valign="middle">
                                                <td align="left"><?php _e('Dimanche:', APPDOMAIN); ?></td>
                                                <td align="right">
                                                    <?php echo get_sub_field('store_locator_dimanche_de') ?>
                                                    &nbsp;-&nbsp;
                                                    <?php echo get_sub_field('store_locator_dimanche_a') ?>
                                                </td>
                                            </tr>
                                            <tr valign="middle">
                                                <td align="left"><?php _e('Lundi:', APPDOMAIN); ?></td>
                                                <td align="right">
                                                    <?php echo get_sub_field('store_locator_lundi_de') ?>
                                                    &nbsp;-&nbsp;
                                                    <?php echo get_sub_field('store_locator_lundi_a') ?>
                                                </td>
                                            </tr>
                                            <tr valign="middle">
                                                <td align="left"><?php _e('Mardi:', APPDOMAIN); ?></td>
                                                <td align="right">
                                                    <?php echo get_sub_field('store_locator_mardi_de') ?>
                                                    &nbsp;-&nbsp;
                                                    <?php echo get_sub_field('store_locator_mardi_a') ?>
                                                </td>
                                            </tr>
                                            <tr valign="middle">
                                                <td align="left"><?php _e('Mercredi:', APPDOMAIN); ?></td>
                                                <td align="right">
                                                    <?php echo get_sub_field('store_locator_mercredi_de') ?>
                                                    &nbsp;-&nbsp;
                                                    <?php echo get_sub_field('store_locator_mercredi_a') ?>
                                                </td>
                                            </tr>
                                            <tr valign="middle">
                                                <td align="left"><?php _e('Jeudi:', APPDOMAIN); ?></td>
                                                <td align="right">
                                                    <?php echo get_sub_field('store_locator_jeudi_de') ?>
                                                    &nbsp;-&nbsp;
                                                    <?php echo get_sub_field('store_locator_jeudi_a') ?>
                                                </td>
                                            </tr>
                                            <tr valign="middle">
                                                <td align="left"><?php _e('Vendredi:', APPDOMAIN); ?></td>
                                                <td align="right">
                                                    <?php echo get_sub_field('store_locator_vendredi_de') ?>
                                                    &nbsp;-&nbsp;
                                                    <?php echo get_sub_field('store_locator_vendredi_a') ?>
                                                </td>
                                            </tr>
                                            <tr valign="middle">
                                                <td align="left"><?php _e('Samedi:', APPDOMAIN); ?></td>
                                                <td align="right">
                                                    <?php echo get_sub_field('store_locator_samedi_de') ?>
                                                    &nbsp;-&nbsp;
                                                    <?php echo get_sub_field('store_locator_samedi_a') ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="http://maps.google.com/maps/place/<?php echo $location['address']; ?>/@<?php echo $location['lat']; ?>,<?php echo $location['lng']; ?>" target="_blank">
                                    <?php _e('Directions', APPDOMAIN); ?>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                    <?php endif; ?>
            	<?php endwhile; ?>
            	<?php wp_reset_postdata(); ?>
            <?php else : ?>
            	<p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div id="map-canvas" class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div id="autocomplete-field" class="">
    		<span class="pac-input-text"><?php _e('Find a store', APPDOMAIN); ?></span>
            <input id="pac-input" class="controls" type="text" placeholder="Enter address">
    	</div>
        <div id="map"></div>
    </div>
</div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyCaaSz-iQiVbm1K8rj-IwH_hqYIiiej3uo&amp;libraries=geometry%2Cplaces&amp;callback=initMap&amp;ver=1.0"></script>

<?php get_footer(); ?>
