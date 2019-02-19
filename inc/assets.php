<?php
function memoria_load_styles() {
    /* wp_enqueue_style( $handle, $src, $deps, $ver, $media ); */

    wp_enqueue_style('css-vendor', get_stylesheet_directory_uri().(WP_DEBUG ? '/css/vendor.css' : '/css/vendor.min.css'), array(), false, 'all');
    wp_enqueue_style('css-memoria', get_stylesheet_directory_uri().(WP_DEBUG ? '/css/memoria.css' : '/css/memoria.min.css'), array(), false, 'all');
}

function memoria_load_scripts() {
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    if (!is_admin()) {
        wp_deregister_script('jquery');
    }

    wp_enqueue_script( 'js-ie', get_template_directory_uri().(WP_DEBUG ? '/js/ie.js' : '/js/ie.min.js'), array(), null, false );
    wp_script_add_data( 'js-ie', 'conditional', 'lt IE 9' );

    wp_enqueue_script('js-memoria', get_template_directory_uri().(WP_DEBUG ? '/js/memoria.js' : '/js/memoria.min.js'), array(), null, true);

    if (!WP_DEBUG) {
        wp_enqueue_script( 'js-barra-brasil', '//barra.brasil.gov.br/barra.js', array(), null, true );
    }
}

add_action( 'wp_enqueue_scripts', 'memoria_load_styles', 1 );
add_action( 'wp_enqueue_scripts', 'memoria_load_scripts', 1 );
