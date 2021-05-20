            <a href="#fim-conteudo" id="fim-conteudo" class="sr-only">Fim do conte&uacute;do</a>
        </section>
    </main>

    <?php if (is_front_page()) get_template_part('partials/home-dados'); ?>

    <footer class="footer">
        <div class="container">
            <div class="columns is-align-items-center">
                <div class="column has-text-centered">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/rodape-numem.png" alt="<?php bloginfo('name'); ?>" class="mr-3 mb-3"/>
                    <a href="https://ifrs.edu.br/" class="is-inline-block" data-toggle="tooltip" data-placement="top" title="Portal do IFRS">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/rodape-ifrs.png" alt="Portal do IFRS"/>
                    </a>
                </div>
                <?php if (is_active_sidebar('sidebar-rodape')) : ?>
                <div class="column is-4-tablet is-3-widescreen">
                    <?php dynamic_sidebar('sidebar-rodape'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="columns is-align-items-center">
                <div class="column creditos">
                    <!-- Wordpress -->
                    <a href="http://br.wordpress.org/" target="_blank" rel="noopener" data-toggle="tooltip" data-placement="top" title="Desenvolvido com Wordpress">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/creditos-wordpress.png" alt="Desenvolvido com Wordpress (abre uma nova p&aacute;gina)"/>
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" aria-hidden="true"><path d="M0 0v8h8v-2h-1v1h-6v-6h1v-1h-2zm4 0l1.5 1.5-2.5 2.5 1 1 2.5-2.5 1.5 1.5v-4h-4z" /></svg>
                    </a>
                    &mdash;
                    <!-- Git -->
                    <a href="https://github.com/IFRS/memoria-theme/" target="_blank" rel="noopener" data-toggle="tooltip" data-placement="top" title="C&oacute;digo-fonte deste tema sob a licen&ccedil;a GPLv3">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/creditos-git.png" alt="C&oacute;digo-fonte deste tema sob a licen&ccedil;a GPLv3 (abre uma nova p&aacute;gina)"/>
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" aria-hidden="true"><path d="M0 0v8h8v-2h-1v1h-6v-6h1v-1h-2zm4 0l1.5 1.5-2.5 2.5 1 1 2.5-2.5 1.5 1.5v-4h-4z" /></svg>
                    </a>
                    &mdash;
                    <!-- Creative Commons -->
                    <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank" rel="noopener" data-toggle="tooltip" data-placement="top" title="M&iacute;dia licenciada sob a Licen&ccedil;a Creative Commons Atribui&ccedil;&atilde;o-N&atilde;oComercial-CompartilhaIgual 4.0 Internacional">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/creditos-cc-by-nc-sa.png" alt="M&iacute;dia licenciada sob a Licen&ccedil;a Creative Commons Atribui&ccedil;&atilde;o-N&atilde;oComercial-CompartilhaIgual 4.0 Internacional (abre uma nova p&aacute;gina)"/>
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" aria-hidden="true"><path d="M0 0v8h8v-2h-1v1h-6v-6h1v-1h-2zm4 0l1.5 1.5-2.5 2.5 1 1 2.5-2.5 1.5 1.5v-4h-4z" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <?php get_template_part('partials/vlibras'); ?>

    <?php wp_footer(); ?>
</body>
</html>
