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
        </div>
    </div>
</section>
