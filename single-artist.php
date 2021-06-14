<?php
get_header();

?>

<div class="artist_background" style="background-image: url('<?php the_post_thumbnail_url('large') ?>');">
    <div class="artist_artist">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <h2><?= get_the_title() ?></h2>

            <?php 
            $tableaux = new WP_Query( [
                'post_type' => 'product',
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => 'crb_association',
                        'carbon_field_property' => 'id',
                        'compare' => '==',
                        'value' => get_the_ID(),
                    ),
                ),
            ] );
        ?>

            <h3 class="artist__name">Aka: 
                <?= carbon_get_the_post_meta('firstname'); ?>
                <?= carbon_get_the_post_meta('lastname'); ?>
            </h3>
            
            <?php $social_networks = carbon_get_the_post_meta('social_networks') ; ?>
                    <?php if ($social_networks) : ?>
                        <ul class="artist__items">
                            <?php foreach ($social_networks as $social_network) { ?>
                                <li class="artist__items_item">
                                    <a href="<?= $social_network['url']; ?>" class="artist-__items_item_url">
                                    <i class="<?= $social_network['icon']['class']; ?> fa-2x artist__items_item_logo"></i>
                                    </a>
                                </li>
                                
                            <?php } ?>
                        </ul>
                    <?php endif ?>
            <p class="artist__content"><?= carbon_get_the_post_meta('about'); ?></p>

            <?php $mouvements = get_the_terms(get_the_ID(), 'genre'); ?>
            <?php if ($mouvements) : ?>
                <h3>Ses mouvements</h3>
                <ul class="artist__terms">
                    <?php foreach ($mouvements as $mouvement) { ?>
                        <li class="artist__terms_term"><?= $mouvement->name; ?></li>
                    <?php } ?>
                </ul>
            <?php endif ?>
            
            <h3>Ses oeuvres</h3>

            <section class="tableaux_artiste">
                <?php while($tableaux->have_posts()) : $tableaux->the_post(); ?>
                    
                    <div class="tableau">
                        <?= the_post_thumbnail(); ?>
                        <h4><a href="<?= the_permalink() ?>"><?= the_title() ?></a></h4>
                    </div>
                <?php endwhile; ?>
            </section>


        <?php endwhile; else : ?>
            <p>Unknow Artist</p>
        <?php endif; ?>
    </div>
</div>
<?php wp_reset_postdata(); ?>

<?php get_footer();