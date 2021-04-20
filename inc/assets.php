<?php
add_action( 'wp_enqueue_scripts', function() {
    /* Styles */
    /* wp_register_style( $handle, $src, $deps, $ver, $media ); */
    /* wp_enqueue_style( $handle[, $src, $deps, $ver, $media] ); */

    if (!is_admin()) {
        wp_dequeue_style( 'wp-block-library' );
        wp_deregister_style( 'wp-block-library' );
    }

    wp_enqueue_style('vendor', get_stylesheet_directory_uri() . '/css/vendor.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/vendor.css'), 'all');
    wp_enqueue_style('memoria', get_stylesheet_directory_uri() . '/css/memoria.css', array('vendor'), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/memoria.css'), 'all');

    /* Scripts */
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    wp_enqueue_script('ie', get_stylesheet_directory_uri() . '/js/ie.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/ie.js'), false);
    wp_script_add_data('ie', 'conditional', 'lt IE 9');

    wp_enqueue_script('memoria', get_stylesheet_directory_uri() . '/js/memoria.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/memoria.js'), true);

    if (is_post_type_archive('registro') || is_tax('unidade')) {
        wp_enqueue_script('timeline', get_stylesheet_directory_uri() . '/js/timeline.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/timeline.js'), true);
    }

    if (!WP_DEBUG) {
        wp_enqueue_script( 'barra-brasil', '//barra.brasil.gov.br/barra_2.0.js', array(), null, true );
    }
}, 1 );
