<?php $navbar_id = uniqid('navbar-'); ?>
<a href="#inicio-menu" id="inicio-menu" class="sr-only">In&iacute;cio do menu</a>

<nav class="navbar navbar-expand-lg navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#<?php echo $navbar_id; ?>" aria-controls="<?php echo $navbar_id; ?>" aria-expanded="false" aria-label="Navegação Principal">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php
        wp_nav_menu( array(
            'theme_location'  => 'main',
            'depth'           => 2,
            'container'       => 'div',
            'container_class' => 'navbar-collapse collapse',
            'container_id'    => $navbar_id,
            'menu_class'      => 'navbar-nav mr-auto',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ));
        get_search_form();
    ?>
</nav>

<a href="#fim-menu" id="fim-menu" class="sr-only">Fim do menu</a>
