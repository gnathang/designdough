<?php
get_header();
?>

<!--todo - lauout toggle switcher -> AJAX? -->
<!-- todo: make the background image into featured image -->
<?php 
    // $header_layout = get_field('header_layout');
    $header_image_or_video = get_field('header_image_or_video');
    $header_image = get_field('header_image');
    $header_video = get_field('header_video');

    $unstick_header = get_field('unstick_header');
    $image_style = get_field('image_styles');
    $background_colour = get_field('background_colour');
    
    $user = get_field('author');
    $post_format = get_field('post_format');
    $brief = get_field('brief');
    $summary = get_field('summary');
    $externalurl = get_field('external_url');

    // this isn't used on this file -> this is checked in the header.php
    // it is here just to indicative purposes.
    $black_or_white_bg = get_field('dark_or_light');

    foreach((get_the_category()) as $category) {
        $postcat= $category->cat_ID;
        $catname =$category->cat_name;
    }
?>

<?php if ($header_image_or_video) { ?>
<section class="section_project_page_header video_header">
    <div class="video row-<?php echo get_row_index(); ?>">
        <video autoplay playsinline muted loop src="<?php echo $header_video; ?>"></video>
    </div>
</section>

<?php } else { ?>
<section class="section_project_page_header"
    style="<?php if($header_image) { ?> background-image: url('<?php echo $header_image; ?>'); <?php } ?>">
</section>
<?php } ?>

<section class="section_project_intro">
    <div class="container">
        <p class="project_title fade_in_element"><?php the_title(); ?></p>
        <div class="title_bar">
            <div class="title_bar_border"></div>
        </div>
        <div class="project_intro_grid <?php if(!$summary) { ?> no_summary<?php } ?>">
            <h3 class="project_summary ani_fade_up_fold"><?php echo $summary; ?></h3>
            <div class="services_wrap">
                <?php 
                    $brand_services = get_field('brand_services_2'); 
                    $digital_services = get_field('digital_services_2');
                ?>
                <?php if($brand_services || $digital_services) { ?>
                <div
                    class="service_boxes<?php if ((!$brand_services && $digital_services) || ($brand_services && !$digital_services)) { ?> single_service<?php } ?>">

                    <?php
                    if( $brand_services ): ?>
                    <div class="glance_box fade_in_element">
                        <div class="glance_box_title_wrap">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/brand-icon.svg'; ?>"
                                alt="brand icon">
                            <h4 class="glance_title">Brand</h4>
                            <img class="service_arrow_down"
                                src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-down-white.svg'; ?>">
                        </div>
                        <ul class="services_list">
                            <?php foreach( $brand_services as $service ): ?>
                            <li><?php echo $service; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php
                    if( $digital_services ): ?>
                    <div class="glance_box fade_in_element">
                        <div class="glance_box_title_wrap">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/digital-icon.svg'; ?>"
                                alt="brand icon">
                            <h4 class="glance_title">Digital</h4>
                            <img class="service_arrow_down"
                                src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-down-white.svg'; ?>">
                        </div>
                        <ul class="services_list">
                            <?php foreach( $digital_services as $service ): ?>
                            <li><?php echo $service; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
            <?php } ?>
            <div class="brief_wrap fade_in_element">
                <div class="brief">
                    <?php echo $brief; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
    get_template_part('components/flex/content');
    // todo: remove content editor in the backend!
?>


<!-- more posts loop -->
<?php if( have_rows('see_more_posts') ): ?>
<?php while( have_rows('see_more_posts') ): the_row();  ?>

<?php 
    $other_posts_big_title = get_sub_field('other_posts_big_title');
    $other_posts_small_title  = get_sub_field('other_posts_small_title');
    $other_posts_link = get_sub_field('other_posts_link');
    $other_posts_layout = get_sub_field('other_posts_layout'); 
?>

<section class="other_posts">
    <div class="container">

        <div class="title_bar">
            <div class="title_bar_border"></div>
        </div>

        <div class="title_box">
            <div class="title_wrap">
                <p class="small_title"><?php echo $other_posts_small_title; ?></p>
                <h2 class="ani_fade_up_fold"><?php echo $other_posts_big_title; ?></h2>
            </div>
        </div>


        <?php if ($other_posts_layout == 'rows') {  ?>
        <div class="post_rows">
            <div class="rows_title_wrap">
                <h2 class="title"><?php echo $big_title; ?></h2>
            </div>
            <?php if(have_rows('selected_posts')) : while(have_rows('selected_posts')) : the_row(); ?>
            <?php $post_object = get_sub_field('post'); ?>
            <?php if( $post_object ): ?>
            <?php // override $post
            $post = $post_object;
            setup_postdata( $post );
            ?>
            <a class="post_row" href="<?php the_permalink(); ?>">
                <div class="container">
                    <div class="post_row_grid">
                        <div class="title_col">
                            <h3 class="post-title"><?php the_title(); ?></h3>
                        </div>
                        <div class="meta_col">
                            <?php
                                $categories = get_the_category();
                                $separator = ' ';
                                $output = '';
                                if ( ! empty( $categories ) ) {
                                    foreach( $categories as $category ) {
                                        $output .= '<h6 class=" ' . esc_html( $category->name ) . '" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</h6>' . $separator;
                                    }
                                    echo trim( $output, $separator );
                                }
                            ?>
                        </div>
                        <div class="images_wrap">
                            <?php if (have_rows('portfolio_images')) : while (have_rows('portfolio_images')) : the_row(); ?>
                            <?php
                                $bannerArgs = array(
                                    'class' => '',
                                    'id' => $image,
                                    'lazyload' => false
                                );
                                echo build_srcset('banner', $bannerArgs);
                            ?>
                            <?php endwhile; endif; ?>
                        </div>
                    </div>
                </div>
            </a>
            <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <?php } elseif ($other_posts_layout == 'grid') { ?>

        <div class="post_grid">
            <?php if(have_rows('selected_posts')) : while(have_rows('selected_posts')) : the_row(); ?>
            <?php $post_object = get_sub_field('post'); ?>
            <?php if( $post_object ): ?>
            <?php 
                // override $post
                $post = $post_object;
                setup_postdata( $post );
            ?>
            <div class="grid_cell fade_in_element">
                <!-- retreive metadata -->
                <?php // $post_type = get_post_type( $post->ID )?>
                <?php
                    foreach((get_the_category()) as $category) {
                        $postcat = $category->cat_ID;
                        $catname = $category->cat_name;
                    }
                ?>
                <a class="perma_wrap" href="<?php the_permalink(); ?>"
                    aria-label="Link to <?php the_title(); ?> project">
                    <div class="slideshow">
                        <?php if (have_rows('portfolio_images')) : ?>
                        <?php $i = 1; while (have_rows('portfolio_images')) : the_row(); ?>
                        <?php $image = get_sub_field('image'); ?>
                        <div class="portfolio_image_wrap <?php echo wp_is_mobile() ? 'show' : ''; ?>">
                            <?php

                            $bannerArgs = array(
                                'class' => '',
                                'id' => $image,
                                'lazyload' => false
                            );
                            echo build_srcset('banner', $bannerArgs);
                            ?>
                        </div>
                        <?php $i++; endwhile; ?>
                        <?php endif; ?>
                        <!-- todo: remove one of these thumbnail conditionals -->
                        <?php if ( has_post_thumbnail() ) { ?>
                        <div class="overlay_image_wrapper"
                            style="<?php if ( has_post_thumbnail() ) { ?> background-image: url('<?php the_post_thumbnail_url();?>'); <?php } else { ?> background: grey <?php } ?>;">
                        </div>
                        <?php } ?>
                    </div>
                </a>
                <div class="text_wrapper">
                    <h3><?php the_title(); ?></h3>
                    <div class="meta_wrapper">
                        <?php
                        $categories = get_the_category();
                        $separator = ' ';
                        $output = '';

                        if (!empty($categories)) {
                            foreach ($categories as $category) {
                                // Check if the category is 'brand' or 'digital' (case-insensitive)
                                if (strtolower(trim($category->name)) === 'brand' || strtolower(trim($category->name)) === 'digital') {
                                    $output .= '<h6 class="' . esc_html($category->name) . '">' . esc_html($category->name) . '</h6>' . $separator;
                                }
                            }

                            echo trim($output, $separator);
                        }
                    ?>
                    </div>
                </div>

            </div>
            <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <?php } ?>

        <div class="link_box">
            <a class="btn_second" href="/our-work/" target="<?php echo esc_attr( $link_target ); ?>">
                <span>ALL WORK<img
                        src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right-white.svg'; ?>"
                        alt="button arrow">
                </span>
            </a>
        </div>

    </div>
</section>

<?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>