<?php get_header(); ?>

<?php the_post(); ?>

<article id="post-<?php the_ID()?>" <?php post_class(array('theme-item'))?>>
    <div class="media is-align-items-center mb-3">
        <div class="media-left mr-2">
            <?php if ( has_post_thumbnail( tainacan_get_collection_id() ) ) :
                $thumbnail_id = get_post_thumbnail_id( tainacan_get_collection_id() );
                $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); ?>
                <picture class="image is-24x24">
                    <img src="<?php echo get_the_post_thumbnail_url( tainacan_get_collection_id() ); ?>" width="24" height="24" alt="<?php echo esc_attr($alt); ?>">
                </picture>
            <?php else : ?>
                <div class="has-text-centered has-background-white p-1" aria-hidden="true">
                    <strong><?php echo esc_html( tainacan_get_initials( tainacan_get_the_collection_name() ) ); ?></strong>
                </div>
            <?php endif; ?>
        </div>
        <div class="media-content">
            <p>
                <?php echo __('Coleção', 'ifrs-memoria-theme'); ?>
                <?php if ( function_exists('tainacan_the_collection_url') ): ?>
                    <a href="<?php tainacan_the_collection_url(); ?>">
                        <?php tainacan_the_collection_name(); ?>
                    </a>
                <?php else : ?>
                    <?php tainacan_the_collection_name(); ?>
                <?php endif; ?>
            </p>
        </div>
    </div>

    <div class="content">
        <h2>
            <?php the_title(); ?>
            <small class="is-size-6 my-2 is-pulled-right"><?php tainacan_the_item_edit_link(); ?></small>
        </h2>

        <section class="columns is-multiline tainacan-metadata">
            <?php if (has_post_thumbnail()) : ?>
                <div class="column is-narrow">
                    <figure class="image is-128x128 m-0">
                    <a href="<?php the_post_thumbnail_url( 'full' ); ?>">
                        <?php the_post_thumbnail('post-thumbnail', array('class' => 'tainacan-metadata__thumb')); ?>
                    </a>
                    </figure>
                </div>
            <?php endif; ?>
            <?php
                tainacan_the_metadata( array(
                    'before'        => '<div class="column is-6 is-4-desktop is-3-widescreen metadata-type-$type $id">',
                    'after'         => '</div>',
                    'before_title'  => '<h3 class="tainacan-metadata__title">',
                    'after_title'   => '</h3>',
                    'before_value'  => '<p class="tainacan-metadata__value">',
                    'after_value'   => '</p>',
                ) );
            ?>
        </section>

        <hr>
    </div>

    <?php $attachments = tainacan_get_the_attachments(); ?>

    <?php if ( tainacan_has_document() && empty( $attachments ) ) : ?>
        <section class="tainacan-document has-text-centered mb-5">
            <h3 class="title is-4"><?php _e('Documento', 'ifrs-memoria-theme'); ?></h3>
            <div class="tainacan-document__item">
                <?php tainacan_the_document(); ?>
                <?php if ( function_exists('tainacan_the_item_document_download_link') && tainacan_the_item_document_download_link() != '' ) : ?>
                    <span class="tainacan-document__download">
                        <?php echo tainacan_the_item_document_download_link(); ?>
                    </span>
                <?php endif; ?>
            </div>
        </section>
    <?php elseif ( ! empty( $attachments ) ) : ?>
        <section class="tainacan-gallery has-text-centered mb-3">
            <h3 class="title is-4"><?php _e('Documento e Anexos', 'ifrs-memoria-theme'); ?></h3>
                <?php
                $media_items_thumbs = array();
                $media_items_main = array();

                if ( tainacan_has_document() ) {
                    $is_document_type_attachment = tainacan_get_the_document_type() === 'attachment';
                    $media_items_main[] =
                        tainacan_get_the_media_component_slide(array(
                            'after_slide_metadata' => (
                                ( tainacan_the_item_document_download_link() != '' ) ?
                                    ('<span class="tainacan-item-file-download">' . tainacan_the_item_document_download_link() . '</span>')
                                    : ''
                            ),
                            'media_content' => tainacan_get_the_document(),
                            'media_content_full' => $is_document_type_attachment ? tainacan_get_the_document(0, 'full') : ('<div class="attachment-without-image">' . tainacan_get_the_document(0, 'full') . '</div>'),
                            'media_title' => $is_document_type_attachment ? get_the_title(tainacan_get_the_document_raw()) : '',
                            'media_description' => $is_document_type_attachment ? get_the_content(tainacan_get_the_document_raw()) : '',
                            'media_caption' => $is_document_type_attachment ? wp_get_attachment_caption(tainacan_get_the_document_raw()) : '',
                            'media_type' => tainacan_get_the_document_type(),
                            'class_slide_metadata' => ''
                        ));
                }

                foreach ( $attachments as $attachment ) {
                    $media_items_main[] =
                        tainacan_get_the_media_component_slide(array(
                            'after_slide_metadata' => (( tainacan_the_item_attachment_download_link($attachment->ID) != '' ) ?
                                                            '<span class="tainacan-item-file-download">' . tainacan_the_item_attachment_download_link($attachment->ID) . '</span>'
                                                    : ''),
                            'media_content' => tainacan_get_attachment_as_html($attachment->ID, 0),
                            'media_content_full' => wp_attachment_is('image', $attachment->ID) ? wp_get_attachment_image( $attachment->ID, 'full', false) : ('<div class="attachment-without-image tainacan-embed-container"><iframe id="tainacan-attachment-iframe" src="' . tainacan_get_attachment_html_url($attachment->ID) . '"></iframe></div>'),
                            'media_title' => $attachment->post_title,
                            'media_description' => $attachment->post_content,
                            'media_caption' => $attachment->post_excerpt,
                            'media_type' => $attachment->post_mime_type,
                            'class_slide_metadata' => ''
                        ));
                }
                if (
                    (tainacan_has_document() && $attachments && sizeof($attachments) > 0 ) ||
                    (!tainacan_has_document() && $attachments && sizeof($attachments) > 1 )
                ) {
                    if ( tainacan_has_document() ) {
                        $is_document_type_attachment = tainacan_get_the_document_type() === 'attachment';
                        $media_items_thumbs[] =
                            tainacan_get_the_media_component_slide(array(
                                'media_content' => get_the_post_thumbnail(null, 'tainacan-medium'),
                                'media_content_full' => $is_document_type_attachment ? tainacan_get_the_document(0, 'full') : ('<div class="attachment-without-image">' . tainacan_get_the_document(0, 'full') . '</div>'),
                                'media_title' => $is_document_type_attachment ? get_the_title(tainacan_get_the_document_raw()) : '',
                                // 'media_description' => $is_document_type_attachment ? get_the_content(tainacan_get_the_document_raw()) : '',
                                // 'media_caption' => $is_document_type_attachment ? wp_get_attachment_caption(tainacan_get_the_document_raw()) : '',
                                'media_type' => tainacan_get_the_document_type(),
                                'class_slide_metadata' => ''
                            ));

                    }
                    foreach ( $attachments as $attachment ) {
                        $media_items_thumbs[] =
                            tainacan_get_the_media_component_slide(array(
                                'media_content' => wp_get_attachment_image( $attachment->ID, 'tainacan-medium', false ),
                                'media_content_full' => wp_attachment_is('image', $attachment->ID) ? wp_get_attachment_image( $attachment->ID, 'full', false) : ('<div class="attachment-without-image tainacan-embed-container"><iframe id="tainacan-attachment-iframe" src="' . tainacan_get_attachment_html_url($attachment->ID) . '"></iframe></div>'),
                                'media_title' => $attachment->post_title,
                                // 'media_description' => $attachment->post_content,
                                // 'media_caption' => $attachment->post_excerpt,
                                'media_type' => $attachment->post_mime_type,
                                'class_slide_metadata' => ''
                            ));
                    }
                }
                tainacan_the_media_component(
                    'tainacan-item-attachments_id-' . $post->ID,
                    $media_items_thumbs,
                    $media_items_main,
                    array(
                        'class_main_div' => '',
                        'class_thumbs_div' => '',
                        'swiper_thumbs_options' => array(
                            'navigation' => array(
                                'nextEl' => '.swiper-navigation-next_' . 'tainacan-item-attachments_id-' . $post->ID . '-thumbs',
                                'prevEl' => '.swiper-navigation-prev_' . 'tainacan-item-attachments_id-' . $post->ID . '-thumbs',
                            )
                        ),
                        'swiper_main_options' => array(
                            'navigation' => array(
                                'nextEl' => '.swiper-navigation-next_' . 'tainacan-item-attachments_id-' . $post->ID . '-main',
                                'prevEl' => '.swiper-navigation-prev_' . 'tainacan-item-attachments_id-' . $post->ID . '-main',
                            )
                        )
                    )
                );
            ?>
        </section>
    <?php endif; ?>

    <?php
        $pagination = tainacan_get_adjacent_items();
        $previous = $pagination['previous'];
        $next = $pagination['next'];
    ?>
    <nav class="pagination is-centered" role="navigation" aria-label="Navegação entre Itens">
        <?php if (!empty($previous)) : ?>
            <a class="pagination-previous" rel="prev" href="<?php echo $previous['url']; ?>">
                &leftarrow;&nbsp;<?php echo $previous['title']; ?>
                <?php if ($previous['thumbnail']['tainacan-small']) : ?>
                    <img src="<?php echo $previous['thumbnail']['tainacan-small'][0]; ?>" alt="" width="20" height="20" class="ml-1">
                <?php endif; ?>
            </a>
        <?php endif; ?>
        <?php if (!empty($next)) : ?>
            <a class="pagination-next" rel="next" href="<?php echo $next['url']; ?>">
                <?php if ($next['thumbnail']['tainacan-small']) : ?>
                    <img src="<?php echo $next['thumbnail']['tainacan-small'][0]; ?>" alt="" width="20" height="20" class="mr-1">
                <?php endif; ?>
                <?php echo $next['title']; ?>&nbsp;&rightarrow;
            </a>
        <?php endif; ?>
    </nav>

    <?php
        $url = null;
        $args = $_GET;
        if (isset($args['ref'])) {
            $ref = $_GET['ref'];
            unset($args['pos']);
            unset($args['ref']);
            unset($args['source_list']);
            $url = $ref . '?' . http_build_query(array_merge($args));
        } else {
            unset($args['pos']);
            unset($args['ref']);
            unset($args['source_list']);
            $url = tainacan_the_collection_url() . '?' . http_build_query(array_merge($args));
        }
    ?>
    <?php if ($url) : ?>
        <a href="<?php echo $url; ?>"><?php _e('Voltar para a lista de itens', 'ifrs-memoria-theme'); ?></a>
    <?php endif; ?>
</article>

<?php get_footer(); ?>
