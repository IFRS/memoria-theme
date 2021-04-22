<?php get_header(); ?>

<?php
    tainacan_the_faceted_search([
        'default_view_mode' => 'masonry',
        'default_items_per_page' => 12,
        'hide_filters' => false,
        'hide_hide_filters_button' => false,
        'hide_search' => false,
        'hide_advanced_search' => false,
        'hide_sort_by_button' => false,
        'hide_exposers_button' => false,
        'hide_items_per_page_button' => false,
        'hide_go_to_page_button' => false,
        'show_filters_button_inside_search_control' => false,
        'start_with_filters_hidden' => false,
        'filters_as_modal' => false,
        'show_inline_view_mode_options' => false,
        'show_fullscreen_with_view_modes' => false
    ]);
?>

<?php get_footer(); ?>
