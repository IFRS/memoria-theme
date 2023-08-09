<?php
add_action( 'wp_enqueue_scripts', function() {
    /* Styles */
    /* wp_register_style( $handle, $src, $deps, $ver, $media ); */
    /* wp_enqueue_style( $handle[, $src, $deps, $ver, $media] ); */

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    wp_enqueue_style( 'memoria', get_stylesheet_directory_uri() . '/css/memoria.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/memoria.css'), 'all' );

    /* Scripts */
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    if (is_post_type_archive( 'registro' ) || is_tax( 'unidade' )) {
        wp_enqueue_script( 'timeline', get_stylesheet_directory_uri() . '/js/timeline.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/timeline.js'), true );
    }

    if (!WP_DEBUG) {
        wp_enqueue_script( 'vlibras', 'https://vlibras.gov.br/app/vlibras-plugin.js', array(), null, true );
        wp_script_add_data( 'vlibras', 'strategy', 'defer' );
        wp_add_inline_script( 'vlibras', "
            document.addEventListener('DOMContentLoaded', function() { if (window.VLibras) new window.VLibras.Widget('https://vlibras.gov.br/app'); });
        " );
    }
}, 1 );
