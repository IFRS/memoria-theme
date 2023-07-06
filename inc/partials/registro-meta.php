<?php
  add_action( 'blocksy:single:content:top', function() {
    if ( is_singular( 'registro' ) ) :
      global $post;
      ob_start();
      $unidades = get_the_terms($post->ID, 'unidade');
      $data = get_post_meta( $post->ID, '_registro_data', true );
      $diames = ($data['month']) ? (($data['day']) ? $data['day'] . ' de ' . date_i18n('F', mktime(0, 0, 0, $data['month'])) : date_i18n('F', mktime(0, 0, 0, $data['month']))) : '';
      $diamesano = ($diames) ? $diames . ' de ' . $data['year'] : $data['year'];
?>

<div class="registro-meta">
  <div class="registro-meta__item">
    <?php foreach ($unidades as $unidade) : ?>
      <a href="<?php echo get_term_link($unidade); ?>"><?php echo $unidade->name; ?></a>
    <?php endforeach; ?>
  </div>
  <div class="registro-meta__item">
    <strong><?php echo $diamesano; ?></strong>
  </div>
</div>

<?php
      $html = ob_get_clean();

      echo $html;

    endif;
  } );
