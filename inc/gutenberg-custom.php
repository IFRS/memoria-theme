<?php
add_action('init', function() {
    register_block_style('core/paragraph', [
        'name' => 'destaque',
        'label' => __('Destacado', 'ifrs-memoria-theme'),
    ]);
});
