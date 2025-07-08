<?php /* Responsive Images */


	function build_post_response($args)
	{
	    // if arguments have been passed
	    if ($args) {

	        // set up a new WP_Query instance with our arguments
	        $query = new WP_Query($args);

	        // get the posts for the query
	        $posts = $query->posts;

	        // if there are posts
	        if ($posts) {
	            // for each post
	            foreach ($posts as $post) {
	                //post object is our main item
	                $item = $post;

	                // get all metadata
	                $allMetadata = get_metadata('post', $post->ID);

	                // filter out metadata that starts with '_'
	                $noUnderscoreMetadata = array_filter($allMetadata, "leading_underscore", ARRAY_FILTER_USE_KEY);

	                // unserialise serialised values
	                $unserialisedMetadata = wordpress_unserialise($noUnderscoreMetadata);
	                $item->metadata = $unserialisedMetadata;

	                // render the data as Wordpress does
	                $item->post_content_rendered = apply_filters('the_content', $post->post_content);

	                // people tend not to actually use the excerpt, so let's set up a fallback one
	                // trim the content to 25 words
	                // it would be great to be able to use the one set in the theme but apparently that's not an option

	                $item->post_excerpt_fallback = wp_trim_words($post->post_content, 25);

	                // add the permalink
	                $item->permalink = get_the_permalink($post);

	                // add the featured image
	                $featuredImage = get_post_thumbnail_id($post);

	                if ($featuredImage > '') {
	                    // create an array to add multiple image values
	                    $item->featured_image = array();

	                    // add the featured image ID
	                    $item->featured_image['id'] = $featuredImage;

	                    // add the alt tag
	                    $imageAlt = get_post_meta($featuredImage, '_wp_attachment_image_alt', true);

	                    // if there's an alt
	                    if ($imageAlt) {
	                        // use the alt
	                        $item->featured_image['alt'] = $imageAlt;
	                    } else {
	                        // otherwise, use the post title
	                        $item->featured_image['alt'] = $post->post_title;
	                    }

	                    // create an empty array for the sources
	                    $item->featured_image['src'] = array();

	                    $imageSizes = get_intermediate_image_sizes();

	                    // for each image size
	                    foreach ($imageSizes as $imageSize) {
	                        $imageURL = wp_get_attachment_image_src($featuredImage, $imageSize);
	                        $item->featured_image['src'][$imageSize] = $imageURL[0];
	                    }

	                    $imgArgs = array(
	                        'alt' => $item->featured_image['alt'],
	                        'id' => $item->featured_image['id'],
	                        'class' => 'w-full'
	                    );

	                    $item->srcsetList = build_srcset('squareList', $imgArgs);
	                    $item->srcsetStory = build_srcset('squareStory', $imgArgs);
	                }

	                // add the item object to our array of items
	                $items['posts'][] = $item;
	            }
	        } else {
	            // return an error
	            $items['error'] = 'No response available';
	        }

	        // include the arguments in our response
	        $items['args'] = $args;
	        return $items;
	    } else {
	        // return an error
	        return 'Error: no arguments received';
	    }
	}


	/** Responsive images **/
	function responsive_options($wp_customize)
	{
	    // responsive images area
	    $wp_customize->add_panel('responsive_section', array(
	        'title'    => __('Responsive images', 'designdough')
	    ));

	    // the name of the element (i.e agg, aggLarge, aggSidebar, matchReport)
	    $wp_customize->add_section('imagenames_section', array(
	        'title'    => __('Image sizes', 'designdough'),
	        'description' => 'Define the Wordpress image sizes for this project. You have to refresh before the dimensions and sizes fields update. Sorry about that.',
	        'panel' => 'responsive_section'
	    ));

	    // the dimensions of the image at each viewport
	    $wp_customize->add_section('imagedimensions_section', array(
	        'title'    => __('Image dimensions', 'designdough'),
	        'description' => 'Define the image dimensions for each image size and viewport. Use the format "[width]x[height]" 1500px is the default and is required. All others are not required',
	        'panel' => 'responsive_section'
	    ));

	    // the 'sizes=""' value that should be returned by the srcset
	    $wp_customize->add_section('imagesizes_section', array(
	        'title'    => __('Image sizes attribute', 'designdough'),
	        'description' => 'Define the sizes attribute for the srcset',
	        'panel' => 'responsive_section'
	    ));

	    $wp_customize->add_setting('imagesizes');

	    $wp_customize->add_control(
	        new WP_Customize_Control(
	            $wp_customize,
	            'imagesizes',
	            array(
	                'label'     => __('Image sizes', 'designdough'),
	                'section'   => 'imagenames_section',
	                'description' => __('Comma separated list of image sizes for this project (e.g. banner,index,searchResult)', 'designdough'),
	                'settings'  => 'imagesizes',
	                'type'      => 'text'
	            )
	        )
	    );

	    // get a list of the defined image sizes and explode it on a comma
	    $imagesizesMod = get_theme_mod('imagesizes');
	    $imagesizes = explode(',', $imagesizesMod);

	    // these are the pixel values where the image is likely to change. They will usually stay constant beyond 1500. This is used as our default image size
	    $breakpoints = ['load', '414', '767', '1039', '1232', '1366', '1500', '1920'];

	    foreach ($imagesizes as $img) {
	        $img = trim($img);

	        $wp_customize->add_setting('imagesizes_'.$img);

	        $wp_customize->add_control(
	            new WP_Customize_Control(
	                $wp_customize,
	                'imagesizes_'.$img,
	                array(
	                    'label'     => __($img, 'designdough'),
	                    'section'   => 'imagesizes_section',
	                    'settings'  => 'imagesizes_'.$img,
	                    'type'      => 'text'
	                )
	            )
	        );

	        $wp_customize->add_setting('imagecrop_'.$img, [
	            'default'	=> '1'
	        ]);

	        $wp_customize->add_control(
	            new WP_Customize_Control(
	                $wp_customize,
	                'imagecrop_'.$img,
	                array(
	                    'label'     => __('Enable cropping for '.$img, 'designdough'),
	                    'section'   => 'imagesizes_section',
	                    'settings'  => 'imagecrop_'.$img,
	                    'type'      => 'checkbox'
	                )
	            )
	        );

	        foreach ($breakpoints as $breakpoint) {
	            $wp_customize->add_setting('imagedimensions_'.$img.'-'.$breakpoint);

	            $wp_customize->add_control(
	                new WP_Customize_Control(
	                    $wp_customize,
	                    'imagedimensions_'.$img.'-'.$breakpoint,
	                    array(
	                        'label'     => __($img.' - '.$breakpoint.'px screen width', 'designdough'),
	                        'section'   => 'imagedimensions_section',
	                        'settings'  => 'imagedimensions_'.$img.'-'.$breakpoint,
	                        'type'      => 'text'
	                    )
	                )
	            );
	        }
	    }
	}

	add_action('customize_register', 'responsive_options');


	/**
	 * Add custom image sizes attribute to enhance responsive image functionality
	 * for content images.
	 *
	 * @since designdough 1.0
	 *
	 * @param string $sizes A source size value for use in a 'sizes' attribute.
	 * @param array  $size  Image size. Accepts an array of width and height
	 *                      values in pixels (in that order).
	 * @return string A source size value for use in a content image 'sizes' attribute.
	 */
	function designdough_content_image_sizes_attr($sizes, $size)
	{
	    $width = $size[0];
	    740 <= $width && $sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	    if (is_active_sidebar('sidebar-1') || is_archive() || is_search() || is_home() || is_page()) {
	        if (! (is_page() && 'one-column' === get_theme_mod('page_options'))) {
	            767 <= $width && $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	        }
	    }
	    return $sizes;
	}
	add_filter('wp_calculate_image_sizes', 'designdough_content_image_sizes_attr', 10, 2);


	/**
	 * Add custom image sizes attribute to enhance responsive image functionality
	 * for post thumbnails.
	 *
	 * @since designdough 1.0
	 *
	 * @param array $attr       Attributes for the image markup.
	 * @param int   $attachment Image attachment ID.
	 * @param array $size       Registered image size or flat array of height and width dimensions.
	 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
	 */
	function designdough_post_thumbnail_sizes_attr($attr, $attachment, $size)
	{
	    if (is_archive() || is_search() || is_home()) {
	        $attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	    } else {
	        $attr['sizes'] = '100vw';
	    }
	    return $attr;
	}

	add_filter('wp_get_attachment_image_attributes', 'designdough_post_thumbnail_sizes_attr', 10, 3);


	/*
	* register_featured_img()
	*
	* Registers the featured images and the image sizes per viewport
	*/
	function register_featured_img() {
	    add_theme_support("post-thumbnails");

	    $breakpoints = ['load', '414', '767', '1039', '1232', '1366', '1500', '1920'];

	    //get the theme mod for image sizes
	    $imagesizesMod = get_theme_mod("imagesizes");
	    $imagesizes = explode(",", $imagesizesMod);

	    foreach ($imagesizes as $imagesize) {
	        $imagesize = trim($imagesize);

	        foreach ($breakpoints as $breakpoint) {
	            $imagename = $imagesize."-".$breakpoint;

	            $imagedimension = get_theme_mod("imagedimensions_".$imagename);
	            $imagecrop = get_theme_mod('imagecrop_'.$imagesize, true);

	            if ($imagecrop == '1') {
	                $imagecrop = true;
	            } elseif ($imagecrop == '0') {
	                $imagecrop = false;
	            }

	            if ($imagedimension > "") {
	                $imagexy = explode("x", $imagedimension);

	                //the theme mod does have "1500" at the end but the file name doesn"t
	                //this is so we can use build_srcset("imageSize");
	                if ($breakpoint == "1500") {
	                    $imagename = $imagesize;
	                }

	                add_image_size( $imagename, trim($imagexy[0]), trim($imagexy[1]), $imagecrop );
	            }
	        }
	    }
	}
	add_action('init', 'register_featured_img');


	/**
	* build_srcset
	*
	* This function returns a srcset for a given WP image size. The srcset will be used to serve responsive images to the user.
	* This function also returns an initial small image, to be swapped out via a lazyload
	*
	* KB article - https://admin.sotic.net/wiki/index.php/Responsive_images
	* Reference: https://cloudfour.com/thinks/responsive-images-101-definitions/
	* (especially the bit about sizes: https://cloudfour.com/thinks/responsive-images-101-part-5-sizes/ )
	*
	* @param - $imageSize      string      required    the name given to the Wordpress image size we are using. Defined in Customiser
	* @param - $args           array       optional

	* valid arguments
	*   id                   integer     Wordpress ID for the image you wish to display (not the post ID)
	*   alt                  text        description of the image for screen readers
	*   title                text        ???
	*   class                text        custom classes to be APPENDED to the existing Wordpress image classes (this will not replace or remove existing classes)
	*   lazyload             bool        switch image lazyloading on or off
	*
	* defaults
	*   id                   the featured image of the post, or the defined fallback image if no featured image is set
	*   alt                  the alt text associated with the image via Wordpress
	*   title                the title tag associated with the image via Wordpress
	*   class                none
	*   lazyload             true
	**/

	function build_srcset($imageSize, $args = []) {
	    global $post;

	    $defaultSettings['id'] = null;
	    $defaultSettings['alt'] = null;
	    $defaultSettings['title'] = null;
	    $defaultSettings['class'] = null;
	    $defaultSettings['lazyload'] = false;

	    // merge the $args
	    // $args as the second value here means it overrides any existing values in $defaultSettings
	    $settings = array_merge($defaultSettings, $args);

	    // the name given to the smallest breakpoint, which we use for loading tiny images
	    // remember: images that have not been lazyloaded have the class 'unloaded'
	    // this can be used to make small, unloaded images fit the container they belong to, blur them and other cool stuff
	    $initial_suffix = "-load";

	    // set up the empty initial image variable to insert into the finished image tag
	    $image['initial'] = '';

	    // set up the main image to use

	    // if we have not been given an image to use
	    if ($settings['id'] == NULL) {
	        // if our $post exists
	        if (is_object ($post) ) {

	            //if we're using lazyload, get the initial image at the initial image size
	            if ($settings['lazyload']) {
	                $image['initial'] = get_the_post_thumbnail_url($post->ID, $imageSize.$initial_suffix);
	            }

	            // get the full image
	            $image['main'] = get_the_post_thumbnail_url($post->ID, $imageSize);

	            // set the ID using the Wordpress value
	            $settings['id'] = get_post_thumbnail_id($post->ID);
	        }

	        if ($settings['id']) {
	            $alt_text = get_post_meta($settings['id'], "_wp_attachment_image_alt", true);
	        } else {
	            // set up a fallback image if the fallback image hasn't been set in Customiser
	            // a fallback for the fallback, if you will
	            $imgMainSrc = get_template_directory_uri().'/assets/img/fallback.png';

	            // get the Customiser fallback
	            $fallbackStr = get_theme_mod('sotic_fallback_image');

	            // if the Customiser fallback exists
	            if ($fallbackStr > '') {
	                // set the ID to that of the fallback image
	                $settings['id'] = attachment_url_to_postid($fallbackStr);

	                // set the main image to be the fallback
	                $image['main'] = $fallbackStr;
	            }
	        }
	    // if we are using a specific image passed to this function
	    } else {
	        // get the full URL for the smallest image
	        $imgInitial = wp_get_attachment_image_src($settings['id'], $imageSize.$initial_suffix);

	        // that returns as an array so...
	        $image['initial'] = $imgInitial[0];

	        // get the full URL of the main image
	        $imgMainSrc = wp_get_attachment_image_src($settings['id'], $imageSize);

	        // this again
	        $image['main'] = $imgMainSrc[0];

	        // if we don't already have a title
	        if ($settings['title'] === null) {
	            // use the title set in Wordpress
	            $settings['title'] = get_the_title($settings['id']);
	        }

	        // if we don't already have an alt
	        if ($settings['alt'] === null) {
	            // use the alt set in Wordpress
	            $settings['alt'] = get_post_meta( $settings['id'], '_wp_attachment_image_alt', true);
	        }
	    }

	    // if we still don't have an alt tag
	    if ( ($settings['alt'] == null) && ( is_object($post) ) ) {
	        // use the post title
	        $settings['alt'] = get_the_title($post->ID);
	    }

	    // get the 'sizes' attribute for this image size from Customiser
	    $sizeLoopup = get_theme_mod("imagesizes_".$imageSize);

	    // if it has been set
	    if ($sizeLoopup > "") {
	        // create the attribute
	        $sizes = 'sizes="'.$sizeLoopup.'"';
	    } else {
	        // if not, set it to '100vw'
	        $sizes = 'sizes="100vw"';
	    }

	    // get the registered Wordpress image sizes
	    $img_sizes = get_intermediate_image_sizes();

	    // reduce the list to just the ones in the image size passed to this function
	    // this will give us the Wordpress name for the image size at each breakpoint
	    $img_variants = preg_grep("~" . $imageSize . "~", $img_sizes);

	    // default blank string for the srcset value
	    $srcset = '';

	    // if this returned anything (and it really, really should)
	    if ($img_variants > 0) {
	        // set up a container for our image URLs
	        $srcsetArr = [];

	        // for each breakpoint
	        foreach($img_variants as $variant) {
	            $imgWidth = null;

	            // if we are using the featured image
	            if ($settings['id'] == NULL) {
	                // get the full metadata for the image
	                $imgData = wp_get_attachment_metadata(get_post_thumbnail_id());

	                // get the URL for this image
	                $imgToUse = esc_url(get_the_post_thumbnail_url($post->ID, $variant));
	            // if we are using an image passed to us
	            } else {
	                // get the full metadata for the image
	                $imgData = wp_get_attachment_metadata($settings['id']);

	                // get the URL for this image
	                $imgTemp = wp_get_attachment_image_src($settings['id'], $variant);

	                // this one returned an array too
	                $imgToUse = esc_url($imgTemp[0]);
	            }

	            // if we have image meta data (it would take a real disaster not to have it...)
	            if ( is_array($imgData) ) {
	                // if our image has a thumbnail generated for this breakpoint

	                if ( array_key_exists($variant, $imgData["sizes"]) ) {
	                    // and if it's wider than 0
	                    if ($imgData["sizes"][$variant]["width"] > 0) {

	                        // get the width of the image
	                        $imgWidth = $imgData["sizes"][$variant]["width"];
	                    }
	                } else {
	                    // get the width of the main image

	                    // if there are no sizes for the image
	                    if (array_key_exists('width', $imgData)) {
	                        // use the source image width
	                        $imgWidth = $imgData["width"];
	                    } else {
	                        // use the width of the 'large' image
	                        $imgWidth = $imgData["sizes"]["large"]["width"];
	                    }
	                }
	            }

	            // if this image has a width
	            if ($imgWidth) {
	                // add it to our list of images to use
	                // and add the width folllowed by 'w'
	                // this tells a browser that supports responsive images how wide the image is
	                $srcsetArr[] = $imgToUse . " " . $imgWidth . "w";
	            }
	        }

	        // if we have any images
	        if ( count($srcsetArr) ) {
	            // create a srcset attribute
	            $srcset = "srcset='".implode(", ", $srcsetArr)."'";

	            // if lazyload is enabled
	            if ($settings['lazyload']) {
	                // slap 'data-' at the front, so we don't load the responsive images on initial load
	                $srcset = 'data-'.$srcset;
	            }
	        }
	    }

	    // build the string to return
	    $imgString = '<img ';

	    // if we're using lazyload
	    if ($settings['lazyload']) {
	        // check if we have an initial image
	        // two equals signs because it could be null, 0 or false
	        if ($image['initial'] == null) {
	            // use the main image if we don't
	            $image['initial'] = $image['main'];
	        }

	        $imgString .= 'src="' . $image['initial'] . '" data-src="' . $image['main'] . '" ';
	    } else {
	        $imgString .= 'src="' . $image['main'] . '" ';
	    }

	    // for the attribute tags
	    $loopAtt = ['title', 'alt'];

	    // loop through them
	    foreach($loopAtt as $att) {
	        // if they have been
	        if ($settings[$att]) {
	            $imgString .= $att . '="' . $settings[$att] . '" ';
	        }
	    }

	    // add standard classes
	    $imgString .= 'class="wp-post-image size-'.$imageSize. ' ';

	    // if we have passed a class
	    if ($settings['class']) {
	        // add it
	        $imgString .= $settings['class'] . ' ';
	    }

	    // if we are using lazyload
	    if ($settings['lazyload']) {
	        // add the 'unloaded' class
	        $imgString .= 'unloaded';
	    }

	    // close the class attribute string
	    $imgString .= '" ';

	    // add the srcset and sizes attributes
	    $imgString .= $srcset . ' ' . $sizes . '>';

	    // return the full string
	    return $imgString;
	}
