<?php get_header(); ?>

<?php if (!have_posts()) : ?>
    <h2 class="title"><?php printf('Busca por &quot;%s&quot;', get_search_query()); ?></h2>
    <article class="message is-warning">
        <div class="message-body">
            <p><?php _e('Nenhum resultado encontrado.', 'ifrs-memoria-theme'); ?></p>
        </div>
    </article>
<?php else : ?>
    <h2 class="title"><?php printf('Resultados da busca por &quot;%s&quot;', get_search_query()); ?></h2>
    <?php while (have_posts()) : the_post(); ?>
        <article class="media">
            <div class="media-left">
                <figure class="image is-64x64">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('post-thumbnail'); ?>
                    <?php else : ?>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/placeholder.jpg" alt="" aria-hidden="true">
                    <?php endif; ?>
                </figure>
            </div>
            <div class="media-content">
                <small class="is-size-7 has-text-success-dark"><?php echo get_the_permalink(); ?></small>
                <h3 class="mb-0 is-size-5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php the_excerpt(); ?>
            </div>
        </article>
    <?php endwhile; ?>
<?php endif; ?>

<?php the_posts_navigation(array('next_text' => 'Resultados anteriores', 'prev_text' => 'Mais resultados', 'screen_reader_text' => ' ')); ?>

<?php get_footer(); ?>
