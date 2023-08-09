<?php
add_action('pre_get_posts', function($query) {
	if (!is_admin() && $query->is_main_query()) {
		/* Timeline */
		if ($query->is_post_type_archive('registro') || $query->is_tax('unidade')) {
			$query->query_vars['posts_per_page'] = -1;
			$query->query_vars['nopaging'] = true;
		}
	}
});
