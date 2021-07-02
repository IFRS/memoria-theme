<?php
    $posts_by_year = array();
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $date = get_post_meta( get_the_ID(), '_registro_data', true );
            $year = ($date && $date['year']) ? $date['year'] : get_the_date('Y');
            if (!isset($posts_by_year[$year])) $posts_by_year[$year] = array();
            $posts_by_year[$year][] = get_post();
            ksort($posts_by_year);
        }
    }
?>

<h2 class="title has-text-centered">
    Linha do Tempo
    <?php if (is_tax('unidade')) echo single_term_title(' - '); ?>
</h2>
<ul class="ano-list" role="tablist">
    <?php $delay = 0; ?>
    <?php foreach ($posts_by_year as $year => $posts) : ?>
        <li class="ano-list__item animate__animated animate__backInDown" style="animation-delay: <?php echo $delay; ?>ms">
            <a class="ano-list__link <?php echo (reset($posts_by_year) === $posts) ? ' active' : ''; ?>" href="#ano-<?php echo $year; ?>" role="tab" aria-selected="<?php echo (reset($posts_by_year) === $posts) ? 'true' : 'false'; ?>" data-posts="<?php echo count($posts); ?>">
                <?php echo $year; ?>
            </a>
        </li>
        <?php $delay += 20; ?>
    <?php endforeach; ?>
    <small class="timeline-info" aria-live="polite"></small>
</ul>
<div class="timeline-list">
    <?php foreach ($posts_by_year as $year => $posts) : ?>
        <div class="timeline <?php echo (reset($posts_by_year) === $posts) ? ' active' : ''; ?>" id="ano-<?php echo $year; ?>" role="tabpanel">
            <?php
                uasort($posts, function ($a, $b) {
                    $a_meta = get_post_meta( $a->ID, '_registro_data', true );
                    $b_meta = get_post_meta( $b->ID, '_registro_data', true );

                    $a_date = new DateTime();
                    $a_date->setDate(($a_meta['year']) ? $a_meta['year'] : 0, ($a_meta['month']) ? $a_meta['month'] : 0, ($a_meta['day']) ? $a_meta['day'] : 0);

                    $b_date = new DateTime();
                    $b_date->setDate(($b_meta['year']) ? $b_meta['year'] : 0, ($b_meta['month']) ? $b_meta['month'] : 0, ($b_meta['day']) ? $b_meta['day'] : 0);

                    if ($a_date == $b_date) {
                        return 0;
                    }
                    return ($a_date < $b_date) ? -1 : 1;
                });
            ?>
            <?php foreach ($posts as $post) : ?>
                <div class="registro<?php echo (has_post_thumbnail()) ? '' : ' registro--without-thumbnail' ?>">
                    <div class="card">
                        <?php if (has_post_thumbnail($post->ID)) : ?>
                            <div class="card-image">
                                <figure class="image is-16by9">
                                    <?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'registro__image animate__animated animate__fadeIn animate__delay-1s')); ?>
                                </figure>
                            </div>
                        <?php endif; ?>
                        <div class="card-content">
                            <?php
                                $data = get_post_meta( $post->ID, '_registro_data', true );
                                $diames = ($data['month']) ? (($data['day']) ? $data['day'] . ' de ' . date_i18n('F', mktime(0, 0, 0, $data['month'])) : date_i18n('F', mktime(0, 0, 0, $data['month']))) : '';
                                $diamesano = ($diames) ? $diames . ' de ' . $data['year'] : $data['year'];
                            ?>
                            <?php if (!empty($diames)) : ?>
                                <p class="registro__date" data-tooltip="<?php echo $diamesano; ?>"><?php echo $diames; ?></p>
                            <?php endif; ?>
                            <h3 class="registro__title"><a href="<?php echo get_the_permalink($post->ID); ?>" data-toggle="modal" data-target="#modal-<?php echo $post->ID; ?>"><?php echo $post->post_title; ?></a></h3>
                            <div class="registro__text"><?php echo get_the_excerpt($post->ID); ?></div>
                            <?php $unidades = get_the_terms($post->ID, 'unidade'); ?>
                            <?php if (!is_tax('unidade')) : ?>
                                <?php if (!empty($unidades)) : ?>
                                    <?php foreach ($unidades as $unidade) : ?>
                                        <a class="registro__link" href="<?php echo get_term_link($unidade); ?>"><?php echo $unidade->name; ?></a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php add_action('wp_footer', function() use ($post, $unidades, $diamesano) { ?>
                    <!-- Modal -->
                    <div class="modal" id="modal-<?php echo $post->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-<?php echo $post->ID; ?>-title" aria-hidden="true">
                        <div class="modal-background"></div>
                        <div class="modal-card">
                            <div class="modal-card-head">
                                <h4 class="modal-card-title is-flex-shrink-1 mb-0" id="modal-<?php echo $post->ID; ?>-title"><?php echo $post->post_title; ?></h4>
                            </div>
                            <div class="modal-card-body">
                                <div class="columns">
                                    <div class="column">
                                        <p>
                                        <?php foreach ($unidades as $unidade) : ?>
                                            <a class="registro__link align-self-start" href="<?php echo get_term_link($unidade); ?>"><?php echo $unidade->name; ?></a>
                                        <?php endforeach; ?>
                                        </p>
                                    </div>
                                    <div class="column">
                                        <p class="has-text-right"><strong><?php echo $diamesano; ?></strong></p>
                                    </div>
                                </div>
                                <?php if (has_post_thumbnail($post->ID)) : ?>
                                        <figure class="image mb-3">
                                            <a href="<?php echo get_the_post_thumbnail_url($post->ID, 'full') ?>">
                                                <?php echo get_the_post_thumbnail($post->ID, 'full'); ?>
                                            </a>
                                            <figcaption class="has-text-centered is-italic">
                                                <?php echo get_the_post_thumbnail_caption($post->ID); ?>
                                            </figcaption>
                                        </figure>
                                <?php endif; ?>
                                <?php echo apply_filters('the_content', $post->post_content); ?>
                            </div>
                            <div class="modal-card-foot">
                                <small><strong>Atualizado em: </strong><?php echo get_the_modified_date('', $post->ID); ?> &agrave;s <?php echo get_the_modified_time('', $post->ID); ?></small>
                            </div>
                        </div>
                        <button class="modal-close is-large" aria-label="close"></button>
                    </div>
                <?php }); ?>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
