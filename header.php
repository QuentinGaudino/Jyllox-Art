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
    <div class="menu_all">
        <div class="site-logo-container">
			<?php the_custom_logo() ?>
        </div>
        <?php
        wp_nav_menu( [
            'theme_location'    => 'menu-top',
            'container'         => 'nav',
        ]);
        ?>
    </div>
</header>