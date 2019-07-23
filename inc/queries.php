<?php
function ifrs_memoria_custom_queries( $query ) {
    if ($query->is_main_query() & !is_admin()) {
        if ($query->is_post_type_archive('registro') || $query->is_tax('unidade')) {
            $query->query_vars['posts_per_page'] = -1;
            $query->query_vars['nopaging'] = true;
            $query->query_vars['orderby'] = 'date';
            $query->query_vars['order'] = 'DESC';
        }
    }
}

add_action( 'pre_get_posts', 'ifrs_memoria_custom_queries' );
