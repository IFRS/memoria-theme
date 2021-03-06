<?php get_header(); ?>

<?php the_post(); ?>

<?php
    $unidades = get_the_terms(get_the_ID(), 'unidade');
    $data = get_post_meta( get_the_ID(), '_registro_data', true );
    $diames = ($data['month']) ? (($data['day']) ? $data['day'] . ' de ' . date_i18n('F', mktime(0, 0, 0, $data['month'])) : date_i18n('F', mktime(0, 0, 0, $data['month']))) : '';
    $diamesano = ($diames) ? $diames . ' de ' . $data['year'] : $data['year'];
?>

<h2 class="title"><?php the_title(); ?></h2>

<div class="columns">
    <div class="column is-6-desktop">
        <p>
        <?php foreach ($unidades as $unidade) : ?>
            <a class="registro__link align-self-start" href="<?php echo get_term_link($unidade); ?>"><?php echo $unidade->name; ?></a>
        <?php endforeach; ?>
        </p>
    </div>
    <div class="column is-6-desktop">
        <p class="has-text-right"><strong><?php echo $diamesano; ?></strong></p>
    </div>
</div>

<?php if (has_post_thumbnail(get_the_ID())) : ?>
    <figure class="image is-pulled-left mr-3 mb-3">
        <a href="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?>">
            <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
        </a>
        <figcaption class="has-text-centered is-italic">
            <?php echo get_the_post_thumbnail_caption(get_the_ID()); ?>
        </figcaption>
    </figure>
<?php endif; ?>

<div class="content">
    <?php the_content(); ?>
    <p>
        <small><strong>Atualizado em: </strong><?php echo get_the_modified_date('', get_the_ID()); ?> &agrave;s <?php echo get_the_modified_time('', get_the_ID()); ?></small>
    </p>
</div>

<?php get_footer(); ?>
