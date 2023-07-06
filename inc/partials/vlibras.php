<?php ob_start(); ?>
<!-- VLibras -->
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>

<?php
$html = ob_get_clean();

add_action( 'wp_footer', function() use ($html) {
    echo $html;
} );
