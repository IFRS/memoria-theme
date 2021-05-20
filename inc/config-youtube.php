<?php
if (is_admin()) {
    add_action( 'admin_menu', function() {
        add_submenu_page(
            'options-general.php',
            __('Configurações do Canal do Youtube', 'ifrs-memoria-theme'), // page_title
            __('Configurações do Youtube', 'ifrs-memoria-theme'), // menu_title
            'manage_options', // capability
            'memoria_youtube_settings', // menu_slug
            function() {
                ob_start();
?>
                <div class="wrap">
                    <h2><?php echo get_admin_page_title(); ?></h2>

                    <?php settings_errors(); ?>

                    <form method="POST" action="options.php">
                        <?php
                            settings_fields( 'ifrs_memoria_youtube-default' );
                            do_settings_sections( 'ifrs_memoria_youtube' );
                            submit_button();
                        ?>
                    </form>
                </div>
<?php
                echo ob_get_clean();
            }
        );
    } );

    add_action( 'admin_init', function() {
        add_settings_section(
            'ifrs_memoria_youtube-default', // id
            '', // title
            '__return_false', // callback
            'ifrs_memoria_youtube' // page
        );

        /* Youtube API Key */
        register_setting(
            'ifrs_memoria_youtube-default', // option_group
            'ifrs_memoria_options-youtube_key', // option_name
            array ( // args
                'sanitize_callback' => 'sanitize_text_field',
                'show_in_rest' => false,
                'default' => null,
            )
        );

        $field_id = uniqid('ifrs-memoria-youtube-');
        add_settings_field(
            'ifrs_memoria_options-youtube_key', // id
            __('Chave da API do Youtube', 'ifrs-memoria-theme'), // title
            function() use ($field_id) { // callback
                echo '<input type="text" class="regular-text" id="' . $field_id . '" name="ifrs_memoria_options-youtube_key" value="' . get_option('ifrs_memoria_options-youtube_key', '') . '">';
            },
            'ifrs_memoria_youtube', // page
            'ifrs_memoria_youtube-default', // section
            array(
                'label_for' => $field_id,
            )
        );

        /* Youtube Channel ID */
        register_setting(
            'ifrs_memoria_youtube-default', // option_group
            'ifrs_memoria_options-youtube_channel', // option_name
            array ( // args
                'sanitize_callback' => 'sanitize_text_field',
                'show_in_rest' => false,
                'default' => null,
            )
        );

        $field_id = uniqid('ifrs-memoria-youtube-');
        add_settings_field(
            'ifrs_memoria_options-youtube_channel', // id
            __('ID do Canal do Youtube', 'ifrs-memoria-theme'), // title
            function() use ($field_id) { // callback
                echo '<input type="text" class="regular-text" id="' . $field_id . '" name="ifrs_memoria_options-youtube_channel" value="' . get_option('ifrs_memoria_options-youtube_channel', '') . '">';
            },
            'ifrs_memoria_youtube', // page
            'ifrs_memoria_youtube-default', // section
            array(
                'label_for' => $field_id,
            )
        );
    } );
}
