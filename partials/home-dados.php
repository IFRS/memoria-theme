<?php
    $youtube_key = get_option('ifrs_memoria_options-youtube_key', false);
    $youtube_channel = get_option('ifrs_memoria_options-youtube_channel', false);

    if ($youtube_key && $youtube_channel) {
        $youtube_statistics = get_transient( 'ifrs_memoria_youtube-statistics' );

        if ($youtube_statistics === false) {
            $response = wp_remote_get('https://www.googleapis.com/youtube/v3/channels?key='.$youtube_key.'&id='.$youtube_channel.'&part=statistics');

            if ( ! is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
                $data = wp_remote_retrieve_body($response);
                $youtube = json_decode($data);
                $youtube_statistics = $youtube->items[0]->statistics;
                set_transient( 'ifrs_memoria_youtube-statistics', $youtube_statistics, 3 * DAY_IN_SECONDS );
            }
        }

        $videos = $youtube_statistics->videoCount;
    }
?>

<section class="section home-dados">
    <div class="container">
        <h2 class="home-dados__titulo"><?php bloginfo('name'); ?> em n&uacute;meros</h2>
        <div class="columns">
            <article class="column">
                <?php $registros = wp_count_posts( 'registro' )->publish ?? 0; ?>
                <p class="dado__numero"><?php echo $registros; ?></p>
                <p class="dado__texto"><?php echo _n('Data registrada', 'Datas registradas', $registros, 'ifrs-memoria-theme'); ?> na Linha do Tempo</p>
            </article>

            <article class="column">
                <?php $colecoes = wp_count_posts( 'tainacan-collection' )->publish ?? 0; ?>
                <p class="dado__numero"><?php echo $colecoes; ?></p>
                <p class="dado__texto"><?php echo _n('Coleção', 'Coleções', $colecoes, 'ifrs-memoria-theme'); ?> no Acervo</p>
            </article>

            <?php
                $collections = new WP_Query(array(
                    'post_type'      => 'tainacan-collection',
                    'nopaging'       => true,
                    'posts_per_page' => -1,
                    'fields'         => 'ids',
                ));

                $total = 0;

                while ($collections->have_posts()) {
                    $collections->the_post();
                    $posts = wp_count_posts( 'tnc_col_' . get_the_ID() . '_item' );
                    $total += $posts->publish ?? 0;
                }

                wp_reset_postdata();
            ?>
            <article class="column">
                <p class="dado__numero"><?php echo $total; ?></p>
                <p class="dado__texto"><?php echo _n('Item', 'Itens', $total, 'ifrs-memoria-theme'); ?> inseridos nas Cole&ccedil;&otilde;es</p>
            </article>

            <?php if (!empty($videos)) : ?>
                <article class="column">
                    <p class="dado__numero"><?php echo $videos; ?></p>
                    <p class="dado__texto"><?php echo _n('Vídeo', 'Vídeos', $videos, 'ifrs-memoria-theme'); ?> publicados no YouTube</p>
                </article>
            <?php endif; ?>
        </div>
    </div>
</section>
