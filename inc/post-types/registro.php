<?php
add_action( 'init', function() {
	$labels = array(
		'name'                  => _x( 'Linha do Tempo', 'Post Type General Name', 'ifrs-memoria-theme' ),
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
}, 2 );

/**
 * Define the metabox and field configurations.
 */
add_action( 'cmb2_admin_init', function() {
	$prefix = '_registro_';

	$data = new_cmb2_box( array(
		'id'            => 'data_metabox',
		'title'         => __( 'Data do Registro', 'ifrs-memoria-theme' ),
		'object_types'  => array( 'registro' ),
		'context'       => 'normal',
		'priority'      => 'low',
		'show_names'    => false,
	) );

	$data->add_field( array(
		'name'           => 'Data',
		'desc'           => __( 'Escolha a data desse registro temporal. Dia e mês são opcionais, selecione a opção "---" para deixar em branco.', 'ifrs-memoria-theme' ),
		'id'             => $prefix . 'data',
		'type'           => 'customdate',
	) );

	$unidade = new_cmb2_box( array(
		'id'            => 'unidade_metabox',
		'title'         => __( 'Unidades', 'ifrs-memoria-theme' ),
		'object_types'  => array( 'registro' ),
		'context'       => 'side',
		'priority'      => 'low',
		'show_names'    => false,
	) );

	$unidade->add_field( array(
		'name'           => 'Unidades',
		'desc'           => 'Escolha a unidade desse registro temporal.',
		'id'             => $prefix . 'unidade',
		'taxonomy'       => 'unidade',
		'type'           => 'taxonomy_radio',
		'text'           => array(
			'no_terms_text' => 'Ops. Não foi encontrada nenhuma Unidade.'
		),
		'remove_default' => 'true'
	) );
}, 2 );

/**
 * Render Custom Date Field
 */
function cmb2_get_year_options( $value = false ) {
	$current_year = date('Y');
	$range_years = range(1900, $current_year);
	$years = array_combine($range_years, $range_years);

	$years_options = '';
	foreach ( $years as $year_number => $year_text ) {
		$years_options .= '<option value="'. $year_number .'" '. selected( $value, $year_number, false ) .'>'. $year_text .'</option>';
	}

	return $years_options;
}

function cmb2_get_month_options( $value = false ) {
	$months = array_reduce(range(1,12), function($rslt, $m) { $rslt[$m] = date_i18n('F', mktime(0,0,0,$m,1)); return $rslt; });

	$months_options = '<option value="">---</option>';
	foreach ( $months as $month_number => $month_text ) {
		$months_options .= '<option value="'. $month_number .'" '. selected( $value, $month_number, false ) .'>'. $month_text .'</option>';
	}

	return $months_options;
}

function cmb2_get_day_options( $value = false ) {
	$days = array();
	for ($i = 1; $i <= 31; $i++) {
		$days[$i] = ($i <= 9) ? '0'.$i : $i;
	}

	$days_options = '<option value="">---</option>';
	foreach ( $days as $day_number => $day_text ) {
		$days_options .= '<option value="'. $day_number .'" '. selected( $value, $day_number, false ) .'>'. $day_text .'</option>';
	}

	return $days_options;
}

add_filter( 'cmb2_render_customdate', function( $field, $value, $object_id, $object_type, $field_type ) {
	// make sure we specify each part of the value we need.
	$value = wp_parse_args( $value, array(
		'year'  => '',
		'month' => '',
		'day'   => '',
	) );
?>
	<label class="screen-reader-text" for="<?php echo $field_type->_id( '_day' ); ?>'">Day</label>
	<?php echo $field_type->select( array(
		'name'    => $field_type->_name( '[day]' ),
		'id'      => $field_type->_id( '_day' ),
		'value'   => $value['day'],
		'options' => cmb2_get_day_options( $value['day'] ),
		'desc'    => '',
	) ); ?>
	/
	<label class="screen-reader-text" for="<?php echo $field_type->_id( '_month' ); ?>'">Mês</label>
	<?php echo $field_type->select( array(
		'name'    => $field_type->_name( '[month]' ),
		'id'      => $field_type->_id( '_month' ),
		'value'   => $value['month'],
		'options' => cmb2_get_month_options( $value['month'] ),
		'desc'    => '',
	) ); ?>
	/
	<label class="screen-reader-text" for="<?php echo $field_type->_id( '_year' ); ?>">Ano</label>
	<?php echo $field_type->select( array(
		'name'    => $field_type->_name( '[year]' ),
		'id'      => $field_type->_id( '_year' ),
		'value'   => $value['year'],
		'options' => cmb2_get_year_options( $value['year'] ),
		'desc'    => '',
	) ); ?>
	<br class="clear">
<?php
	echo $field_type->_desc( true );
}, 10, 5 );
