<?php 
    $remove_top_padding = get_sub_field('remove_top_padding');
    $small_title = get_sub_field('small_title');
    $big_title = get_sub_field('big_title');
    $link = get_sub_field('link'); 
    $layout = get_sub_field('layout');
    $chosen_post_type = get_sub_field('select_post_type');
    $chosen_no_of_posts = get_sub_field('how_many_posts');
    $latest_or_selected = get_sub_field('latest_or_selected');
    $filter_by_archived = get_sub_field('filter_by_archived');
    $portfolio_images = get_sub_field('portfolio_images');
    $row = get_row_index() - 0; 
?>

<!-- todo: add view selector toggle -->
<!-- todo: selected posts version -->

<?php $post_id = get_the_ID(); ?>
<section
    class="section_posts_agg row-<?php echo $row; ?> <?php if ($post_id === 711) { ?> header_window <?php } ?><?php if($remove_top_padding) { ?> remove_top_padding<?php } ?>">
    <?php if($big_title) { ?>

    <div class="title_bar">
        <div class="title_bar_border"></div>
    </div>

    <div class="title_box">
        <div class="title_wrap">
            <p class="small_title fade_in_element"><?php echo $small_title; ?></p>
            <h2 class="ani_fade_up_fold"><?php echo $big_title; ?></h2>
        </div>
    </div>

    <?php } ?>

    <?php if ($latest_or_selected == false) { ?>

    <?php
        $args = array(
            'post_type' => $chosen_post_type,
            'posts_per_page' => $chosen_no_of_posts,
            'orderby'   => 'date',
            'order' => 'ASC','order' => 'DSC',
        );
        // conditionally filter by archived tag
        if ($filter_by_archived) {
            $archive_term = get_term_by('slug', 'archive', 'post_tag');
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'id',
                    'terms'    => $archive_term->term_id,
                    'operator' => 'IN',
                ),
            );
        } else {
            $archive_term = get_term_by('slug', 'archive', 'post_tag');
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'id',
                    'terms'    => $archive_term->term_id,
                    'operator' => 'NOT IN',
                ),
            );
        }

        $latest = new WP_Query($args);
    ?>

    <?php if ($layout == 'rows') {  ?>


    <div class="post_rows">
        <?php while ( $latest->have_posts() ) : $latest->the_post(); ?>
        <a class="post_row" href="<?php the_permalink(); ?>">
            <div class="container">
                <div class="post_row_grid">
                    <div class="title_col">
                        <h3 class="post-title"><?php the_title(); ?></h3>
                    </div>
                    <div class="meta_col">
                        <?php if ($chosen_post_type == 'job') { ?>
                        <div class="jobs_meta_wrap">
                            <?php $full_or_part_time = get_field('full_or_part_time'); ?>
                            <?php $location = get_field('location'); ?>
                            <?php $hours = get_field('hours'); ?>
                            <h6><?php echo $full_or_part_time; ?></h6>
                            <h6><?php echo $location; ?></h6>
                            <h6><?php echo $hours; ?></h6>
                        </div>
                        <?php } else { ?>
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
                        <?php } ?>
                    </div>
                    <div class="images_wrap">
                        <?php if (have_rows('portfolio_images')) : while (have_rows('portfolio_images')) : the_row(); ?>
                        <?php $image = get_sub_field('image'); ?>
                        <?php $row = get_row_index(); ?>
                        <div class="image_wrap fade_in_element fade-delay-<?php echo $row; ?>">
                            <?php
                                $bannerArgs = array(
                                    'class' => '',
                                    'id' => $image,
                                    'lazyload' => false
                                );
                                echo build_srcset('banner', $bannerArgs);
                            ?>
                        </div>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
            </div>
        </a>
        <?php wp_reset_postdata(); ?>
        <?php endwhile; ?>
    </div>


    <?php } if($layout == 'grid') { ?>

    <div class="post_grid">
        <?php while ( $latest->have_posts() ) : $latest->the_post(); ?>
        <?php $summary = get_field('summary'); ?>
        <div class="grid_cell fade_in_element">
            <!-- retreive metadata -->
            <?php // $post_type = get_post_type( $post->ID )?>
            <?php
                    foreach((get_the_category()) as $category) {
                        $postcat = $category->cat_ID;
                        $catname = $category->cat_name;
                    }
                ?>
            <a href="<?php the_permalink(); ?>">
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
                </div>
                <!-- todo: remove one of these thumbnail conditionals -->
                <?php if ( has_post_thumbnail() ) { ?>
                <div class="overlay_image_wrapper"
                    style="<?php if ( has_post_thumbnail() ) { ?> background-image: url('<?php the_post_thumbnail_url();?>'); <?php } else { ?> background: grey <?php } ?>;">
                </div>
                <?php } ?>
            </a>
            <div class="text_wrapper">
                <h3><?php the_title(); ?></h3>
                <p><?php echo $summary; ?></p>
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
        <?php endwhile; ?>
    </div>

    <div class="link_box">
        <?php 
                if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
        <a class="btn_second" href="<?php echo esc_url( $link_url ); ?>"
            target="<?php echo esc_attr( $link_target ); ?>">
            <span><?php echo $link_title; ?><img
                    src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right-white.svg'; ?>"
                    alt="button arrow"></span>
        </a>
        <?php endif; ?>
    </div>

    <?php } if($layout == 'slider') { ?>

    <div class="post_slider slider regular">
        <?php while ( $latest->have_posts() ) : $latest->the_post(); ?>
        <!-- todo: remove one of these class names -->
        <a href="<?php the_permalink(); ?>" class="post_wrapper grid_cell">

            <!-- retreive metadata -->
            <?php // $post_type = get_post_type( $post->ID )?>
            <?php
                    foreach((get_the_category()) as $category) {
                        $postcat= $category->cat_ID;
                        $catname =$category->cat_name;
                    }
                ?>

            <!-- todo: remove one of these thumbnail conditionals -->
            <?php if ( has_post_thumbnail() ) { ?>
            <div class="image_wrapper"
                style="background-size: cover; <?php if ( has_post_thumbnail() ) { ?> background-image: url('<?php the_post_thumbnail_url();?>'); <?php } else { ?> background: grey <?php } ?>;">
            </div>
            <?php } ?>

            <div class="text_wrapper">
                <div class="meta_wrapper">
                    <h6>
                        <?php if($get_post_type == 'post') {?> News & views
                        <?php } elseif($get_post_type == 'project') { ?> Project
                        <?php } else { ?> Job Vacancy <?php } ?>
                    </h6>
                    <h6> <?php echo $catname; ?> </h6>
                </div>
                <h4><?php the_title(); ?></h4>
            </div>
            <img class="arrow"
                src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right-white.svg'; ?>"
                alt="arrow next">
        </a>
        <?php wp_reset_postdata(); ?>
        <?php endwhile; ?>
    </div>

    <?php } elseif($layout == 'editorial') { ?>

    <div class="posts_editorial">
        <?php while ( $latest->have_posts() ) : $latest->the_post(); ?>

        <div class="post_wrapper post_wrapper_top">
            <a href="<?php the_permalink(); ?>">
                <?php if ( has_post_thumbnail() ) { ?>
                <div class="image_wrapper"
                    style="background-size: cover; <?php if ( has_post_thumbnail() ) { ?> background-image: url('<?php the_post_thumbnail_url();?>'); <?php } else { ?> background: grey <?php } ?>;">
                </div>
                <?php } ?>
                <div class="text_wrapper">
                    <div class="meta_wrapper">
                        <h6>
                            <?php if($get_post_type == 'post') {?> News & views
                            <?php } elseif($get_post_type == 'case-study') { ?> Case Study
                            <?php } else { ?> Job Vacancy <?php } ?>
                        </h6>
                        <h6> <?php echo $catname; ?> </h6>
                    </div>
                    <h4><?php the_title(); ?></h4>
                    <img class="arrow"
                        src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right.svg'; ?>"
                        alt="arrow next">
                </div>
            </a>
        </div>

        <?php wp_reset_postdata(); ?>
        <?php endwhile; ?>
    </div>


    <?php } ?>

    <!-- selected posts -->
    <?php } else { ?>

    <?php if ($layout == 'rows') {  ?>

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

    <?php } if ($layout == 'grid') { ?>

    <div class="post_grid">
        <?php if(have_rows('selected_posts')) : while(have_rows('selected_posts')) : the_row(); ?>
        <?php $post_object = get_sub_field('post'); ?>
        <?php if( $post_object ): ?>
        <?php // override $post
        $post = $post_object;
        setup_postdata( $post );
        ?>
        <?php $summary = get_field('summary'); ?>
        <div class="grid_cell fade_in_element">
            <!-- retreive metadata -->
            <?php // $post_type = get_post_type( $post->ID )?>
            <?php
                foreach((get_the_category()) as $category) {
                    $postcat = $category->cat_ID;
                    $catname = $category->cat_name;
                }
            ?>
            <a class="perma_wrap" href="<?php the_permalink(); ?>" aria-label="Link to <?php the_title(); ?> project">
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
                    <!-- render the thumbanil to use as an overlat that dissapears on hover -->
                    <?php if ( has_post_thumbnail() ) { ?>
                    <div class="overlay_image_wrapper"
                        style="<?php if ( has_post_thumbnail() ) { ?>background-image: url('<?php the_post_thumbnail_url();?>'); <?php } else { ?> background: grey <?php } ?>">
                    </div>
                    <?php } ?>
                </div>
            </a>
            <div class="text_wrapper">
                <h3><?php the_title(); ?></h3>
                <h4><?php echo $summary; ?></h4>
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

    <div class="link_box fade_in_element">
        <?php 
                if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
        <a class="btn_second" href="<?php echo esc_url( $link_url ); ?>"
            target="<?php echo esc_attr( $link_target ); ?>">
            <span><?php echo $link_title; ?><img
                    src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right-white.svg'; ?>"
                    alt="button arrow"></span>
        </a>
        <?php endif; ?>
    </div>

    <?php } if ($layout == 'slider') { ?>

    <div class="post_slider slider regular">
        <?php if(have_rows('selected_posts')) : while(have_rows('selected_posts')) : the_row(); ?>
        <?php $post_object = get_sub_field('post'); ?>
        <?php if( $post_object ): ?>
        <?php // override $post
            $post = $post_object;
            setup_postdata( $post );
            ?>
        <!-- todo: remove one of these class names -->
        <a href="<?php the_permalink(); ?>" class="post_wrapper grid_cell">

            <!-- retreive metadata -->
            <?php // $post_type = get_post_type( $post->ID )?>
            <?php
                    foreach((get_the_category()) as $category) {
                        $postcat= $category->cat_ID;
                        $catname =$category->cat_name;
                    }
                ?>

            <!-- todo: remove one of these thumbnail conditionals -->
            <?php if ( has_post_thumbnail() ) { ?>
            <div class="image_wrapper"
                style="background-size: cover; <?php if ( has_post_thumbnail() ) { ?> background-image: url('<?php the_post_thumbnail_url();?>'); <?php } else { ?> background: grey <?php } ?>;">
            </div>
            <?php } ?>

            <div class="text_wrapper">
                <div class="meta_wrapper">
                    <h6>
                        <?php if($get_post_type == 'post') {?> News & views
                        <?php } elseif($get_post_type == 'project') { ?> Project
                        <?php } else { ?> Job Vacancy <?php } ?>
                    </h6>
                    <h6> <?php echo $catname; ?> </h6>
                </div>
                <h4><?php the_title(); ?></h4>
            </div>
            <img class="arrow"
                src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right-white.svg'; ?>"
                alt="arrow next">
        </a>
        <?php wp_reset_postdata(); ?>
        <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <?php } elseif($layout == 'editorial') { ?>
    <div class="posts_editorial">
        <?php if(have_rows('selected_posts')) : while(have_rows('selected_posts')) : the_row(); ?>
        <?php $post_object = get_sub_field('post'); ?>
        <?php if( $post_object ): ?>
        <?php // override $post
            $post = $post_object;
            setup_postdata( $post );
            ?>

        <div class="post_wrapper post_wrapper_top">
            <a href="<?php the_permalink(); ?>">
                <?php if ( has_post_thumbnail() ) { ?>
                <div class="image_wrapper"
                    style="background-size: cover; <?php if ( has_post_thumbnail() ) { ?> background-image: url('<?php the_post_thumbnail_url();?>'); <?php } else { ?> background: grey <?php } ?>;">
                </div>
                <?php } ?>
                <div class="text_wrapper">
                    <div class="meta_wrapper">
                        <h6>
                            <?php if($get_post_type == 'post') {?> News & views
                            <?php } elseif($get_post_type == 'case-study') { ?> Case Study
                            <?php } else { ?> Job Vacancy <?php } ?>
                        </h6>
                        <h6> <?php echo $catname; ?> </h6>
                    </div>
                    <h4><?php the_title(); ?></h4>
                    <img class="arrow"
                        src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right.svg'; ?>"
                        alt="arrow next">
                </div>
            </a>
        </div>

        <?php wp_reset_postdata(); ?>
        <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <?php } ?>

    <?php } ?>
    <!-- recent or selected -->

</section>