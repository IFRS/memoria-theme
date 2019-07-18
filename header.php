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
    <a href="#inicio-conteudo" class="sr-only">Pular para o conte&uacute;do</a>

    <?php echo get_template_part('partials/barrabrasil'); ?>

    <div class="container-fluid main-wrapper">
        <div class="row no-gutters">
            <div class="col-lg-3 collapse show coluna-collapse">
                <div class="sticky-top coluna-nav">
                    <header class="header">
                        <h1 class="sr-only"><?php bloginfo('name'); ?></h1>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__link">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="" class="img-fluid header__logo" aria-hidden="true"/>
                            <span class="sr-only">Ir para a P&aacute;gina Inicial</span>
                        </a>
                    </header>

                    <hr class="d-none d-lg-block coluna-nav__separator">

                    <?php echo get_template_part('partials/menu'); ?>

                    <a href="https://ifrs.edu.br/" class="coluna-nav__ifrs" data-toggle="tooltip" data-placement="top" title="Portal do IFRS"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ifrs.png" alt="Portal do IFRS" class="img-fluid"></a>

                    <footer class="footer">
                        <p>
                            <!-- Wordpress -->
                            <a href="http://br.wordpress.org/" target="_blank">Desenvolvido com Wordpress<span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></a> <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" aria-hidden="true"><path d="M0 0v8h8v-2h-1v1h-6v-6h1v-1h-2zm4 0l1.5 1.5-2.5 2.5 1 1 2.5-2.5 1.5 1.5v-4h-4z" /></svg>
                            &mdash;
                            <!-- Código-fonte GPL -->
                            <a href="https://github.com/IFRS/memoria-theme/" target="_blank">C&oacute;digo-fonte deste tema sob a licen&ccedil;a GPLv3<span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></a> <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" aria-hidden="true"><path d="M0 0v8h8v-2h-1v1h-6v-6h1v-1h-2zm4 0l1.5 1.5-2.5 2.5 1 1 2.5-2.5 1.5 1.5v-4h-4z" /></svg>
                            &mdash;
                            <!-- Creative Commons -->
                            <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cc-by-nc-nd.png" alt="M&iacute;dia licenciada sob a Licen&ccedil;a Creative Commons Atribui&ccedil;&atilde;o-N&atilde;oComercial-SemDeriva&ccedil;&otilde;es 4.0 Internacional (abre uma nova p&aacute;gina)" /></a> <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" aria-hidden="true"><path d="M0 0v8h8v-2h-1v1h-6v-6h1v-1h-2zm4 0l1.5 1.5-2.5 2.5 1 1 2.5-2.5 1.5 1.5v-4h-4z" /></svg>
                        </p>
                    </footer>
                </div>
            </div>
            <div class="col coluna-content">
                <div class="coluna-separator">
                    <div class="coluna-separator__logo">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/separator-logo.png" alt="" aria-hidden="true" class="img-fluid">
                    </div>
                    <button class="btn-menu-toggle d-block mx-auto"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse.png" alt="Esconder/Mostrar navegação" class="img-fluid"></button>
                </div>
                <a href="#inicio-conteudo" id="inicio-conteudo" class="sr-only">In&iacute;cio do conte&uacute;do</a>
                    <?php //memoria_breadcrumb(); ?>
