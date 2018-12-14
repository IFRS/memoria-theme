<?php get_header(); ?>

<main class="timeline">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide wall-01" data-year="2018">
                <div class="swiper-content">
                    <?php while(have_posts()) : the_post(); ?>
                        <div class="swiper-slide-content">
                            <span class="timeline-date"><?php echo get_post_meta( get_the_ID(), '_registro_data', true ); ?></span>
                            <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('full', array('class' => 'timeline-image'));
                                }
                            ?>
                            <h4 class="timeline-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <div class="timeline-text"><?php the_excerpt(); ?></div>
                            <a class="timeline-link" href="<?php the_permalink(); ?>">Saiba mais</a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <div class="swiper-pagination"></div>
    </div>
</main>

<?php get_footer(); ?>
