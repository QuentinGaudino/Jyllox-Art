<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('after_setup_theme', 'crb_load');
function crb_load() {
	require_once('vendor/autoload.php');
	\Carbon_Fields\Carbon_Fields::boot();
}


//chargement de style.css
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', [], wp_get_theme()->get('Version'));
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css', ['bootstrap'], wp_get_theme()->get('Version'));
});


//Ajout du title-tag
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


add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options() {
	Container::make( 'theme_options', __( 'Options' ) )
        ->add_fields( array(
            Field::make( 'text', 'phone', 'Téléphone' ),
            Field::make( 'text', 'email', 'Email' ),
        ) );
}

add_action('after_switch_theme', 'my_rewrite_flush');
function my_rewrite_flush() {
	flush_rewrite_rules(); // Actualiser les permaliens
};