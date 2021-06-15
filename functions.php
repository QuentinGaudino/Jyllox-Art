<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

//Ajout de Carbon Fields
add_action('after_setup_theme', 'crb_load');
function crb_load() {
	require_once('vendor/autoload.php');
	\Carbon_Fields\Carbon_Fields::boot();
}


//chargement des styles et scripts
add_action('wp_enqueue_scripts', function () {
	//CSS
    wp_enqueue_style('slick-css', get_template_directory_uri() . '/node_modules/slick-carousel/slick/slick.css', [], wp_get_theme()->get('Version'));
    wp_enqueue_style('font-awesome-css', get_template_directory_uri() . '/vendor/components/font-awesome/css/all.min.css', [], wp_get_theme()->get('Version'));
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css', [], wp_get_theme()->get('Version'));

	//JS
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/node_modules/jquery/dist/jquery.min.js', [], '1.0.0', true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/node_modules/slick-carousel/slick/slick.min.js', ['jquery'], '1.0.0', true );
	wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', ['slick'], '1.0.0', true);
});


//Config du theme
add_action('after_setup_theme', function () {
    $defaults = array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => true, 
    );
    add_theme_support( 'custom-logo', $defaults );//ajout d'un logo personnalisé pour le theme
	add_theme_support( 'title-tag' );//Balise title dans le head
    add_theme_support( 'post-thumbnails' );//Image mise en avant
    add_theme_support('html5');
	add_theme_support('woocommerce');

    // Déclaration des menus (pour l'administration)
	register_nav_menu('menu-top', 'Menu en haut de page');
	register_nav_menu('menu-footer', 'Menu en pied de page');
});


//Options du thème
add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options() {
	Container::make( 'theme_options', __( 'Options' ) )
        ->add_fields( array(
            Field::make( 'text', 'phone', 'Téléphone' ),
            Field::make( 'text', 'email', 'Email' ),
            Field::make( 'text', 'title', 'Titre de la boutique' ),
            Field::make( 'text', 'subtitle', 'Sous-titre de l\'accueil' ),
        ) );
}

//Actualise les permaliens lors de l'activation du thème.
add_action('after_switch_theme', 'my_rewrite_flush');
function my_rewrite_flush() {
	flush_rewrite_rules(); // Actualiser les permaliens
};

//Ajout d'une sidebar/widget
add_action( 'widgets_init', 'jylloxart_widgets_init' );
function jylloxart_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Primary Sidebar', 'jylloxart' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

}

//Chargement des CPT
require_once __DIR__ . '/post-types/artist.php';

//Ajout d'un artiste sur les produits
add_action('carbon_fields_register_fields', function() {

		Container::make('post_meta', 'Caractéristiques produit')
        ->where('post_type', '=', 'product')
        ->add_fields([
			Field::make( 'association', 'crb_association', __( 'Association' ) )
				->set_types( array(
					array(
						'type'      => 'post',
						'post_type' => 'artist',
					)
			))
		]);
});

//Ajout des catégories produits au CPT artist/ Remplace la taxonomie mise en place dans le CPT
add_filter( 'woocommerce_taxonomy_objects_product_cat', function($object_types){
    array_push($object_types, 'artist');
    return $object_types;

} );


