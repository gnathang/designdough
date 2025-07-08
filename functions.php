<?php

add_theme_support( 'post-thumbnails' );
add_post_type_support( 'page', 'excerpt' );

// register menus
function wpb_custom_new_menu() {
	register_nav_menus(array(
		'main'=> __('Main Menu'),
		'footer'=> __('Footer Menu'),
	));
}
add_action( 'init', 'wpb_custom_new_menu' );

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}

/* Actions and Filters */
add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );
add_filter( 'body_class', function( $classes ) {
	return array_merge( $classes, array( 'class-name' ) );
} );



/* Scripts */
function starkers_script_enqueuer() {

	wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
	wp_enqueue_style( 'screen' );
}


function addnew_query_vars($vars) {
	$vars[] = 'designdough-portfolio'; // c is the name of variable you want to add
	//	$vars[] = 'c'; // c is the name of variable you want to add
	return $vars;
}
add_filter( 'query_vars', 'addnew_query_vars', 10, 1 );


function addnew_query_vars_blogs($vars) {
	$vars[] = 'designdough-blogs'; // c is the name of variable you want to add
	//	$vars[] = 'c'; // c is the name of variable you want to add
	return $vars;
}


add_filter( 'query_vars', 'addnew_query_vars_blogs', 10, 1 );
/* include functions */

require get_parent_theme_file_path('/inc/admincss.php');
// require get_parent_theme_file_path('/inc/comments.php');
require get_parent_theme_file_path('/inc/contactform.php');
require get_parent_theme_file_path('/inc/responsiveimages.php');
require get_parent_theme_file_path('/inc/siteoptions.php');
require get_parent_theme_file_path('/inc/customposttypes.php');
// require get_parent_theme_file_path('/inc/disableadminbar.php');

require get_parent_theme_file_path('/inc/posttonews.php');

require get_parent_theme_file_path('/inc/excerpt-length.php');

//
// format the clock
//
$timezone = new DateTimeZone( 'Europe/London' );
// echo this in UI:
// echo wp_date("d-m-Y H:i:s", null, $timezone );

//
// add svg support
//
function add_file_types_to_uploads($file_types) {
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

//
// new ajax filter
//
function filter_projects() {
	$catSlug = $_POST['category'];
	$postType = $_POST['post_type'];
  
	$ajaxposts = new WP_Query([
	  'post_type' => $postType, // Use the dynamic post type
	  'posts_per_page' => -1,
	  'category_name' => $catSlug,
	  'orderby' => 'date', 
	  'order' => 'DESC',
	  'tag__not_in' => get_term_by('slug', 'archive', 'post_tag')->term_id,
	]);
	$response = '';
  
	if($ajaxposts->have_posts()) {
	  while($ajaxposts->have_posts()) : $ajaxposts->the_post();
		$response .= get_template_part('components/includes/post_template-' . $postType);
		// remove the other category tags on the work page
	  endwhile;
	} else {
	  $response = '<div class="container"><h4>No work to show here.</h4></div>';
	}
  
	echo $response;
	exit;
}
add_action('wp_ajax_filter_projects', 'filter_projects');
add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');

  

// 
// Hide editor for single posts
// 
add_action('init', 'hide_editor_for_single_posts');
function hide_editor_for_single_posts() {
    if (is_single()) {
        $post_id = get_the_ID();
        $post_format = get_field('post_format', $post_id); // Replace 'post_format' with your ACF field name

        // Check the value of the ACF field to determine whether to hide the editor
        if ($post_format == 'flex_post') { // Change 'flex_post' to the desired value
            remove_post_type_support('post', 'editor');
        }
    }
}

// // for the CPT 'reserving' its post type name for its URL
// function custom_work_archive_redirect() {
//     if (is_post_type_archive('work') && is_main_query()) {
//         $template = get_page_template_slug();
//         if ($template === 'page-archive_filter.php') {
//             status_header(200);
// 			include(get_stylesheet_directory() . '/page-archive_filter.php');
//         	exit;
//         }
//     }
// }
// add_action('template_redirect', 'custom_work_archive_redirect');