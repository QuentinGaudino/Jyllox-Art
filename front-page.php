<?php
$derniersTableaux = new WP_Query( [
    'post_type' => 'product',
    'posts_per_page' => 3
] );

$artist_query = new WP_Query([
	'post_type' => 'artist',
	'posts_per_page' => 1
]);
get_header();
?>

<main>
    
    <h1><?php echo carbon_get_theme_option('title') ?></h1>
    <section class="derniersTableaux">
        <h2><?php echo carbon_get_theme_option('subtitle') ?></h2>
        <?php if ( $derniersTableaux->have_posts() ) : ?>

        <div class="derniersTableaux__slider">
            <?php while ( $derniersTableaux->have_posts() ) : $derniersTableaux->the_post(); ?> 
            
            <div>
                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'shop_catalog' ); ?></a>
            </div>
                
            <?php endwhile; ?>
        </div>
        <?php else: ?>
            <p>Plus rien à vendre</p>
        <?php endif ?>

        <?php wp_reset_postdata() ?>
    </section>
 


    <section class="artist-card">
        <h2 class="artist-card__title">A propos de moi</h2>
        <?php while ($artist_query->have_posts()) : $artist_query->the_post(); ?>
            <h3 class="artist-card__name">
                <?= carbon_get_the_post_meta('firstname'); ?>
                <?= carbon_get_the_post_meta('lastname'); ?>
            </h3>
            <div class="artist-card__thumbnail">
                <?php the_post_thumbnail('thumbnail') ?>
            </div>
            
            <?php $social_networks = carbon_get_the_post_meta('social_networks') ; ?>
                    <?php if ($social_networks) : ?>
                        <ul class="artist-card__items">
                            <?php foreach ($social_networks as $social_network) { ?>
                                <li class="artist-card__items_item">
                                    <a href="<?= $social_network['url']; ?>" class="artist-card__items_item_url">
				    	            <i class="<?= $social_network['icon']['class']; ?> fa-2x artist-card__items_item_logo"></i>
					                </a>
                                </li>
                                
                            <?php } ?>
                        </ul>
                    <?php endif ?>
            <p class="artist-card__excerpt"><?= the_excerpt() ?></p>
            <a href="<?= the_permalink() ?>" class="artist-card__button">Découvrir l'artiste</a>
        <?php endwhile ?>
        <?php wp_reset_postdata(); ?>
    </section>


</main>

<?php get_footer();