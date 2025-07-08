<?php
/* Custom Fields */

/**
 * Google Maps API
 */
function my_acf_init()
{
    acf_update_setting('google_api_key', 'AIzaSyASxy3VJBPOD2sE3Sc8XmTm7cssWPPm72o');
}

add_action('acf/init', 'my_acf_init');

$menu_slug = sanitize_title(get_bloginfo('name')) . '-settings';

/**
 * Social Media.
 */
$social = array(
    'Facebook' => array(
        'icon' => 'facebook-f',
        'url' => 'https://facebook.com/',
    ),
    'Instagram' => array(
        'icon' => 'instagram',
        'url' => 'https://instagram.com/',
    ),
    'LinkedIn' => array(
        'icon' => 'linkedin-in',
        'url' => 'https://linkedin.com/company/',
    ),
    'Pinterest' => array(
        'icon' => 'pinterest-p',
        'url' => 'https://pinterest.com/',
    ),
    'Twitter' => array(
        'icon' => 'twitter',
        'url' => 'https://twitter.com/',
    ),
    'YouTube' => array(
        'icon' => 'youtube',
        'url' => 'https://www.youtube.com/channel/',
    )
);

function designdough_acf_init() {
    global $menu_slug;
    global $social;

    $args = array(
        'page_title' => get_bloginfo('name') . ' Settings',
        'menu_title' => get_bloginfo('name'),
        'menu_slug' => $menu_slug,
        'position' => -1,
        'icon_url' => false,
    );

    acf_add_options_page($args);

    /**
     * Social media group.
     */
    acf_add_local_field_group(array (
        'key' => 'group_social',
        'title' => 'Social Media',
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => $menu_slug,
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'left',
        'hide_on_screen' => '',
    ));

    foreach ($social as $key => $val) {
        acf_add_local_field(
            array(
                'key' => 'field_' . sanitize_title($key),
                'label' => '<i class="fab fa-' . $val['icon'] . '" style="width:auto;height:16px;display:inline-block;vertical-align:bottom;margin-right:.5em;"></i> ' . $key,
                'placeholder' => $key . ' username',
                'name' => sanitize_title($key),
                'type' => 'text',
                'parent' => 'group_social',
                'prepend' => $val['url'],
            )
        );
    }

    acf_add_local_field(
        array(
            'key' => 'field_instagram_token',
            'label' => '<i class="fab fa-instagram" style="width:auto;height:16px;display:inline-block;vertical-align:bottom;margin-right:.5em;"></i> Instagram Token',
            'placeholder' => 'Instagram Token',
            'name' => sanitize_title('Instagram Token'),
            'type' => 'text',
            'parent' => 'group_social',
        )
    );

    /**
     * Contact details group.
     */
    acf_add_local_field_group(array (
        'key' => 'group_contact',
        'title' => 'Contact Details',
        'fields' => array (
            array(
                'key' => 'field_text',
                'label' => '<i class="fas fa-phone" style="width:20px;height:16px;display:inline-block;vertical-align:bottom;margin-right:.5em;"></i> Address Text',
                'placeholder' => 'Enter your address',
                'name' => 'text',
                'type' => 'wysiwyg', // so we can add line breaks
            ),
            array (
                'key' => 'field_hours',
                'label' => '<i class="fas fa-phone" style="width:20px;height:16px;display:inline-block;vertical-align:bottom;margin-right:.5em;"></i> Openning Hours',
                'placeholder' => 'Your openning hours',
                'name' => 'hours',
                'type' => 'textarea',
            ),
            array (
                'key' => 'field_email',
                'label' => '<i class="far fa-envelope" style="width:20px;height:16px;display:inline-block;vertical-align:bottom;margin-right:.5em;"></i> Email Address',
                'placeholder' => 'Enter your email address',
                'name' => 'email',
                'type' => 'email',
            ),
            array (
                'key' => 'field_tel',
                'label' => '<i class="fas fa-phone" style="width:20px;height:16px;display:inline-block;vertical-align:bottom;margin-right:.5em;"></i> Telephone Number',
                'placeholder' => 'Enter your telephone number',
                'name' => 'tel',
                'type' => 'text',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => $menu_slug,
                ),
            ),
        ),
        'menu_order' => 0,
        'label_placement' => 'left',
    ));

    /* Analytics group.
     
    acf_add_local_field_group(array (
        'key' => 'group_analytics',
        'title' => 'Analytics',
        'fields' => array (
            array (
                'key' => 'field_analytics',
                'label' => '<i class="fas fa-chart-bar" style="width:20px;height:16px;display:inline-block;vertical-align:bottom;margin-right:.5em;"></i> Analytics',
                'placeholder' => 'Enter your Google Analytics tracking code (UA-)',
                'name' => 'analytics',
                'type' => 'text',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => $menu_slug,
                ),
            ),
        ),
        'menu_order' => 0,
        'label_placement' => 'left', ?>
)); */
}

add_action('acf/init', 'designdough_acf_init');