<?php
function registro_post_type() {
	$labels = array(
		'name'                  => _x( 'Registros', 'Post Type General Name', 'ifrs-memoria-theme' ),
		'singular_name'         => _x( 'Registro', 'Post Type Singular Name', 'ifrs-memoria-theme' ),
		'menu_name'             => __( 'Linha do Tempo', 'ifrs-memoria-theme' ),
		'name_admin_bar'        => __( 'Linha do Tempo', 'ifrs-memoria-theme' ),
		'archives'              => __( 'Arquivo de Registros', 'ifrs-memoria-theme' ),
		'attributes'            => __( 'Atributos do Registro', 'ifrs-memoria-theme' ),
		'parent_item_colon'     => __( 'Registro pai:', 'ifrs-memoria-theme' ),
		'all_items'             => __( 'Todos os Registros', 'ifrs-memoria-theme' ),
		'add_new_item'          => __( 'Adicionar Novo Registro', 'ifrs-memoria-theme' ),
		'add_new'               => __( 'Adicionar Novo', 'ifrs-memoria-theme' ),
		'new_item'              => __( 'Novo Registro', 'ifrs-memoria-theme' ),
		'edit_item'             => __( 'Editar Registro', 'ifrs-memoria-theme' ),
		'update_item'           => __( 'Atualizar Registro', 'ifrs-memoria-theme' ),
		'view_item'             => __( 'Visualizar Registro', 'ifrs-memoria-theme' ),
		'view_items'            => __( 'Visualizar Registros', 'ifrs-memoria-theme' ),
		'search_items'          => __( 'Buscar Registro', 'ifrs-memoria-theme' ),
		'not_found'             => __( 'Não encontrado', 'ifrs-memoria-theme' ),
		'not_found_in_trash'    => __( 'Não encontrado na Lixeira', 'ifrs-memoria-theme' ),
		'featured_image'        => __( 'Imagem Destaque', 'ifrs-memoria-theme' ),
		'set_featured_image'    => __( 'Definir imagem destaque', 'ifrs-memoria-theme' ),
		'remove_featured_image' => __( 'Remover imagem destaque', 'ifrs-memoria-theme' ),
		'use_featured_image'    => __( 'Usar como imagem destaque', 'ifrs-memoria-theme' ),
		'insert_into_item'      => __( 'Inserir no Registro', 'ifrs-memoria-theme' ),
		'uploaded_to_this_item' => __( 'Enviado para esse Registro', 'ifrs-memoria-theme' ),
		'items_list'            => __( 'Lista de Registros', 'ifrs-memoria-theme' ),
		'items_list_navigation' => __( 'Lista de navegação de Registros', 'ifrs-memoria-theme' ),
		'filter_items_list'     => __( 'Filtrar lista de Registros', 'ifrs-memoria-theme' ),
	);

	$capabilities = array(
		// meta caps (don't assign these to roles)
		'edit_post'              => 'edit_registro',
		'read_post'              => 'read_registro',
		'delete_post'            => 'delete_registro',

		// primitive/meta caps
		'create_posts'           => 'create_registros',

		// primitive caps used outside of map_meta_cap()
		'edit_posts'             => 'edit_registros',
		'edit_others_posts'      => 'manage_registros',
		'publish_posts'          => 'create_registros',
		'read_private_posts'     => 'read',

		// primitive caps used inside of map_meta_cap()
		'read'                   => 'read',
		'delete_posts'           => 'manage_registros',
		'delete_private_posts'   => 'manage_registros',
		'delete_published_posts' => 'manage_registros',
		'delete_others_posts'    => 'manage_registros',
		'edit_private_posts'     => 'edit_registros',
		'edit_published_posts'   => 'edit_registros',
	);

	$args = array(
		'label'                 => __( 'Registro', 'ifrs-memoria-theme' ),
		'description'           => __( 'Registro Temporal', 'ifrs-memoria-theme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'taxonomies'            => array( 'unidade' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-layout',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => array('registro', 'registros'),
		'map_meta_cap'          => true,
		'capabilities'          => $capabilities,
		'show_in_rest'          => false,
		'rewrite'               => array('slug' => 'timeline','with_front' => false),
	);

	register_post_type( 'registro', $args );
}

add_action( 'init', 'registro_post_type', 0 );

add_action( 'cmb2_admin_init', 'registro_metaboxes' );
function registro_metaboxes() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_registro_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'metabox_data',
		'title'         => __( 'Data do Registro', 'ifrs-memoria-theme' ),
		'object_types'  => array( 'registro' ),
		'context'       => 'side',
		'priority'      => 'default',
		'show_names'    => false, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	// Regular text field
	$cmb->add_field( array(
		'name'       => __( 'Data', 'ifrs-memoria-theme' ),
		'desc'       => __( 'Selecione a data do registro temporal', 'ifrs-memoria-theme' ),
		'id'         => $prefix . 'data',
		'type'       => 'text_date',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
        // 'repeatable'      => true,
        'date_format' => 'd/m/Y',
        'attributes' => array(
            'required' => 'required',
            'data-datepicker' => json_encode( array(
                'yearRange' => '-100:+0',
            ) ),
        ),
	) );
}
