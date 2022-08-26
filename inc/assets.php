<?php
add_action( 'wp_enqueue_scripts', function() {
    /* Styles */
    /* wp_register_style( $handle, $src, $deps, $ver, $media ); */
    /* wp_enqueue_style( $handle[, $src, $deps, $ver, $media] ); */

    wp_enqueue_style('vendor', get_stylesheet_directory_uri() . '/css/vendor.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/vendor.css'), 'all');
    wp_enqueue_style('memoria', get_stylesheet_directory_uri() . '/css/memoria.css', array('vendor'), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/memoria.css'), 'all');

    /* Scripts */
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    wp_enqueue_script('memoria', get_stylesheet_directory_uri() . '/js/memoria.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/memoria.js'), true);

    if (is_post_type_archive('registro') || is_tax('unidade')) {
        wp_enqueue_script('timeline', get_stylesheet_directory_uri() . '/js/timeline.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/timeline.js'), true);
    }

    if (!WP_DEBUG) {
        wp_enqueue_script( 'vlibras', 'https://vlibras.gov.br/app/vlibras-plugin.js', array(), null, true );
        wp_add_inline_script( 'vlibras', "
            if (window.VLibras) new window.VLibras.Widget('https://vlibras.gov.br/app');
        " );
    }
}, 1 );

add_filter('script_loader_tag', function($tag, $handle) {
    $scripts_to_defer = array('vlibras');
    $scripts_to_async = array();

    foreach ($scripts_to_defer as $defer_script) {
        if ($defer_script === $handle) {
            return str_replace(' src', ' defer="defer" src', $tag);
        }
    }

    foreach ($scripts_to_async as $async_script) {
        if ($async_script === $handle) {
            return str_replace(' src', ' async="async" src', $tag);
        }
    }

    return $tag;
}, 2, 2);
