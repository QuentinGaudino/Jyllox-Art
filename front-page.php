<?php
$derniersTableaux = new WP_Query( [
    'post_type' => 'product',
    'posts_per_page' => 3
] );
get_header();
?>

<main>
    

    
    <?php if ( $derniersTableaux->have_posts() ) : ?>

    <div class="derniersTableaux__slider">
        <?php while ( $derniersTableaux->have_posts() ) : $derniersTableaux->the_post(); ?> 
        
        <div>
            <?php the_post_thumbnail( 'shop_catalog' ); ?>
        </div>
            
        <?php endwhile; ?>
    </div>
    <?php else: ?>
        <p>Plus rien à vendre</p>
    <?php endif ?>

    <?php wp_reset_postdata() ?>



</main>

<?php get_footer();