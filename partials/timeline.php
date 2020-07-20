<?php
    $posts_by_year = array();
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $date = get_post_meta( get_the_ID(), '_registro_data', true );
            $year = ($date['year']) ? $date['year'] : get_the_date('Y');
            if (!isset($posts_by_year[$year])) $posts_by_year[$year] = array();
            $posts_by_year[$year][] = get_post();
        }
    }
?>

<main class="timeline">
    <h2 class="sr-only">Linha do Tempo</h2>
    <ul class="timeline__ano-list nav" role="tablist">
        <?php foreach ($posts_by_year as $year => $posts) : ?>
            <li class="timeline__ano-item nav-item"><a class="timeline__ano-link nav-link<?php echo (reset($posts_by_year) === $posts) ? ' active' : ''; ?>" href="#tab-<?php echo $year; ?>" role="tab" aria-selected="false" data-toggle="tab"><?php echo $year; ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div class="tab-content">
        <?php foreach ($posts_by_year as $year => $posts) : ?>
            <div class="tab-pane animated<?php echo (reset($posts_by_year) === $posts) ? ' active' : ''; ?>" id="tab-<?php echo $year; ?>" role="tabpanel">
                <div class="timeline__ano-content">
                    <?php foreach ($posts as $post) : ?>
                        <div class="registro">
                            <?php $data = get_post_meta( get_the_ID(), '_registro_data', true ); ?>
                            <span class="registro__date animated slideInRight fast"><?php echo $data['day'], ($data['day']) ? ' de ' : '', ($data['month']) ? date_i18n('F', mktime(0, 0, 0, $data['month'])) : '???'; ?></span>
                            <?php
                                if (has_post_thumbnail($post->ID)) {
                                    echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-fluid registro__image animated zoomIn delay-1s'));
                                }
                            ?>
                            <h3 class="registro__title animated slideInRight"><a href="<?php echo get_the_permalink($post->ID); ?>" data-toggle="modal" data-target="#modal-<?php echo $post->ID; ?>"><?php echo $post->post_title; ?></a></h3>
                            <div class="registro__text animated slideInRight"><?php echo get_the_excerpt($post->ID); ?></div>
                            <?php $unidades = get_the_terms($post->ID, 'unidade'); ?>
                            <?php if (!empty($unidades)) : ?>
                                <?php foreach ($unidades as $unidade) : ?>
                                    <a class="registro__link animated slideInRight fast" href="<?php echo get_term_link($unidade); ?>"><?php echo $unidade->name; ?></a>
                                <?php endforeach; ?>
                            <?php endif; ?>
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
                                                        <a class="registro__link align-self-start" href="<?php echo get_term_link($unidade); ?>"><?php echo $unidade->name; ?></a>
                                                    <?php endforeach; ?>
                                                    </p>
                                                </div>
                                                <div class="col-12 col-md-6"><p class="text-right"><strong><?php echo get_the_date('', $post->ID); ?></strong></p></div>
                                            </div>
                                            <?php
                                                if (has_post_thumbnail($post->ID)) {
                                                    echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'mb-3 img-fluid registro__image'));
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
</main>
