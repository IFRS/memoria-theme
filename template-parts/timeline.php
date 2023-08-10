<?php
  /* Blocksy Archive */
  $prefix = blocksy_manager()->screen->get_prefix();

  $maybe_custom_output = apply_filters(
    'blocksy:posts-listing:canvas:custom-output',
    null
  );

  if ($maybe_custom_output) {
    echo $maybe_custom_output;
    return;
  }

  $blog_post_structure = blocksy_listing_page_structure([
    'prefix' => $prefix
  ]);

  $container_class = 'ct-container';

  if ($blog_post_structure === 'gutenberg') {
    $container_class = 'ct-container-narrow';
  }

  echo blocksy_output_hero_section([
    'type' => 'type-2'
  ]);

  $section_class = '';

  if (! have_posts()) {
    $section_class = 'class="ct-no-results"';
  }

  /* Custom Posts List */
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

<div class="<?php echo $container_class ?>" <?php echo wp_kses_post(blocksy_sidebar_position_attr()); ?> <?php echo blocksy_get_v_spacing() ?>>
	<section <?php echo $section_class ?>>
		<?php
			echo blocksy_output_hero_section([
				'type' => 'type-1'
			]);
    ?>

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
    <div class="timeline-list animate__animated animate__fadeIn" style="animation-delay: <?php echo $delay; ?>ms">
      <?php foreach ($posts_by_year as $year => $posts) : ?>
        <div class="timeline <?php echo (reset($posts_by_year) === $posts) ? ' active' : ''; ?>" id="ano-<?php echo $year; ?>" role="tabpanel">
          <?php
            uasort($posts, function ($a, $b) {
              $a_meta = get_post_meta( $a->ID, '_registro_data', true );
              $b_meta = get_post_meta( $b->ID, '_registro_data', true );

              if (is_array($a_meta) && is_array($b_meta)) {
                $a_date = new DateTime();
                $a_date->setDate((int)$a_meta['year'] ?? 0, (int)$a_meta['month'] ?? 0, (int)$a_meta['day'] ?? 0);

                $b_date = new DateTime();
                $b_date->setDate((int)$b_meta['year'] ?? 0, (int)$b_meta['month'] ?? 0, (int)$b_meta['day'] ?? 0);

                if ($a_date == $b_date) {
                  return 0;
                }
                return ($a_date < $b_date) ? -1 : 1;
              }
              return -1;
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
                  $diames = null;
                  $diamesano = null;
                  if (is_array($data)) {
                    $diames = ($data['month']) ? (($data['day']) ? $data['day'] . ' de ' . date_i18n('F', mktime(0, 0, 0, $data['month'])) : date_i18n('F', mktime(0, 0, 0, $data['month']))) : '';
                    $diamesano = ($diames) ? $diames . ' de ' . $data['year'] : $data['year'];
                  }
                ?>
                <div class="timeline-registro__content">
                  <?php if (!empty($diames)) : ?>
                    <p class="timeline-registro__date" data-tooltip="<?php echo $diamesano; ?>"><?php echo $diames; ?></p>
                  <?php endif; ?>
                  <h3 class="timeline-registro__title"><a href="<?php echo get_the_permalink($post->ID); ?>" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $post->ID; ?>"><?php echo $post->post_title; ?></a></h3>
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

              <div id="modal-<?php echo $post->ID; ?>" class="modal animate__animated animate__backInDown animate__fast" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title"><?php echo $post->post_title; ?></h3>
                      <button type="button" data-bs-dismiss="modal" aria-label="Fechar" class="align-self-start ct-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="ct-icon" data-icon-size="large">
                          <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                        </svg>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="modal-meta">
                        <?php if (!empty($unidades)) : ?>
                          <div class="modal-meta__item">
                            <p>
                            <?php foreach ($unidades as $unidade) : ?>
                              <a href="<?php echo get_term_link($unidade); ?>"><?php echo $unidade->name; ?></a>
                            <?php endforeach; ?>
                            </p>
                          </div>
                        <?php endif; ?>
                        <?php if (!empty($diamesano)) : ?>
                          <div class="modal-meta__item modal-meta__item--right">
                            <p><strong><?php echo $diamesano; ?></strong></p>
                          </div>
                        <?php endif; ?>
                      </div>
                      <?php if (has_post_thumbnail($post->ID)) : ?>
                          <figure class="modal-img">
                            <a href="<?php echo get_the_post_thumbnail_url($post->ID, 'full') ?>">
                              <?php echo get_the_post_thumbnail($post->ID, 'full'); ?>
                            </a>
                            <figcaption>
                              <?php echo get_the_post_thumbnail_caption($post->ID); ?>
                            </figcaption>
                          </figure>
                      <?php endif; ?>
                      <?php echo apply_filters('the_content', $post->post_content); ?>
                    </div>
                    <div class="modal-footer">
                      <div class="modal-meta__item">
                        <small><strong>Atualizado em: </strong><?php echo get_the_modified_date('', $post->ID); ?> &agrave;s <?php echo get_the_modified_time('', $post->ID); ?></small>
                      </div>
                      <div class="modal-meta__item modal-meta__item--right">
                        <a href="<?php echo get_the_permalink($post->ID); ?>" data-tooltip="Abrir página completa">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-browser" width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="16" height="16" rx="1" /><line x1="4" y1="8" x2="20" y2="8" /><line x1="8" y1="4" x2="8" y2="8" /></svg>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php }); ?>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
	</section>

	<?php get_sidebar(); ?>
</div>
