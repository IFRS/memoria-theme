    <a href="#fim-conteudo" id="fim-conteudo" class="sr-only">Fim do conte&uacute;do</a>

    </main>

    <footer class="footer">
        <div class="container">
            <div class="row align-items-center mb-3">
                <div class="col-12 col-sm-6 col-lg-8">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/rodape-numem.png" alt="<?php bloginfo('name'); ?>" class="img-fluid footer__numem"/>
                    <a href="https://ifrs.edu.br/" class="footer__ifrs-link" title="Portal do IFRS">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/rodape-ifrs.png" alt="Portal do IFRS" class="img-fluid"/>
                    </a>
                </div>
                <?php if (is_active_sidebar('sidebar-rodape')) : ?>
                <div class="col-12 col-sm-6 col-lg-4">
                    <?php dynamic_sidebar('sidebar-rodape'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-12 creditos">
                    <!-- Wordpress -->
                    <a href="http://br.wordpress.org/" target="_blank" rel="noopener">Desenvolvido com Wordpress<span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></a> <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" aria-hidden="true"><path d="M0 0v8h8v-2h-1v1h-6v-6h1v-1h-2zm4 0l1.5 1.5-2.5 2.5 1 1 2.5-2.5 1.5 1.5v-4h-4z" /></svg>
                    &mdash;
                    <!-- Git -->
                    <a href="https://github.com/IFRS/memoria-theme/" target="_blank" rel="noopener">C&oacute;digo-fonte deste tema sob a licen&ccedil;a GPLv3<span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></a> <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" aria-hidden="true"><path d="M0 0v8h8v-2h-1v1h-6v-6h1v-1h-2zm4 0l1.5 1.5-2.5 2.5 1 1 2.5-2.5 1.5 1.5v-4h-4z" /></svg>
                    &mdash;
                    <!-- Creative Commons -->
                    <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank" rel="noopener"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cc-by-nc-nd.png" alt="M&iacute;dia licenciada sob a Licen&ccedil;a Creative Commons Atribui&ccedil;&atilde;o-N&atilde;oComercial-SemDeriva&ccedil;&otilde;es 4.0 Internacional (abre uma nova p&aacute;gina)" /></a> <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" aria-hidden="true"><path d="M0 0v8h8v-2h-1v1h-6v-6h1v-1h-2zm4 0l1.5 1.5-2.5 2.5 1 1 2.5-2.5 1.5 1.5v-4h-4z" /></svg>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>

</body>
</html>
