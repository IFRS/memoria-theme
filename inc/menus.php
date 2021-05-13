<?php
/* Registra os menus */
register_nav_menus(array(
    'main' => 'Menu Principal',
));

/* Customiza os menus para funcionarem com o Bulma */
add_filter( 'nav_menu_submenu_css_class', function( $classes ) {
    $classes[] = 'navbar-dropdown';

    return $classes;
}, 10, 1 );

add_filter( 'nav_menu_css_class', function( $classes, $item, $args, $depth ) {
    $classes[] = 'navbar-item';

    if ( array_search( 'menu-item-has-children', $classes ) ) {
        $classes[] = 'has-dropdown';
    }

    return $classes;
}, 10, 4);

add_filter( 'nav_menu_link_attributes', function( $atts, $item, $args, $depth ) {
    if ( array_search('menu-item-has-children', $item->classes ) ) {
        $atts['class'] = 'navbar-link';
    }

    return $atts;
}, 10, 4 );
