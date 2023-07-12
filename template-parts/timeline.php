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

<div class="ct-container-full" data-content="normal" data-vertical-spacing="top:bottom">
  <h2 class="timeline-title page-title">
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
          <div class="timeline-registro<?php echo (has_post_thumbnail()) ? '' : ' timeline-registro--without-thumbnail' ?>">
            <div class="card">
              <?php if (has_post_thumbnail($post->ID)) : ?>
                <?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'timeline-registro__image animate__animated animate__fadeIn animate__delay-1s')); ?>
              <?php endif; ?>
              <?php
                $data = get_post_meta( $post->ID, '_registro_data', true );
                $diames = ($data['month']) ? (($data['day']) ? $data['day'] . ' de ' . date_i18n('F', mktime(0, 0, 0, $data['month'])) : date_i18n('F', mktime(0, 0, 0, $data['month']))) : '';
                $diamesano = ($diames) ? $diames . ' de ' . $data['year'] : $data['year'];
              ?>
              <div class="timeline-registro__content">
                <?php if (!empty($diames)) : ?>
                  <p class="timeline-registro__date" data-tooltip="<?php echo $diamesano; ?>"><?php echo $diames; ?></p>
                <?php endif; ?>
                <h3 class="timeline-registro__title"><a href="<?php echo get_the_permalink($post->ID); ?>" data-swal-template="#modal-<?php echo $post->ID; ?>" data-toggle="modal" data-target="#modal-<?php echo $post->ID; ?>"><?php echo $post->post_title; ?></a></h3>
                <div class="timeline-registro__text"><?php echo get_the_excerpt($post->ID); ?></div>
                <?php $unidades = get_the_terms($post->ID, 'unidade'); ?>
                <?php if (!is_tax('unidade')) : ?>
                  <?php if (!empty($unidades)) : ?>
                    <?php foreach ($unidades as $unidade) : ?>
                      <a class="timeline-registro__link" href="<?php echo get_term_link($unidade); ?>"><?php echo $unidade->name; ?></a>
                    <?php endforeach; ?>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php add_action('wp_footer', function() use ($post, $unidades, $diamesano) { ?>
            <!-- Modal -->
            <template id="modal-<?php echo $post->ID; ?>">
              <swal-title>
                <?php echo $post->post_title; ?>
              </swal-title>
              <swal-html>
                <div class="modal-meta">
                  <div class="modal-meta__item">
                    <p>
                    <?php foreach ($unidades as $unidade) : ?>
                      <a href="<?php echo get_term_link($unidade); ?>"><?php echo $unidade->name; ?></a>
                    <?php endforeach; ?>
                    </p>
                  </div>
                  <div class="modal-meta__item modal-meta__item--right">
                    <p><strong><?php echo $diamesano; ?></strong></p>
                  </div>
                </div>
                <?php if (has_post_thumbnail($post->ID)) : ?>
                    <figure>
                      <a href="<?php echo get_the_post_thumbnail_url($post->ID, 'full') ?>">
                        <?php echo get_the_post_thumbnail($post->ID, 'full'); ?>
                      </a>
                      <figcaption>
                        <?php echo get_the_post_thumbnail_caption($post->ID); ?>
                      </figcaption>
                    </figure>
                <?php endif; ?>
                <?php echo apply_filters('the_content', $post->post_content); ?>
              </swal-html>
              <swal-footer>
                <div class="modal-meta__item">
                  <small><strong>Atualizado em: </strong><?php echo get_the_modified_date('', $post->ID); ?> &agrave;s <?php echo get_the_modified_time('', $post->ID); ?></small>
                </div>
                <div class="modal-meta__item modal-meta__item--right">
                  <a href="<?php echo get_the_permalink($post->ID); ?>" data-tooltip="Abrir página completa">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-browser" width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="16" height="16" rx="1" /><line x1="4" y1="8" x2="20" y2="8" /><line x1="8" y1="4" x2="8" y2="8" /></svg>
                  </a>
                </div>
              </swal-footer>
              <swal-param name="showConfirmButton" value="false" />
              <swal-param name="showCloseButton" value="true" />
              <swal-param name="showClass" value='{ "popup": "animate__animated animate__faster animate__backInDown" }' />
              <swal-param name="hideClass" value='{ "popup": "animate__animated animate__faster animate__backOutUp" }' />
            </template>
          <?php }); ?>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>
