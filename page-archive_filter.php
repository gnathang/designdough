<?php
/* Template Name: Archive with filter */
$what_page = $_SERVER['REQUEST_URI'];


get_header();


if (strpos($what_page, '/our-work/') !== false) {
    $archive_page = 'archive_work';
} else {
    $archive_page = 'archive_blog';
}

    $small_title = get_field('small_title');
    $big_title = get_field('big_title');
    $text_body = get_field('text_body');
    $header_layout = get_field('header_layout');
    $page_header_image = get_field('page_header_image');
    $image_style = get_field('image_styles');
    $background_image = get_field('background_image');
    $background_colour = get_field('background_colour');

    // grab our post type selector!
    $post_type_select = get_field('post_type_selector');
    $columns = get_field('columns');

    // choose if we want a toggle that changes the layout option on the page
    // then choose a default layout
    $layout_toggle = get_field('layout_toggle');
    $default_layout = get_field('default_layout');
    // if not, choose one layout, rows or grid
    $chosen_post_layout = get_field('posts_layout');
    $add_pagination = get_field('add_pagination');
?>


<!-- post type selectors -->
<!-- different orders for different types -->
<?php
    $order_by = '';
    $order = '';
    $parent_category_slug = '';

    if($post_type_select == 'project') {
        $order_by = 'date';
        $order = 'ASC';
        $parent_category_slug = 'work';
    } elseif($post_type_select == 'post') { 
        $order_by = 'date';
        $order = 'DESC';
        $parent_category_slug = 'blog';
    };
?>

<section class="page_header <?php echo $background_colour; ?> <?php echo $header_layout; ?>"
    style="<?php if($background_image) { ?> background-image: url('<?php echo $background_image; ?>'); <?php } ?>">
    <div class="container <?php echo $header_layout; ?>">

        <?php if($header_layout === 'bg_image') { ?>
        <!--  background image layout -->
        <!-- todo: srcset for background images! -->
        <div class="title_wrap">
            <?php if($small_title) { ?><h5><?php echo $small_title; ?></h5><?php } ?>
            <h1><?php echo $big_title; ?></h1>
            <?php if($text_body) { ?><p><?php echo $text_body; ?></p><?php } ?>
        </div>

        <?php } if($header_layout === 'editorial') { ?>
        <!--  editoriual layout -->
        <div class="title_wrap">
            <?php if($small_title) { ?><h5><?php echo $small_title; ?></h5><?php } ?>
            <h1 class="ani_fade_up_fold_top_level"><?php echo $big_title; ?></h1>
            <?php if($text_body) { ?><p class="text_body"><?php echo $text_body; ?></p><?php } ?>

            <img class="arrow_down landing_page_header_fade"
                src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-down-white.svg'; ?>"
                alt="arrow down">
        </div>
        <?php if($page_header_image)  { ?>
        <div class="image_wrap">
            <img class="<?php echo $image_style; ?>" src="<?php echo $page_header_image; ?>" alt=""
                class="page_header_image">
        </div>
        <?php } ?>

        <!-- todo: make into flexible content with 2/3/4 cols? -->

        <?php } if($header_layout === 'two_columns') { ?>
        <!--  two column layout -->
        <div class="title_wrap">
            <?php if($small_title) { ?><h6><?php echo $small_title; ?></h6><?php } ?>
            <h1><?php echo $big_title; ?></h1>
            <?php if($text_body) { ?><p><?php echo $text_body; ?></p><?php } ?>
        </div>
        <div class="image_wrap">
            <img class="<?php echo $image_style; ?>" src="<?php echo $page_header_image; ?>" alt=""
                class="page_header_image">
        </div>

        <?php } if ($header_layout == 'small_heading') { ?>
        <div class="title_bar">
            <div class="title_bar_border"></div>
        </div>
        <div class="title_box">
            <div class="title_wrap">
                <?php if($small_title) { ?>
                <p class="small_title fade_in_element"> <?php echo $small_title; ?></p>
                <?php } ?>
                <?php if($big_title) { ?>
                <h2 class="title ani_fade_up_fold_top_level"> <?php echo $big_title; ?> </h2>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

    </div>
</section>

<!-- element for the loading animation -->
<div class="loader"></div>


<!-- remember what page you came from for the back button on single.php to work -->
<!-- e.g. /blog/page/2 -->

<?php
session_start(); // start session

// check if the referring page is from your paginated blogs list
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], '/blog/page/') !== false) {
    $_SESSION['blogs_referrer'] = $_SERVER['HTTP_REFERER']; // store it in session avr
}
?>

<section class="page_archive_filter <?php echo $archive_page; ?> <?php echo $background_colour; ?>">

    <div class="bulletin_bar landing_page_header_fade">
        <div class="container">

            <div class="form_container">
                <div
                    class="bulletin_bar_projects_wrap <?php if (strpos($_SERVER['REQUEST_URI'], '/our-work/') !== false) { ?>
            projects_bar<?php } ?><?php if (strpos($_SERVER['REQUEST_URI'], '/blog/') !== false) { ?>blogs_bar<?php } ?>">

                    <form id="myForm" class="search_filter_form" method="post">

                        <!-- use clickable categories instead, with checkboxes -->
                        <div class="form_group_checkbox">
                            <div class="category-list brand_digital">
                                <?php
                                    // Get all categories
                                    $categories = get_categories();

                                    // Retrieve 'brand' and 'digital' categories
                                    $brand_category = get_category_by_slug('brand');
                                    $digital_category = get_category_by_slug('digital');

                                    // Check if both 'brand' and 'digital' categories exist
                                    if ($brand_category && $digital_category) {
                                        // Filter categories to include only 'brand' and 'digital'
                                        $filtered_categories = array_filter($categories, function($category) use ($brand_category, $digital_category) {
                                            return $category->term_id === $brand_category->term_id || $category->term_id === $digital_category->term_id;
                                        });

                                        // Display filtered categories
                                        foreach ($filtered_categories as $category) :
                                ?>
                                <li class="category_label">
                                    <a class="category_checkbox cat-list_item" href="#!"
                                        data-slug="<?= $category->slug; ?>" data-post-type="<?= $post_type_select; ?>">
                                        <?= $category->name; ?>
                                    </a>
                                </li>
                                <?php
                                        endforeach;
                                    } else {
                                        echo 'Brand or digital category not found.';
                                    }
                                ?>

                            </div>

                            <div id="filter_carousel" class="splide">
                                <div class="splide__track">
                                    <div class="splide__list category-list other_cats">

                                        <ul class="cat-list">
                                            <li class="category_label active">
                                                <a class="category_checkbox cat-list_item active" href="#!" data-slug=""
                                                    data-post-type="<?= $post_type_select; ?>">All
                                                    projects
                                                </a>
                                            </li>
                                            <?php
                                                // Get the parent category ID for "work" category
                                                $parent_category = get_category_by_slug($parent_category_slug);
                                                $parent_category_id = $parent_category->term_id;

                                                // Get child categories of the parent category
                                                $child_categories = get_categories(array(
                                                    'taxonomy' => 'category',
                                                    'child_of' => $parent_category_id,
                                                ));

                                                // Loop through child categories and display them
                                                foreach ($child_categories as $category) :
                                                ?>
                                            <li class="category_label">
                                                <a class="category_checkbox cat-list_item" href="#!"
                                                    data-slug="<?= $category->slug; ?>"
                                                    data-post-type="<?= $post_type_select; ?>">
                                                    <?= $category->name; ?>
                                                </a>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <?php get_template_part('components/includes/posts_layout_toggle'); ?>

                        </div>
                        <input type="hidden" name="what_page" value="<?php echo $what_page; ?>">
                        <input type="submit" value="Submit" style="display: none;">

                    </form>
                </div> <!-- wrap -->
            </div> <!-- form container -->

        </div>
    </div>


    <!-- different queries for each of the post types -->
    <?php
    if($post_type_select == 'project') {
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $query = new WP_Query([
                'paged' => $paged,
                'post_type' => 'project',
                'posts_per_page' => -1,
                // 'cat' => $qry_filter,
                'orderby' => 'date',
                'order' => 'DESC',
                // exclude the archived projects!
                'tag__not_in' => get_term_by('slug', 'archive', 'post_tag')->term_id,
            ]);
        } else {
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $query = new WP_Query([
                'paged' => $paged,
                'post_type' => 'post',
                // 'cat' => $qry_filter,
                'posts_per_page' => 16,
                'order' => 'DESC',
            ]);
        };
    ?>

    <!-- the posts -->
    <?php if($query->have_posts()) : ?>
    <div class="posts_layout_wrapper <?php if ($layout_toggle == false) { echo $chosen_post_layout; } else { echo $default_layout; } ?> <?php echo $columns; ?>"
        data-post-type-select="<?php echo esc_attr($post_type_select); ?>">

        <?php while ($query->have_posts()) : $query->the_post(); ?>
        <!-- the post markup -->

        <?php get_template_part('components/includes/post_template-' . $post_type_select); ?>

        <?php endwhile; ?>

        <?php 
            wp_reset_postdata();
            else: 
                {
                    echo '
                    <div class="no_posts_to_show">
                    <h1>Uh oh! Nothing matches here.</h1>
                    </div>
                    ';
                }
        ?>
    </div>
    <?php endif; ?>

</section>

    <?php if($add_pagination) { ?>
<section>
    <div class="container">
        <?php // get_template_part('components/includes/pagination_bar');?>
        <?php
            echo '<div class="archive_pagination">';
            echo paginate_links( array(
                'total' => $query->max_num_pages,
                'mid_size' => 999,
                'prev_next' => true,
                'prev_text' => __( '<img src="'.get_template_directory_uri().'/assets/images/svg/arrow-back.svg" alt="prev-arrow">', 'textdomain' ),
                'next_text' => __( '<img src="'.get_template_directory_uri().'/assets/images/svg/arrow-next.svg" alt="prev-arrow">', 'textdomain' ),
                'type' => 'plain',
            ) );
            echo '</div>';
            wp_reset_postdata();
        ?>
    </div>
</section>
    <?php } ?>

<?php get_template_part('components/flex/content'); ?>

<?php get_footer(); ?>