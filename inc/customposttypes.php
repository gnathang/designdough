<?php
/**
 * Custom post types
 *
 * @package WordPress
 * @subpackage designdough
 * @since 1.0
 */

function designdough_custom_post_types()
{
    $post_types = array(
        array(
            'name' => 'Team',
            'singular_name' => 'Employee',
            'menu_icon' => 'businesswoman',
        ),
        array(
            'name' => 'Work',
            'singular_name' => 'Project',
            'menu_icon' => 'portfolio',
        ),
        array(
            'name' => 'Publications',
            'singular_name' => 'Publication',
            'menu_icon' => 'book',
        ),
        array(
            'name' => 'Events',
            'singular_name' => 'Event',
            'menu_icon' => 'hourglass',
        ),
        array(
            'name' => 'Jobs',
            'singular_name' => 'Job',
            'menu_icon' => 'businessman',
        ),
    );


    foreach ($post_types as $post_type) {
        $labels = array(
            'name'               => _x($post_type['name'], 'post type general name', 'designdough'),
            'singular_name'      => _x($post_type['singular_name'], 'post type singular name', 'designdough'),
            'menu_name'          => _x($post_type['name'], 'admin menu', 'designdough'),
            'name_admin_bar'     => _x($post_type['singular_name'], 'add new on admin bar', 'designdough'),
            'add_new'            => _x('Add New', sanitize_title($post_type['singular_name']), 'designdough'),
            'add_new_item'       => __('Add New ' . $post_type['singular_name'], 'designdough'),
            'new_item'           => __('New ' . $post_type['singular_name'], 'designdough'),
            'edit_item'          => __('Edit ' . $post_type['singular_name'], 'designdough'),
            'view_item'          => __('View ' . $post_type['singular_name'], 'designdough'),
            'all_items'          => __('All ' . $post_type['name'], 'designdough'),
            'search_items'       => __('Search ' . $post_type['name'], 'designdough'),
            'parent_item_colon'  => __('Parent ' . $post_type['name'] . ':', 'designdough'),
            'not_found'          => __('No ' . $post_type['name'] . ' found.', 'designdough'),
            'not_found_in_trash' => __('No ' . $post_type['name'] . ' found in Trash.', 'designdough')
        );

        register_post_type(
            sanitize_title($post_type['singular_name']),
            array(
                'labels' => $labels,
                'public' => true,
                'supports' => array( 'title',  'editor', 'custom-fields', 'thumbnail', 'category', 'tags', 'excerpt' ),
                'taxonomies' => array('post_tag', 'category'),
                'has_archive' => false,
                'menu_icon' => 'dashicons-' . $post_type['menu_icon'],
                'rewrite' => array('slug' => sanitize_title($post_type['name'])),
                    'slug'                       => 'type',
                    'with_front'                 => true,
                    'hierarchical'               => true,
            )

        );
    }
}

add_action('init', 'designdough_custom_post_types');