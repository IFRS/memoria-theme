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
            <div class="col-12 col-lg-4 coluna-nav collapse show">
                <div class="row">
                    <div class="col-lg-10">
                        <header class="header">
                            <h1 class="sr-only"><?php bloginfo('name'); ?></h1>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__link">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="" class="img-fluid header__logo" aria-hidden="true"/>
                                <span class="sr-only">Ir para a P&aacute;gina Inicial</span>
                            </a>
                        </header>

                        <hr class="coluna-nav__separator">

                        <?php echo get_template_part('partials/menu'); ?>

                        <a href="https://ifrs.edu.br/" class="coluna-nav__ifrs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ifrs.png" alt="Portal do IFRS" class="img-fluid"></a>
                    </div>
                </div>
            </div>
            <div class="col">
                <a href="#inicio-conteudo" id="inicio-conteudo" class="sr-only">In&iacute;cio do conte&uacute;do</a>
                <div class="row">
                    <div class="col-lg-1 coluna-collapse">
                        <div class="coluna-collapse__logo">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-logo.png" alt="" aria-hidden="true" class="img-fluid">
                        </div>
                        <button class="btn-menu-toggle d-block mx-auto"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse.png" alt="Esconder/Mostrar navegação" class="img-fluid"></button>
                    </div>
                    <main class="col-12 col-lg-11">
                        <?php memoria_breadcrumb(); ?>
