<?php get_header(); ?>

<?php the_post(); ?>
<article class="post content">
    <h2 class="post__title"><?php the_title(); ?></h2>
    <div class="post__content">
        <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('full', array('class' => 'post__thumb'));
            }
        ?>
        <?php the_content(); ?>
    </div>
    <hr>
    <div class="columns post__meta">
        <div class="column is-6-desktop">
            <p class="post__date"><small>Publicado em <?php the_date('d/m/Y'); ?></small></p>
        </div>
        <div class="column is-6-desktop">
            <?php $cats = get_the_category(); ?>
            <?php if (!empty($cats)) : ?>
                <ul class="post__categories">
                    <?php foreach ($cats as $key => $cat) : ?>
                        <li><a href="<?php echo get_category_link( $cat->term_id ); ?>"><?php echo $cat->name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</article>

<?php get_footer(); ?>
