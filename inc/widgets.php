<?php
add_action( 'widgets_init', function() {
    register_sidebar( array(
        'name'          => __('Área Rodapé', 'ifrs-memoria-theme'),
        'id'            => 'sidebar-rodape',
        'description'   => __('Área no rodapé, usualmente para colocar os contatos e endereço.', 'ifrs-memoria-theme'),
        'before_widget' => '<div id="%1$s" class="footer__widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="footer__titulo">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __('Redes Sociais', 'ifrs-memoria-theme'),
        'id'            => 'sidebar-social',
        'description'   => __('Área no rodapé para ícones das redes sociais', 'ifrs-memoria-theme'),
        'before_widget' => '<div id="%1$s" class="widget-social %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="is-sr-only">',
        'after_title'   => '</h3>',
    ) );
} );
