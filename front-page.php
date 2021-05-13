<?php get_header(); ?>

<?php the_post(); ?>

<div class="content">
    <div class="aligncenter">
        <h2 class="front-page__title"><?php the_title(); ?></h2>
    </div>
    <?php the_content(); ?>
</div>

<?php get_footer(); ?>
