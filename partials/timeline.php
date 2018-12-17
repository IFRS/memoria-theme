<?php
    $posts_by_year = array();
    if (have_posts()) {
        while(have_posts()) {
            the_post();
            $year = get_the_date('Y');
            if (!isset($posts_by_year[$year])) $posts_by_year[$year] = array();
            $posts_by_year[$year][] = get_post();
        }
    }
?>

<main class="timeline">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php foreach ($posts_by_year as $year => $posts) : ?>
                <div class="swiper-slide" data-year="<?php echo $year; ?>">
                    <div class="swiper-content">
                        <?php foreach ($posts as $post) : ?>
                            <div class="swiper-slide-content">
                                <span class="timeline-date"><?php echo get_the_date('d \d\e F', $post->ID); ?></span>
                                <?php
                                    if (has_post_thumbnail($post->ID)) {
                                        echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-fluid timeline-image'));
                                    }
                                ?>
                                <h4 class="timeline-title"><a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h4>
                                <div class="timeline-text"><?php echo $post->post_excerpt; ?></div>
                                <a class="timeline-link" href="<?php echo get_the_permalink($post->ID); ?>">Saiba mais</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="swiper-pagination"></div>
    </div>
</main>
