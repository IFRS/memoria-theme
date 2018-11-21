<a href="#inicio-menu" id="inicio-menu" class="sr-only">In&iacute;cio do menu</a>

<?php
    wp_nav_menu( array(
        'theme_location'    => 'main',
        'depth'             => 2,
        'container'         => 'nav',
        'container_class'   => 'menu',
        'container_id'      => false,
        'menu_class'        => 'nav flex-column',
    ));
?>

<a href="#fim-menu" id="fim-menu" class="sr-only">Fim do menu</a>
