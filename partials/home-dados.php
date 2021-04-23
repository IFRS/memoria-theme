<section class="home-dados">
    <div class="container">
        <h2 class="home-dados__titulo"><?php bloginfo('name'); ?> em n&uacute;meros</h2>
        <div class="home-dados__content">
            <article class="dado">
                <p class="dado__numero"><?php echo wp_count_posts( 'registro' )->publish; ?></p>
                <p class="dado__texto">Datas registradas na Linha do Tempo</p>
            </article>
        </div>
    </div>
</section>
