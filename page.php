<?php get_header(); ?>

<?php the_post(); ?>

<main class="content">
    <article class="post">
        <h2 class="post__title"><?php the_title(); ?></h2>
        <div class="post__content">
            <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('full', array('class' => 'post__thumb'));
                }
            ?>
            <?php the_content(); ?>
        </div>
    </article>
</main>

<?php get_footer(); ?>
