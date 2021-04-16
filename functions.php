<?php
// Registra os menus
register_nav_menus(
    array(
        'main' => 'Menu Principal',
    )
);

// Post Thumbnail
require_once('inc/theme-support.php');

// Limita o tamanho do resumo
require_once('inc/excerpt-limit.php');

// Fonts
require_once('inc/fonts.php');

// Scripts & Styles
require_once('inc/assets.php');

// Breadcrumb
require_once('inc/breadcrumb.php');

// Remove inline styles do conteúdo
require_once('inc/remove_inline_styles.php');

// Linha do Tempo
require_once('inc/taxonomies/unidade.php');
require_once('inc/post-types/registro.php');
require_once('inc/roles.php');

// Custom Queries
require_once('inc/queries.php');
