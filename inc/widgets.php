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
} );
