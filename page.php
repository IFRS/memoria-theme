<?php get_header(); ?>

<?php the_post(); ?>

<article class="content">
    <h2><?php the_title(); ?></h2>

    <?php if (has_post_thumbnail()) : ?>
        <figure class="image">
            <?php the_post_thumbnail('full'); ?>
        </figure>
    <?php endif; ?>

    <?php the_content(); ?>
</article>

<nav aria-label="Paginação do Conteúdo">
    <?php
        wp_link_pages(array(
            'before' => '<nav class="pagination is-centered"><ul class="pagination-list"><li>',
            'separator' => '</li><li>',
            'after'  => '</li></ul></nav>',
        ));
    ?>
</nav>

<?php get_footer(); ?>
