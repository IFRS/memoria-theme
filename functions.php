<?php
// Registra os menus
register_nav_menus(
    array(
        'main' => 'Menu Principal',
    )
);

// Post Thumbnail
require_once('inc/post-thumbnails.php');

// Breadcrumb
require_once('inc/breadcrumb.php');

// Script Condicional
require_once('inc/script_conditional.php');

// Scripts & Styles
require_once('inc/assets.php');

// Linha do Tempo
require_once('inc/taxonomies/unidade.php');
require_once('inc/post-types/registro.php');
