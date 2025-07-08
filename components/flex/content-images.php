<?php 
$row = get_row_index() - 0;
$padding = get_sub_field('padding'); 
$layout = get_sub_field('layout'); 
// count rows in images
$slides_to_show = get_sub_field('slides_to_show');
$og_dimensions = get_sub_field('og_dimensions');
$images = get_sub_field('images', $post->ID);
$full_width = get_sub_field('full_width');
$inset_padding = get_sub_field('inset_padding');
$orientation = get_sub_field('orientation');
$remove_border_radius = get_sub_field('remove_border_radius');
$background = get_sub_field('background');

if($images) { 
$rows = count($images);
}

?>
<section
    class="section_images row-<?php echo $row; ?> <?php echo $padding; ?><?php if($row == 1) { ?> remove_top_padding<?php } if ($layout == 'spinning_wheels') { ?> transparent_plus_padding<?php } ?> <?php if ($layout == 'editorial') { ?> <?php echo $background; ?> <?php } ?><?php if($row == 2) { ?> landing_page_header_fade<?php } else { ?> fade_in_container<?php } ?>">

    <!-- remove container conditionally -->
    <?php if(!$full_width) { ?>
    <div class="container">
        <?php } ?>
        <!-- count the number of images in our repeater -->

        <?php if($layout == 'editorial') { ?>
        <div
            class="images_editorial_grid <?php if($rows == 1) { ?>big_image <?php } else { ?>editorial <?php } if($rows == 2) { ?>two_images<?php } ?><?php if ($remove_border_radius == true) { ?> remove_border_radius<?php } ?> <?php if($rows == 1 && $inset_padding) { ?> inset<?php } ?>">
            <?php if (have_rows('images')) : while (have_rows('images')) : the_row(); ?>
            <?php $image_or_video = get_sub_field('image_or_video'); ?>
            <?php $image = get_sub_field('image'); ?>
            <?php $video = get_sub_field('video'); ?>
            <?php $row = get_row_index() - 0; ?>
            <!-- todo: fix the srcset -->
            <?php if($image_or_video ==  true) { ?>
            <div class="video fade_in_element row-<?php echo get_row_index(); ?>">
                <video autoplay muted playsinline loop src="<?php echo $video; ?>"></video>
            </div>
            <?php } else { ?>
            <?php if($orientation == 'portrait') { ?>
            <div
                class="image row-<?php echo get_row_index(); ?> fade_in_element fade-delay-<?php echo get_row_index(); ?>">
                <?php $bannerOne = array(
                        'class' => '' ,
                        'id' => $image,
                        'lazyload' => false
                    );
                echo build_srcset('portrait', $bannerOne); ?>
            </div>
            <?php } if ($orientation == 'banner') { ?>
            <div
                class="image row-<?php echo get_row_index(); ?> fade_in_element fade-delay-<?php echo get_row_index(); ?> <?php if($inset_padding) { ?> inset<?php } ?>">
                <?php $bannerOne = array(
                        'class' => '' ,
                        'id' => $image,
                        'lazyload' => false
                    );
                echo build_srcset('banner', $bannerOne); ?>
            </div>
            <?php } if ($orientation == 'original') { ?>
            <div
                class="image row-<?php echo get_row_index(); ?> fade_in_element fade-delay-<?php echo get_row_index(); ?> <?php if($inset_padding) { ?> inset<?php } ?>">
                <?php
                $attachment_id = get_sub_field('image'); // Assuming 'image' is your ACF field name
                $alt_text = 'Alt Text'; // Replace with the appropriate alt text

                // Get the image URL based on the attachment ID
                $image_url = wp_get_attachment_image_src($attachment_id, 'full')[0];

                // Output the image tag
                echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($alt_text) . '">';
                ?>
            </div>

            <?php } ?>
            <?php } ?>

            <?php endwhile; endif; ?>
        </div>

        <?php } if($layout == 'slider') { ?>

        <!-- if there's already a slider with the same ID, render another with a suffix so that they can both be displayed -->
        <div id="images_carousel_<?php echo $slides_to_show; ?>"
            class="splide <?php if ($og_dimensions) { ?> og_dimensions<?php } ?>">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php if (have_rows('images')) : while (have_rows('images')) : the_row(); ?>
                        <?php $slide = get_sub_field('image'); ?>
                        <?php $logo = get_sub_field('logo'); ?>
                        <?php $title = get_sub_field('title'); ?>
                        <?php $row = get_row_index() - 0; ?>
                        <li
                            class="splide__slide image row-<?php echo get_row_index(); ?> fade_in_element fade-delay-<?php echo get_row_index(); ?> <?php if ($remove_border_radius == true) { ?> remove_border_radius<?php } ?>">
                            <?php $bannerOne = array(
                                    'class' => 'slide_image',
                                    'id' => $slide,
                                    'lazyload' => false
                                );
                                echo build_srcset('banner', $bannerOne); ?>
                            <?php if($logo || $title) { ?>
                            <div class="text_wrapper">
                                <img class="client_logo" src="<?php echo $logo ?>" alt="client logo">
                                <h3 class="title"><?php echo $title; ?></h3>
                            </div>
                            <?php } ?>
                        </li>
                        <?php endwhile; endif; ?>
                    </ul>
                </div>
            </div>
            <!-- signal that there is already one slider on the page -->
            <!-- so that a different slider with the same ID can be rendered again -->
            <?php $renderSecondSlider = true; ?>

            <?php } if($layout == 'grid') { ?>
            <div
                class="images_grid <?php if ($remove_border_radius == true) { ?> remove_border_radius<?php } ?> <?php if($og_dimensions) { ?> og_dimensions<?php } ?>">
                <?php if (have_rows('images')) : while (have_rows('images')) : the_row(); ?>
                <?php $image_or_video = get_sub_field('image_or_video'); ?>
                <?php $image = get_sub_field('image'); ?>
                <?php $video = get_sub_field('video'); ?>
                <?php $row = get_row_index() - 0; ?>
                <!-- todo: fix the srcset -->
                <?php if($image_or_video ==  true) { ?>
                <div class="video row-<?php echo get_row_index(); ?>">
                    <video playsinline autoplay muted loop src="<?php echo $video; ?>"></video>
                </div>
                <?php } else { ?>
                <div
                    class="image row-<?php echo get_row_index(); ?> fade_in_element fade-delay-<?php echo get_row_index(); ?>">
                    <?php $squareOne = array(
                    'class' => '' ,
                    'id' => $image,
                    'lazyload' => false
                );
             echo build_srcset('square', $squareOne); ?>
                </div>
                <?php } ?>

                <?php endwhile; endif; ?>
            </div>
            <?php } if($layout == 'spinning_wheels') { ?>
            <div class="wheels_grid">
                <div id="brandlabs_wheel" class="wheel_wrap">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/wheel-1.svg'; ?>"
                        alt="spinning wheel">
                </div>
                <div id="brandlabs_wheel" class="wheel_wrap">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/wheel-2.svg'; ?>"
                        alt="spinning wheel">
                </div>
                <div id="brandlabs_wheel" class="wheel_wrap">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/wheel-3.svg'; ?>"
                        alt="spinning wheel">
                </div>
                <div id="brandlabs_wheel" class="wheel_wrap">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/wheel-4.svg'; ?>"
                        alt="spinning wheel">
                </div>
            </div>
            <?php } ?>

            <!-- remove container conditionally -->
            <?php if(!$full_width) { ?>
        </div> <!-- container -->
        <?php } ?>
</section>