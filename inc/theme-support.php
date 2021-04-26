<?php
add_action( 'after_setup_theme', function() {
    // Remove Gutenberg custom options
    add_theme_support( 'editor-color-palette' );
    add_theme_support( 'editor-gradient-presets' );
    add_theme_support( 'disable-custom-colors' );
    add_theme_support( 'disable-custom-gradients' );
    add_theme_support( 'disable-custom-font-sizes' );
    add_theme_support( 'custom-units', array() );
    add_theme_support( 'editor-font-sizes', array() );

    // Add theme support for Automatic Feed Links
    add_theme_support( 'automatic-feed-links' );

    // Add theme support for Featured Images
    add_theme_support( 'post-thumbnails' );

    // Add theme support for HTML5 Semantic Markup
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        )
    );

    // Add theme support for Responsive Embeds
    add_theme_support( 'responsive-embeds' );

    // Add theme support for document <title> tag
    add_theme_support( 'title-tag' );

    // Add theme support for Custom Header
    add_theme_support( 'custom-header', array(
        'default-image'          => '',
        'width'                  => 2560,
        'height'                 => 1440,
        'flex-width'             => true,
        'flex-height'            => true,
        'uploads'                => true,
        'random-default'         => false,
        'header-text'            => true,
        'default-text-color'     => '#ffffff',
        'wp-head-callback'       => '',
        'admin-head-callback'    => '',
        'admin-preview-callback' => '',
        'video'                  => true,
        'video-active-callback'  => 'is_front_page || is_home',
    ) );

    // Default Headers
    register_default_headers( array(
        'fundo1' => array(
            'url'           => '%s/img/fundos/fundo1.jpg',
            'thumbnail_url' => '%s/img/fundos/fundo1.thumb.jpg',
            'description'   => __( 'Imagem de Cabeçalho Padrão 1', 'ifrs-memoria-theme' ),
        ),
    ) );
    register_default_headers( array(
        'fundo2' => array(
            'url'           => '%s/img/fundos/fundo2.jpg',
            'thumbnail_url' => '%s/img/fundos/fundo2.thumb.jpg',
            'description'   => __( 'Imagem de Cabeçalho Padrão 2', 'ifrs-memoria-theme' ),
        ),
    ) );
} );
