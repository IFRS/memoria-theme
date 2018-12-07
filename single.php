<?php get_header(); ?>

<?php the_post(); ?>

<article class="post">
    <h2 class="post__title"><?php the_title(); ?></h2>
    <div class="post__content">
        <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('full', array('class' => 'post__thumb'));
            }
        ?>
        <?php the_content(); ?>
        <hr>
        <div class="row post__meta">
            <div class="col col-md-6">
                <p class="post__date">Publicado em <?php the_date('d/m/Y'); ?></p>
            </div>
            <div class="col col-md-6">
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
    </div>
</article>

<?php get_footer(); ?>
