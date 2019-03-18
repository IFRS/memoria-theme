<?php
    $posts_by_year = array();
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $year = get_the_date('Y');
            if (!isset($posts_by_year[$year])) $posts_by_year[$year] = array();
            $posts_by_year[$year][] = get_post();
        }
    }
?>

<main class="timeline">
    <h2 class="sr-only">Linha do Tempo</h2>
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
                                <h3 class="timeline-title"><a href="<?php echo get_the_permalink($post->ID); ?>" data-toggle="modal" data-target="#modal-<?php echo $post->ID; ?>"><?php echo $post->post_title; ?></a></h3>
                                <div class="timeline-text"><?php echo get_the_excerpt($post->ID); ?></div>
                                <?php $unidades = get_the_terms($post->ID, 'unidade'); ?>
                                <?php foreach ($unidades as $unidade) : ?>
                                    <a class="timeline-link" href="<?php echo get_term_link($unidade); ?>"><?php echo $unidade->name; ?></a>
                                <?php endforeach; ?>
                            </div>
                            <?php add_action('wp_footer', function() use ($post, $unidades) { ?>
                                <div class="modal fade" id="modal-<?php echo $post->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-<?php echo $post->ID; ?>-title" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modal-<?php echo $post->ID; ?>-title"><?php echo $post->post_title; ?></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <p>
                                                        <?php foreach ($unidades as $unidade) : ?>
                                                            <a class="timeline-link align-self-start" href="<?php echo get_term_link($unidade); ?>"><?php echo $unidade->name; ?></a>
                                                        <?php endforeach; ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-12 col-md-6"><p class="text-right"><strong><?php echo get_the_date('', $post->ID); ?></strong></p></div>
                                                </div>
                                                <?php
                                                    if (has_post_thumbnail($post->ID)) {
                                                        echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'mb-3 img-fluid timeline-image'));
                                                    }
                                                ?>
                                                <?php echo $post->post_content; ?>
                                            </div>
                                            <div class="modal-footer">
                                                <small><strong>Atualizado em: </strong><?php echo get_the_modified_date('', $post->ID); ?> &agrave;s <?php echo get_the_modified_time('', $post->ID); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="swiper-pagination"></div>
    </div>
</main>
