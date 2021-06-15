<footer>
    <!-- CHargement du menu-footer ainsi que du widget sidebar-1 -->
	<?php wp_nav_menu(['theme_location' => 'menu-footer', 'container' => 'nav']); ?>
    <?php get_sidebar('sidebar-1')?>
</footer>


<?php wp_footer(); ?>
    </body>
</html>