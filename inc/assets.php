<?php
add_action( 'wp_enqueue_scripts', function() {
    /* wp_enqueue_style( $handle, $src, $deps, $ver, $media ); */

    if (!is_admin()) {
        wp_dequeue_style( 'wp-block-library' );
        wp_deregister_style( 'wp-block-library' );
    }

    wp_enqueue_style('css-vendor', get_stylesheet_directory_uri() . '/css/vendor.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/vendor.css'), 'all');
    wp_enqueue_style('css-memoria', get_stylesheet_directory_uri() . '/css/memoria.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/memoria.css'), 'all');
}, 1 );

add_action( 'wp_enqueue_scripts', function() {
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    if (!is_admin()) {
        wp_deregister_script('jquery');
    }

    wp_enqueue_script( 'js-ie', get_stylesheet_directory_uri() . '/js/ie.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/ie.js'), false );
    wp_script_add_data( 'js-ie', 'conditional', 'lt IE 9' );

    wp_enqueue_script('js-memoria', get_stylesheet_directory_uri() . '/js/memoria.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/memoria.js'), true);

    if (!WP_DEBUG) {
        wp_enqueue_script( 'js-barra-brasil', 'https://barra.brasil.gov.br/barra.js', array(), null, true );
    }
}, 1 );
