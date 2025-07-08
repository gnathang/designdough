<?php
function my_settings_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( isset( $_GET['settings-updated'] ) ) {
        add_settings_error(
            'my_settings_mesages',
            'my_settings_message',
            esc_html__( 'Settings Saved', 'text_domain' ),
            'updated'
        );
    }

    settings_errors( 'my_settings_mesages' );

    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'my_settings_group' );
            do_settings_sections( 'my_settings' );
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}

/**
 * Register our settings.
 */
function myprefix_register_settings() {
    register_setting( 'my_settings_group', 'my_settings' );

    add_settings_section(
        'my_settings_sections',
        false,
        false,
        'my_settings'
    );

    add_settings_field (
        'my_option_1',
        esc_html__( 'WP Admin Colour', 'text_domain' ),
        'render_my_option_1_field',
        'my_settings',
        'my_settings_sections',
        [
            'label_for' => 'my_option_1',
        ]
    );
    add_settings_field (
        'my_option_2',
        esc_html__( 'My Option 2', 'text_domain' ),
        'render_my_option_2_field',
        'my_settings',
        'my_settings_sections',
        [
            'label_for' => 'my_option_2',
        ]
    );
}
add_action( 'admin_init', 'myprefix_register_settings' );


/**
 * Render the "my_option_1" field.
 */
function render_my_option_1_field( $args ) {
    $value = get_option( 'my_settings' )[$args['label_for']] ?? '';
    ?>#
    <input
        type="text"
        id="<?php echo esc_attr( $args['label_for'] ); ?>"
        name="my_settings[<?php echo esc_attr( $args['label_for'] ); ?>]"
        value="<?php echo esc_attr( $value ); ?>">
    <style>
        #wpadminbar { background: <?php echo '#' . esc_attr( $value ); ?>}
        #adminmenuwrap { background: <?php echo '#' . esc_attr( $value ); ?>}
        #adminmenu { background: <?php echo '#' . esc_attr( $value ); ?>}
    </style>
<!--    <p class="description">--><?php //esc_html_e( 'This is a description for our field.', 'text_domain' ); ?><!--</p>-->
    <?php


}

function render_my_option_2_field( $args ) {
    $value = get_option( 'my_settings' )[$args['label_for']] ?? '';
    ?>
    <input
        type="text"
        id="<?php echo esc_attr( $args['label_for'] ); ?>"
        name="my_settings[<?php echo esc_attr( $args['label_for'] ); ?>]"
        value="<?php echo esc_attr( $value ); ?>">
<!--    <p class="description">--><?php //esc_html_e( 'This is a description for our field.', 'text_domain' ); ?><!--</p>-->
    <?php
}

