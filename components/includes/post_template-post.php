<?php
    // we are using php sessions to count the number of rows
    // this is to add classes to certain rows
    
    // Start or resume the session
    session_start();
    // Check if the session variable is set, and if not, initialize it to 1
    if (!isset($_SESSION['row'])) {
        $_SESSION['row'] = 1;
    } else {
        // Increment the row count
        $_SESSION['row']++;
    }
?>

<!-- using this to change the number of posts shown upon page load
     this changes depending on the archive page type, as there are differetn layouts.  -->

<?php 
    $isWorkPage = false;
    $archive_page = '';
    if (strpos($_SERVER['REQUEST_URI'], '/our-work') !== false) {
        $no_of_top_posts_shown = 4;
        $isWorkPage = true;
    } else {
        $no_of_top_posts_shown = 8;
        $isWorkPage = false;
    }
?>
<!-- pull the summary through -->
<?php $summary = get_field('summary'); ?>

<!-- post grid cell -->
<div class="grid_cell">
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
            <!-- todo: remove one of these thumbnail conditionals -->
            <?php if ( has_post_thumbnail() ) { ?>
            <div class="overlay_image_wrapper"
                style="<?php if ( has_post_thumbnail() ) { ?> background-image: url('<?php the_post_thumbnail_url();?>'); <?php } else { ?> background: grey <?php } ?>;">
            </div>
            <?php } ?>
        </div>

    </a>
    <!-- render the text wrapper for the work page, without the additional cats -->
    <div class="text_wrapper">
        <h3><?php the_title(); ?></h3>
        <h4><?php echo $summary; ?></h4>
        <div class="meta_wrapper post_in_post_template">
            <?php
                $categories = get_the_category();
                $separator = ' ';
                $output = '';
                if (!empty($categories)) {
                    //  display all categories (for all other pages - in this case, just the blog page)
                    foreach ($categories as $category) {
                        $output .= '<h6 class="' . esc_html($category->name) . '">' . esc_html($category->name) . '</h6>' . $separator;

                    }
                    echo trim($output, $separator);
                }
            ?>
        </div>
    </div>
</div>


<a class="post_row row-<?php echo $_SESSION['row']; ?>" href="<?php the_permalink(); ?>">
    <div class="container">
        <div
            class="post_row_grid <?php if (strpos($_SERVER['REQUEST_URI'], '/blog') !== false) { ?> blog_page_row_grid <?php } ?>">
            <div class="title_col">
                <h3 class="post-title"><?php the_title(); ?></h3>
            </div>
            <div class="meta_col">
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
            <div class="images_wrap">
                <?php if (have_rows('portfolio_images')) : while (have_rows('portfolio_images')) : the_row(); ?>
                <?php $image = get_sub_field('image'); ?>
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

<?php
    // Increment the session row count for the next request
    $_SESSION['row']++;
?>