                <a href="#fim-conteudo" id="fim-conteudo" class="sr-only">Fim do conte&uacute;do</a>
            </div> <!-- /.col -->

            <?php if (!is_post_type_archive( 'registro' ) && !is_tax('unidade') && !is_front_page() && !is_home()) : ?>
                <div class="col-12 col-md-1">
                    <div class="h-100 d-flex flex-wrap">
                        <hr class="align-self-start d-none d-md-block back-top__bar">
                        <a href="#inicio-conteudo" class="align-self-end back-top__link">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8">
                                <path d="M4 0l-4 4 1.5 1.5 2.5-2.5 2.5 2.5 1.5-1.5-4-4z" transform="translate(0 1)" />
                            </svg>
                            <span class="sr-only">Voltar para o topo</span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->

    <?php wp_footer(); ?>

</body>
</html>
