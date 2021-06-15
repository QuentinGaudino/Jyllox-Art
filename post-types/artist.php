<?php

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;


//Création du CPT 'artist'

add_action('init', function() {
	register_post_type('artist', [
		'labels' => [
			'name'                  => _x( 'Artistes', 'Post type general name', 'jylloxart' ),
			'singular_name'         => _x( 'Artiste', 'Post type singular name', 'jylloxart' ),
			'menu_name'             => _x( 'Artistes', 'Admin Menu text', 'jylloxart' ),
			'name_admin_bar'        => _x( 'Artiste', 'Add New on Toolbar', 'jylloxart' ),
			'add_new'               => __( 'Ajouter Nouveau', 'jylloxart' ),
			'add_new_item'          => __( 'Ajouter Nouveau Artiste', 'jylloxart' ),
			'new_item'              => __( 'Nouveau Artiste', 'jylloxart' ),
			'edit_item'             => __( 'Modifier Artiste', 'jylloxart' ),
			'view_item'             => __( 'Voir Artiste', 'jylloxart' ),
			'all_items'             => __( 'Tous les Artistes', 'jylloxart' ),
			'search_items'          => __( 'Recherché Artistes', 'jylloxart' ),
			'parent_item_colon'     => __( 'Artistes Parent :', 'jylloxart' ),
			'not_found'             => __( 'Artistes introuvable.', 'jylloxart' ),
			'not_found_in_trash'    => __( 'Artistes introuvables dans la corbeille.', 'jylloxart' ),
			'featured_image'        => _x( 'Artiste Photo', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'jylloxart' ),
			'set_featured_image'    => _x( 'Définir la photo', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'jylloxart' ),
			'remove_featured_image' => _x( 'Supprimer la photo', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'jylloxart' ),
			'use_featured_image'    => _x( 'Utiliser comme image mise en avant', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'jylloxart' ),
			'archives'              => _x( 'Artiste archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'jylloxart' ),
			'insert_into_item'      => _x( 'Insérer dans artiste', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'jylloxart' ),
			'uploaded_to_this_item' => _x( 'Uploadé à cet artiste', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'jylloxart' ),
			'filter_items_list'     => _x( 'Filtrer la liste des artistes', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'jylloxart' ),
			'items_list_navigation' => _x( 'Artistes navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'jylloxart' ),
			'items_list'            => _x( 'Artistes liste', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'jylloxart' ),
		],
		'public' => true,
        'menu_icon' => 'dashicons-admin-customizer',
        'rewrite' => ['slug' => 'artist'],
		'supports' => ['title', 'thumbnail', 'excerpt']
	]);


    // Déclaration de la taxonomie "Genre" associé au CPT "artiste" (La taxonomie n'ets plus utilisée mais reste ici pour le besoin de l'exercice)
    
	register_taxonomy('genre', ['artist'], [
        'labels' => [
			'name'              => _x( 'Genres', 'taxonomy general name', 'jylloxart' ),
			'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'jylloxart' ),
			'search_items'      => __( 'Rechercher Genres', 'jylloxart' ),
			'all_items'         => __( 'Tous les Genres', 'jylloxart' ),
			'parent_item'       => __( 'Genre Parent', 'jylloxart' ),
			'parent_item_colon' => __( 'Genre Parent :', 'jylloxart' ),
			'edit_item'         => __( 'Modifier Genre', 'jylloxart' ),
			'update_item'       => __( 'Mettre à jour Genre', 'jylloxart' ),
			'add_new_item'      => __( 'Ajouter Nouveau Genre', 'jylloxart' ),
			'new_item_name'     => __( 'Nom du nouveau Genre', 'jylloxart' ),
			'menu_name'         => __( 'Genre', 'jylloxart' ),
		],
        'rewrite' => ['slug' => 'genre'],
        'hierarchical' => true,
    ] );
});


//Ajout de custom fields au CPT 'artist'

add_action('carbon_fields_register_fields', function() {
	
    Container::make('post_meta', 'Caractéristiques artiste')
        ->where('post_type', '=', 'artist')
        ->add_fields([
            Field::make_text('firstname', 'Prénom'),
            Field::make_text('lastname', 'Nom'),
            Field::make( 'textarea', 'about', 'A propose de l\'artiste' )
                ->set_rows( 4 ),
            Field::make_complex('social_networks', 'Réseaux sociaux')
                ->add_fields([
                    Field::make('icon', 'icon', 'Icone'),
                    Field::make_text('url', 'URL')
                        ->set_attribute('type', 'url')
                ])
        ]);
});