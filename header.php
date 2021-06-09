<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

<header>
<nav>
    <?php
    wp_nav_menu( array(
        'theme_location'    => 'menu-top',
        'depth'             => 2,
        'container'         => 'div',
        'container_class'   => '',
        'container_id'      => '',
        'menu_class'        => '',
    ) );
    ?>
</nav>
</header>