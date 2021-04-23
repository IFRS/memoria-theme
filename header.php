<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Meta -->
    <meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <meta name="author" content="Diretoria de Comunicação do IFRS">
    <meta name="keywords" content="ifrs, memória, história, acervo">
    <?php echo get_template_part('partials/favicons'); ?>
    <!-- Contexto Barra Brasil -->
    <meta property="creator.productor" content="http://estruturaorganizacional.dados.gov.br/id/unidade-organizacional/100918">
    <!-- OpenGraph -->
    <meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
    <meta property="og:url" content="<?php echo esc_attr( wp_get_canonical_url() ); ?>">
    <meta property="og:locale" content="<?php echo esc_attr( get_locale() ); ?>">
    <meta property="og:type" content="<?php echo ( !is_front_page() && !is_home() ) ? 'article' : 'website' ?>">
    <meta property="og:title" content="<?php echo esc_attr( wp_get_document_title() ); ?>">
    <?php
        $og_image = '';

        if (has_post_thumbnail()) {
            $og_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        } elseif (has_custom_logo()) {
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $attachment = wp_get_attachment_image_src( $custom_logo_id , 'full' );
            $og_image = $attachment[0];
        } elseif (get_header_image())  {
            $og_image = get_header_image();
        } else {
            $og_image = esc_url( get_stylesheet_directory_uri() ) . '/img/marca-numem.png';
        }
    ?>
    <meta property="og:image" content="<?php echo esc_attr( $og_image ); ?>">
    <!-- WP -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <a href="#inicio-conteudo" class="sr-only sr-only-focusable">Pular para o conte&uacute;do</a>

    <?php wp_body_open(); ?>

    <?php echo get_template_part('partials/barrabrasil'); ?>

    <header class="header<?php echo (is_front_page()) ? ' header--front-page' : ''; ?><?php echo (has_header_image()) ? ' header--has-image' : ''; ?>" style="<?php echo (is_front_page() && has_header_image()) ? 'background-image: url(\''.get_header_image().'\')' : ''; ?>">
        <div class="container">
            <h1 class="sr-only"><?php bloginfo('name'); ?></h1>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__link">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/marca-numem.png" alt="" class="header__marca" aria-hidden="true" <?php echo getimagesize(get_stylesheet_directory() . '/img/marca-numem.png')[3]; ?>/>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/marca-ifrs.png" alt="" class="header__marca header__marca--ifrs" width="570" height="150" aria-hidden="true" <?php echo getimagesize(get_stylesheet_directory() . '/img/marca-ifrs.png')[3]; ?>/>
                <span class="sr-only">Página Inicial - <?php bloginfo('name'); ?></span>
            </a>
            <?php echo get_template_part('partials/menu'); ?>
    </header>

    <?php memoria_breadcrumb(); ?>

    <main class="container">
        <a href="#inicio-conteudo" id="inicio-conteudo" class="sr-only">In&iacute;cio do conte&uacute;do</a>
