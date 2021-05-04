<?php get_header(); ?>

<h2><?php echo get_the_archive_title(); ?></h2>
<?php if ( have_posts() ) : ?>
    <div class="card-columns">
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="card" style="width: 18rem;">
            <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('full', array('class' => 'card-img-top'));
                }
            ?>
            <div class="card-body">
                <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="card-text"><?php the_excerpt(); ?></p>
            </div>
            <?php
                $itens = wp_count_posts( 'tnc_col_' . get_the_ID() . '_item' );
                $num = $itens->publish;
            ?>
            <?php if ($num > 0) : ?>
            <div class="card-footer justify-content-center">
                <p class="mb-0 text-muted">
                    <?php echo $num . ' ' . _n('item', 'itens', $num, 'ifrs-memoria-theme'); ?>
                </p>
            </div>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
    </div>
<?php else : ?>
    <div class="alert alert-warning">
        <?php _e( 'Não foi encontrada nenhuma Coleção', 'ifrs-memoria-theme' ); ?>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
