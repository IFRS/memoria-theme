<?php
function memoria_breadcrumb() {
    $before_item   = '<li class="breadcrumb-item">';
    $before_active = '<li class="breadcrumb-item active" aria-current="page">';
    $after         = '</li>';

    if (!is_front_page() || is_paged()) {
        echo '<nav class="breadcrumb-nav" aria-label="Você está em:">';
		echo '<ol class="breadcrumb container">';

        global $post;
        $homeLink = home_url();
		$siteprincipal = get_home_url('1','/');
        $nomesite = get_bloginfo('name');

        echo $before_item;
        echo '<svg class="breadcrumb-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9"/><path d="M9 22V12h6v10M2 10.6L12 2l10 8.6"/></svg>';
        printf('<a href="%s">%s</a>', $homeLink, $nomesite);
        echo $after;

        if (is_home()) {
            echo $before_active . get_the_title(get_option( 'page_for_posts' )) . $after;
        } elseif (is_category()) {
            global $wp_query;
            $cat_obj   = $wp_query->get_queried_object();
            $thisCat   = $cat_obj->term_id;
            $thisCat   = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) {
                echo get_category_parents($parentCat, true, '');
            }
            echo $before_active . single_cat_title('', false) . $after;
        } elseif (is_day()) {
            echo $before_item . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after;
            echo $before_item . '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $after;
            echo $before_active . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo $before_item . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after;
            echo $before_active . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before_active . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug      = $post_type->rewrite;
                echo $before_item . '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->name . '</a>' . $after;
                echo $before_active . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                echo $before_item . get_category_parents($cat, true, '') . $after;
                echo $before_active . get_the_title() . $after;
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            if (is_tax('unidade')) {
                echo $before_item . '<a href="' . get_post_type_archive_link( 'registro' ) . '">' . __('Linha do Tempo', 'ifrs-memoria-theme') . '</a>' . $after;
                echo $before_active . single_term_title('', false) . $after;
            } else {
                echo $before_active . post_type_archive_title('', false) . $after;
            }
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat    = get_the_category($parent->ID);
            $cat    = $cat[0];
            echo get_category_parents($cat, true, '');
            echo $before_item . '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>' . $after;
            echo $before_active . get_the_title() . $after;

        } elseif (is_page() && !$post->post_parent) {
            echo $before_active . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
            $parent_id   = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page          = get_page($parent_id);
                $breadcrumbs[] = $before_item . '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>' . $after;
                $parent_id     = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo $crumb;
            }
            echo $before_active . get_the_title() . $after;
        } elseif (is_search()) {
            echo $before_active . 'Resultado da pesquisa por "' . get_search_query() . '"' . $after;
        } elseif (is_tag()) {
            echo $before_active . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before_active . ' ' . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before_active . 'Erro 404' . $after;
        }

        echo '</ol>';
		echo '</nav>';
    }
}
