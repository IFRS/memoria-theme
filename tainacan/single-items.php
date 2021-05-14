<?php get_header(); ?>

<?php the_post(); ?>

<article id="post-<?php the_ID()?>" <?php post_class()?>>
    <div class="media is-align-items-center mb-3">
        <div class="media-left">
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
        <h2><?php the_title(); ?></h2>

        <?php if (has_post_thumbnail()) : ?>
            <figure class="image is-pulled-left m-0 mr-3 mb-3">
                <?php the_post_thumbnail('medium'); ?>
            </figure>
        <?php endif; ?>

        <section class="tainacan-metadata">
            <?php
                tainacan_the_metadata( array(
                    'before_title'  => '<h3 class="tainacan-metadata__title">',
                    'after_title'   => '</h3>',
                    'before_value'  => '<p class="tainacan-metadata__value">',
                    'after_value'   => '</p>',
                    'exclude_title' => false,
                ) );
            ?>
        </section>

        <?php if ( tainacan_has_document() ) : ?>
            <section class="tainacan-documents">
                <h3>Documentos</h3>
                <?php
                    tainacan_the_document();
                    if ( function_exists('tainacan_the_item_document_download_link') && tainacan_the_item_document_download_link() != '' ) {
                        echo tainacan_the_item_document_download_link();
                    }
                ?>
            </section>
        <?php endif; ?>

        <?php
            if (function_exists('tainacan_get_the_attachments')) {
                $attachments = tainacan_get_the_attachments();
            } else {
                // compatibility with pre 0.11 tainacan plugin
                $attachments = array_values(
                    get_children(
                        array(
                            'post_parent'    => $post->ID,
                            'post_type'      => 'attachment',
                            'post_mime_type' => 'image',
                            'order'          => 'ASC',
                            'numberposts'    => -1,
                        )
                    )
                );
            }
        ?>
        <?php if ( !empty( $attachments ) || tainacan_has_document() ) : ?>
            <section class="tainacan-attachments">
                <h3>Anexos</h3>
                <?php foreach ( $attachments as $attachment ) : ?>
                    <div class="tainacan-attachments__item">
                        <?php
                        if ( function_exists('tainacan_get_attachment_html_url') ) {
                            $href = tainacan_get_attachment_html_url($attachment->ID);
                        } else {
                            $href = wp_get_attachment_url($attachment->ID, 'large');
                        }
                        ?>
                        <a
                            class="<?php if (!wp_get_attachment_image( $attachment->ID, 'tainacan-interface-item-attachments')) echo 'attachment-without-image'; ?>"
                            href="<?php echo $href; ?>">
                            <?php
                                echo wp_get_attachment_image( $attachment->ID, 'post-thumbnail', true, array('class' => 'float-left mr-1') );
                                echo '<br>';
                            ?>
                            <span><?php echo get_the_title( $attachment->ID ); ?></span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    </div>
</article>

<?php get_footer(); ?>
