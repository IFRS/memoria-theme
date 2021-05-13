<?php $navbar_id = uniqid('navbar-'); ?>
<a href="#inicio-menu" id="inicio-menu" class="is-sr-only">In&iacute;cio do menu</a>

<nav class="navbar is-transparent menu-principal" role="navigation" aria-label="Menu Principal">
    <div class="navbar-brand">
        <a role="button" class="navbar-burger" aria-label="Menu" aria-expanded="false" data-target="<?php echo $navbar_id; ?>">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <?php
        wp_nav_menu( array(
            'fallback_cb'     => false,
            'theme_location'  => 'main',
            'depth'           => 2,
            'container'       => 'div',
            'container_class' => 'navbar-menu',
            'container_id'    => $navbar_id,
            'menu_class'      => 'navbar-start',
            'items_wrap'      => '%3$s',
        ));
    ?>
    <div class="navbar-end is-align-items-center">
        <?php get_search_form(); ?>
    </div>
</nav>

<a href="#fim-menu" id="fim-menu" class="is-sr-only">Fim do menu</a>
