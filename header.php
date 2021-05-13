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
    <a href="#inicio-conteudo" class="is-sr-only">Pular para o conte&uacute;do</a>

    <?php wp_body_open(); ?>

    <header class="section header<?php echo (is_front_page()) ? ' header--front-page' : ''; ?><?php echo (is_front_page() && has_header_image()) ? ' header--has-image' : ''; ?>" style="<?php echo (is_front_page() && has_header_image()) ? 'background-image: url(\''.get_header_image().'\')' : ''; ?>">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <h1 class="is-sr-only"><?php bloginfo('name'); ?></h1>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__link">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/marca-numem.png" alt="" class="header__marca" aria-hidden="true" <?php echo getimagesize(get_stylesheet_directory() . '/img/marca-numem.png')[3]; ?>/>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/marca-ifrs.png" alt="" class="header__marca header__marca--ifrs" width="570" height="150" aria-hidden="true" <?php echo getimagesize(get_stylesheet_directory() . '/img/marca-ifrs.png')[3]; ?>/>
                        <span class="is-sr-only">Página Inicial - <?php bloginfo('name'); ?></span>
                    </a>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <?php echo get_template_part('partials/menu'); ?>
                </div>
            </div>

            <?php if (is_front_page() && has_header_image() && isset(get_custom_header()->attachment_id)) : ?>
                <p class="header__text">
                    <?php
                        $id = get_custom_header()->attachment_id;
                        $title = get_the_title($id);
                        $caption = wp_get_attachment_caption($id);

                        if (!empty($title)) {
                            printf('<strong>%s</strong><br>', $title);
                        }

                        if (!empty($caption)) {
                            echo $caption;
                        }
                    ?>
                </p>
            <?php endif; ?>
        </div>
    </header>

    <?php ifrs_memoria_breadcrumb(); ?>

    <main role="main" class="section">
        <section class="<?php echo (get_query_var('tainacan_repository_archive', false)) ? 'container.is-fullhd' : 'container'; ?>">
            <a href="#inicio-conteudo" id="inicio-conteudo" class="sr-only">In&iacute;cio do conte&uacute;do</a>
