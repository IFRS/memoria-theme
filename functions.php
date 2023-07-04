<?php
if (! defined('WP_DEBUG')) {
	die( 'Direct access forbidden.' );
}

wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

// Youtube API Options
require_once('inc/config-youtube.php');

// Scripts & Styles
require_once('inc/assets.php');

// Personalização do Gutenberg
require_once('inc/gutenberg-custom.php');

// Linha do Tempo
require_once('inc/taxonomies/unidade.php');
require_once('inc/post-types/registro.php');
require_once('inc/registro-meta.php');
require_once('inc/roles.php');

// Tainacan Config
require_once('inc/tainacan.php');

require_once('inc/home-dados.php');
require_once('inc/vlibras.php');
