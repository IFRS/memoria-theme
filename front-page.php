<?php get_header(); ?>

<?php the_post(); ?>


<div class="aligncenter">
    <h2 class="title mb-5 front-page__title"><?php the_title(); ?></h2>
</div>

<div class="content">
    <?php the_content(); ?>
</div>

<?php get_footer(); ?>
