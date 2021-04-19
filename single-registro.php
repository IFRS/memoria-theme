<?php get_header(); ?>

<?php the_post(); ?>

<?php
    $unidades = get_the_terms(get_the_ID(), 'unidade');
    $data = get_post_meta( get_the_ID(), '_registro_data', true );
    $diames = ($data['month']) ? (($data['day']) ? $data['day'] . ' de ' . date_i18n('F', mktime(0, 0, 0, $data['month'])) : date_i18n('F', mktime(0, 0, 0, $data['month']))) : '';
    $diamesano = ($diames) ? $diames . ' de ' . $data['year'] : $data['year'];
?>

<h2><?php the_title(); ?></h2>

<div class="row">
    <div class="col-12 col-md-6">
        <p>
        <?php foreach ($unidades as $unidade) : ?>
            <a class="registro__link align-self-start" href="<?php echo get_term_link($unidade); ?>"><?php echo $unidade->name; ?></a>
        <?php endforeach; ?>
        </p>
    </div>
    <div class="col-12 col-md-6"><p class="text-right"><strong><?php echo $diamesano; ?></strong></p></div>
</div>
<?php if (has_post_thumbnail(get_the_ID())) : ?>
    <div class="registro-detalhe__image">
        <a href="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-fluid')); ?></a>
        <p class="registro-detalhe__caption"><?php echo get_the_post_thumbnail_caption(get_the_ID()); ?></p>
    </div>
<?php endif; ?>

<?php the_content(); ?>

<div class="row">
    <div class="col-12">
        <small><strong>Atualizado em: </strong><?php echo get_the_modified_date('', get_the_ID()); ?> &agrave;s <?php echo get_the_modified_time('', get_the_ID()); ?></small>
    </div>
</div>

<?php get_footer(); ?>
