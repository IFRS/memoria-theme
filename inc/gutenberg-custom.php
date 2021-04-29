<?php
/* Esconde o H1 e H2 do bloco de título */
add_action( 'admin_head', function() {
    echo '<style>
        #editor .block-library-heading-level-toolbar .components-toolbar-group button:first-child,
        #editor .block-library-heading-level-toolbar .components-toolbar-group button:first-child + button {
            display: none;
            pointer-events: none;
            visibility: hidden;
        }
    </style>';
} );

add_action('init', function() {
    register_block_style('core/paragraph', [
        'name' => 'destaque',
        'label' => __('Destacado', 'ifrs-memoria-theme'),
    ]);
});
