<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <meta name="author" content="Diretoria de Comunicação do IFRS">
    <meta name="keywords" content="ifrs, memória, história">
    <meta property="creator.productor" content="http://estruturaorganizacional.dados.gov.br/id/unidade-organizacional/100918">
    <link rel="alternate" type="application/rss+xml" title="<?php echo esc_attr( get_bloginfo('name') ); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
    <?php echo get_template_part('partials/title'); ?>
    <?php echo get_template_part('partials/favicons'); ?>
    <?php wp_head(); ?>
</head>

<body>
    <a href="#main" class="sr-only">Pular para o conte&uacute;do</a>

    <?php echo get_template_part('partials/barrabrasil'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-3">
                <header>
                    <h1 class="sr-only"><?php bloginfo('name'); ?></h1>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__link">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/header.png" alt="" class="img-fluid header__marca" aria-hidden="true"/>
                        <span class="sr-only">Ir para a P&aacute;gina Inicial</span>
                    </a>
                </header>
            </div>
            <div class="col-lg-1">

            </div>
            <div class="col-12 col-lg-8">
                <a href="#inicio-conteudo" id="inicio-conteudo" class="sr-only">In&iacute;cio do conte&uacute;do</a>

                <main>
                    <?php memoria_breadcrumb(); ?>
