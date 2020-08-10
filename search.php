<?php get_header(); ?>

<main class="content">
<?php if (!have_posts()) : ?>
    <div class="row">
        <div class="col-12">
            <h2 class="search__title"><?php printf('Busca por &quot;%s&quot;', get_search_query()); ?></h2>
        </div>
    </div>
    <div class="alert alert-warning">
        <p><?php _e('Nenhum resultado encontrado.'); ?></p>
    </div>
<?php else : ?>
    <div class="row">
        <div class="col-12">
            <h2 class="search__title"><?php printf('Resultados da busca por &quot;%s&quot;', get_search_query()); ?></h2>
        </div>
    </div>
    <?php while (have_posts()) : the_post(); ?>
    <article class="search-result">
        <div class="row">
            <div class="col-12">
                <h3 class="search-result__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </div>
            <div class="col-12">
                <p class="search-result__link"><?php the_permalink(); ?></p>
            </div>
            <div class="col-12">
                <?php the_excerpt(); ?>
            </div>
        </div>
    </article>
    <?php endwhile; ?>
<?php endif; ?>
</main>

<?php the_posts_navigation(array('next_text' => 'Resultados anteriores', 'prev_text' => 'Mais resultados', 'screen_reader_text' => ' ')); ?>

<?php get_footer(); ?>