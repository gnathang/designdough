<?php
function flexes_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( isset( $_GET['settings-updated'] ) ) {
        add_settings_error(
            'flex_settings_mesages',
            'flex_settings_message',
            esc_html__( 'Settings Saved', 'text_domain' ),
            'updated'
        );
    }

    settings_errors( 'flex_settings_mesages' );

    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'flex_settings_group' );
            do_settings_sections( 'flex_settings' );
            //submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}

/**
 * Register our settings.
 */
function flex_settings_register_settings() {
    register_setting( 'flex_settings_group', 'flex_settings' );

    add_settings_section(
        'flex_settings_sections',
        false,
        false,
        'flex_settings'
    );

    add_settings_field (
        'my_option_1',
        esc_html__( 'Field 1: ', 'text_domain' ),
        'render_flex_field_1',
        'flex_settings',
        'flex_settings_sections',
        [
            'label_for' => 'my_option_1',
        ]
    );
//    add_settings_field (
//        'my_option_2',
//        esc_html__( 'My Option 2', 'text_domain' ),
//        'render_my_option_2_field',
//        'flex_settings',
//        'flex_settings_sections',
//        [
//            'label_for' => 'my_option_2',
//        ]
//    );
}
add_action( 'admin_init', 'flex_settings_register_settings' );
//
//
/**
 * Render the "my_option_1" field.
 */
function render_flex_field_1( $args ) {
    $value = get_option( 'flex_settings' )[$args['label_for']] ?? '';


    $options = array();

    $field_groups = acf_get_field_groups();
    foreach ( $field_groups as $group ) {
        // DO NOT USE here: $fields = acf_get_fields($group['key']);
        // because it causes repeater field bugs and returns "trashed" fields
        $fields = get_posts(array(
            'posts_per_page'   => -1,
            'post_type'        => 'acf-field',
            'orderby'          => 'menu_order',
            'order'            => 'ASC',
            'suppress_filters' => true, // DO NOT allow WPML to modify the query
            'post_parent'      => $group['ID'],
            'post_status'      => 'any',
            'update_post_meta_cache' => false
        ));
        foreach ( $fields as $field ) {
            echo $options[$field->post_name] = $field->post_title;
            echo '<br>';
        }
    }
    echo '<br><br>';

    echo count($options);
    echo '<br><br>';


    var_dump(acf_get_field_group(8));

















//    ?>
<!--    <input-->
<!--        type="text"-->
<!--        id="--><?php //echo esc_attr( $args['label_for'] ); ?><!--"-->
<!--        name="flex_settings[--><?php //echo esc_attr( $args['label_for'] ); ?><!--]"-->
<!--        value="--><?php //echo esc_attr( $value ); ?><!--">-->
<!--    <p class="description">--><?php //esc_html_e( 'This is a description for our field.', 'text_domain' ); ?><!--</p>-->
<!--    --><?php
}
//
//function render_my_option_2_field( $args ) {
//    $value = get_option( 'flex_settings' )[$args['label_for']] ?? '';
//    ?>
<!--    <input-->
<!--        type="text"-->
<!--        id="--><?php //echo esc_attr( $args['label_for'] ); ?><!--"-->
<!--        name="flex_settings[--><?php //echo esc_attr( $args['label_for'] ); ?><!--]"-->
<!--        value="--><?php //echo esc_attr( $value ); ?><!--">-->
<!--    <p class="description">--><?php //esc_html_e( 'This is a description for our field.', 'text_domain' ); ?><!--</p>-->
<!--    --><?php
//}


