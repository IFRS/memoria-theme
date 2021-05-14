<?php get_header(); ?>

<h2 class="title"><?php echo get_the_archive_title(); ?></h2>
<?php if ( have_posts() ) : ?>
    <div class="columns is-multiline">
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
            <div class="card">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="card-image">
                        <figure class="image is-16by9">
                            <?php the_post_thumbnail('full', array('class' => 'card-img-top')); ?>
                        </figure>
                    </div>
                <?php endif; ?>
                <div class="card-content">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php the_excerpt(); ?></p>
                </div>
                <?php
                    $itens = wp_count_posts( 'tnc_col_' . get_the_ID() . '_item' );
                    $num = $itens->publish;
                ?>
                <?php if ($num > 0) : ?>
                <div class="card-footer">
                    <div class="card-footer-item">
                        <p class="has-text-grey">
                            <?php echo $num . ' ' . _n('item', 'itens', $num, 'ifrs-memoria-theme'); ?>
                        </p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
    </div>
<?php else : ?>
    <article class="message is-warning">
        <div class="message-body">
            <?php _e( 'Não foi encontrada nenhuma Coleção.', 'ifrs-memoria-theme' ); ?>
        </div>
    </article>
<?php endif; ?>

<?php get_footer(); ?>
