<?php
add_action( 'init', function() {
	$labels = array(
		'name'                       => _x( 'Unidades', 'Taxonomy General Name', 'ifrs-memoria-theme' ),
		'singular_name'              => _x( 'Unidade', 'Taxonomy Singular Name', 'ifrs-memoria-theme' ),
		'menu_name'                  => __( 'Unidades', 'ifrs-memoria-theme' ),
		'all_items'                  => __( 'Todas as Unidades', 'ifrs-memoria-theme' ),
		'parent_item'                => __( 'Unidade Mãe', 'ifrs-memoria-theme' ),
		'parent_item_colon'          => __( 'Unidade Mãe:', 'ifrs-memoria-theme' ),
		'new_item_name'              => __( 'Nova Unidade', 'ifrs-memoria-theme' ),
		'add_new_item'               => __( 'Adicionar Nova Unidade', 'ifrs-memoria-theme' ),
		'edit_item'                  => __( 'Editar Unidade', 'ifrs-memoria-theme' ),
		'update_item'                => __( 'Atualizar Unidade', 'ifrs-memoria-theme' ),
		'view_item'                  => __( 'Visualizar Unidade', 'ifrs-memoria-theme' ),
		'separate_items_with_commas' => __( 'Unidades separadas com vírgulas', 'ifrs-memoria-theme' ),
		'add_or_remove_items'        => __( 'Adicionar ou Remover Unidades', 'ifrs-memoria-theme' ),
		'choose_from_most_used'      => __( 'Escolher pela Unidade mais usada', 'ifrs-memoria-theme' ),
		'popular_items'              => __( 'Unidades populares', 'ifrs-memoria-theme' ),
		'search_items'               => __( 'Buscar Unidades', 'ifrs-memoria-theme' ),
		'not_found'                  => __( 'Não encontrada', 'ifrs-memoria-theme' ),
		'no_terms'                   => __( 'Sem Unidades', 'ifrs-memoria-theme' ),
		'items_list'                 => __( 'Lista de Unidades', 'ifrs-memoria-theme' ),
		'items_list_navigation'      => __( 'Lista de navegação de Unidades', 'ifrs-memoria-theme' ),
    );

	$capabilities = array(
		'manage_terms'               => 'manage_unidades',
		'edit_terms'                 => 'manage_unidades',
		'delete_terms'               => 'manage_unidades',
		'assign_terms'               => 'assign_unidades',
    );

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'capabilities'               => $capabilities,
		'show_in_rest'               => true,
		'rewrite'                    => array('slug' => 'timeline/unidade', 'with_front' => false),
    );

	register_taxonomy( 'unidade', array( 'registro' ), $args );
}, 1 );
