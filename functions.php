<?php
if (! defined('WP_DEBUG')) {
	die( 'Direct access forbidden.' );
}

// Youtube API Options
require_once('inc/config-youtube.php');

// Scripts & Styles
require_once('inc/assets.php');

// Personalização do Gutenberg
require_once('inc/gutenberg-custom.php');

// Linha do Tempo
require_once('inc/taxonomies/unidade.php');
require_once('inc/post-types/registro.php');
require_once('inc/roles.php');

// Custom Queries
require_once('inc/queries.php');

// Partials
require_once('inc/partials/vlibras.php');
require_once('inc/partials/home-dados.php');
require_once('inc/partials/registro-meta.php');
