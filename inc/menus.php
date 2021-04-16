<?php
/**
 * Register Custom Navigation Walker
 */
add_action( 'after_setup_theme', function() {
    require_once get_template_directory() . '/inc/vendor/class-wp-bootstrap-navwalker.php';
} );

// Registra os menus
register_nav_menus(
    array(
        'main' => 'Menu Principal',
    )
);
