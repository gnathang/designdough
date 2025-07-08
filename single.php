<?php
get_header();
/* Template Name: Case Studies */

// $data_theme = 'light';

?>

<!--todo - lauout toggle switcher -> AJAX? -->
<!-- todo: make the background image into featured image -->
<?php 
    $header_layout = get_field('header_layout');
    $unstick_header = get_field('unstick_header');
    $page_header_image = get_field('page_header_image');
    $image_style = get_field('image_styles');
    $background_image = get_field('background_image');
    $description = get_field('description');
    $background_colour = get_field('background_colour');
    
    $user = get_field('author');
    $post_format = get_field('post_format');
    $externalurl = get_field('external_url');

    foreach((get_the_category()) as $category) {
        $postcat= $category->cat_ID;
        $catname =$category->cat_name;
    }
?>

<?php
session_start(); // Start session to retrieve referrer

// Use the stored referrer if it exists, otherwise fallback to "/blogs/"
$back_url = isset($_SESSION['blogs_referrer']) ? $_SESSION['blogs_referrer'] : site_url('/blog/');
?>

<div class="container">
    <a href="<?php echo esc_url($back_url); ?>" class="back_to_all_wrap_fixed landing_page_header_fade">
        <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-back.svg'; ?>"
            alt="previous arrow">
        <p>Back to All</p>
    </a>
</div>

<section
    class="single_page_header page_header <?php echo $background_colour; ?> <?php echo $header_layout; ?><?php if ($unstick_header) { ?> remove_sticky <?php } ?>"
    style="<?php if($background_image) { ?> background-image: url('<?php echo $background_image; ?>'); <?php } ?>">
    <div class="container">
        <div class="title_bar">
            <div class="title_bar_border"></div>
        </div>
    </div>
    <div class="container_small <?php echo $header_layout; ?>">

        <?php if($header_layout === 'bg_image') { ?>
        <!--  background image layout -->
        <!-- todo: srcset for background images! -->
        <div class="title_wrap">
            <h2 class="title ani_fade_up_fold_top_level"><?php the_title(); ?></h2>
            <?php if($category) { ?><h6><?php echo $catname; ?></h6><?php } ?>
        </div>

        <?php } if($header_layout === 'editorial') { ?>
        <!--  editoriual layout -->
        <div class="title_wrap">
            <h2 class="title ani_fade_up_fold_top_level"><?php the_title(); ?></h2>
            <?php if($category) { ?><h6><?php echo $catname; ?></h6><?php } ?>
            <?php if($text_body) { ?><p class="text_body"><?php echo $text_body; ?></p><?php } ?>
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
            <h2 class="title ani_fade_up_fold_top_level"><?php the_title(); ?></h2>
            <?php if($category) { ?><h6><?php echo $catname; ?></h6><?php } ?>
            <?php if($text_body) { ?><p><?php echo $text_body; ?></p><?php } ?>
        </div>
        <div class="image_wrap">
            <img class="<?php echo $image_style; ?>" src="<?php echo $page_header_image; ?>" alt=""
                class="page_header_image">
        </div>

        <?php } if ($header_layout == 'small_heading') { ?>

        <div class="title_box">
            <div class="title_wrap">
                <a href="javascript:history.back()" class="back_to_all_wrap landing_page_header_fade">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-back.svg';?>"
                        alt="previous arrow">
                    <p>Back to All</p>
                </a>
                <h1 class="title ani_fade_up_fold_top_level"><?php the_title(); ?></h1>
                <?php if($category) { ?><h6 class="landing_page_header_fade"><?php echo $catname; ?></h6><?php } ?>
                <div class="author_wrap landing_page_header_fade">
                    <?php
                    if( $user ): ?>
                    <div class="user_avatar_wrap">
                        <?php echo $user['user_avatar']; ?>
                    </div>
                    <p><?php echo $user['display_name']; ?></p>
                    <?php if( $user['user_description'] ): ?>
                    <p><?php echo $user['user_description']; ?></p>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php } ?>


    </div>
</section>


<?php if ( has_post_thumbnail() ) { ?>
<section class="image_container container_small landing_page_header_fade">
    <div class="featured_image_wrap" style=" background-image: url('<?php the_post_thumbnail_url();?>');">
    </div>
</section>
<?php } ?>

<!-- external_link format -->
<?php if( $post_format == 'external_link' ) { ?>
<section class="external_link">
    <p>external link</p>
    <div class="container">

        <div class="post_wrapper external_link">

            <div class="post-detail">
                <p><?php echo $description; ?></p>
                <a class="btn_fourth" href="<?php echo $externalurl; ?>" target="_blank">Download here</a>
            </div>

        </div>
    </div>
</section>

<!-- simple_post format -->
<?php } elseif( $post_format == 'simple_post' ) { ?>
<section class="simple_post landing_page_header_fade <?php echo $background_colour; ?>" id="row-<?php echo $row; ?>">
    <div class="container_small">

        <div class="post_content_wrap">
            <h4><?php echo $description; ?></h4>
            <?php the_content(); ?>
        </div>

    </div>
</section>

<!-- flex_post format -->
<?php } else { ?>

<?php 
    get_template_part('components/flex/content');
    // todo: remove content editor in the backend!
?>

<?php } ?>



<!-- more posts loop -->
<?php if( have_rows('see_more_posts') ): ?>
<?php while( have_rows('see_more_posts') ): the_row();  ?>

<?php 
    $other_posts_big_title = get_sub_field('other_posts_big_title');
    $other_posts_small_title  = get_sub_field('other_posts_small_title');
    $other_posts_link = get_sub_field('other_posts_link');
    $other_posts_layout = get_sub_field('other_posts_layout');
    $columns = get_sub_field('other_posts_columns');
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
            <?php /*
                if( $other_posts_link ):
                    $link_url = $other_posts_link['url'];
                    $link_title = $other_posts_link['title'];
                    $link_target = $other_posts_link['target'] ? $other_posts_link['target'] : '_self';
                ?>
            <a class="btn_default" href="<?php echo esc_url( $link_url ); ?>"
                target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
            <?php endif;*/ ?>
        </div>

        <!-- select number of posts to show based on number of columns -->

        <?php 
            $no_of_posts = '';
            if($columns == 'two_columns') {
                $no_of_posts = '2';
            } elseif($columns == 'three_columns') {
                $no_of_posts = '3';
            } elseif($columns == 'four_columns') {
                $no_of_posts = '4';
            }
        ?>
        <?php 
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => $no_of_posts,
                'order'          => 'DESC',  // 'DESC' for descending order, 'ASC' for ascending order
                'orderby'        => 'date',  // Order by post date
                'post__not_in'   => array($post->ID)
            );
            $other_posts_loop = new WP_Query( $args );
        ?>
        <?php if ($other_posts_layout == 'rows') {  ?>
        <div class="post_rows">
            <?php if ( $other_posts_loop->have_posts() ) : while ( $other_posts_loop->have_posts() ) : $other_posts_loop->the_post(); ?>
            <div class="post_row">
                <div class="post_row_grid">
                    <div class="meta_col">
                        <?php
                                $categories = get_the_category();
                                $separator = ' ';
                                $output = '';
                                if ( ! empty( $categories ) ) {
                                    foreach( $categories as $category ) {
                                        $output .= '<a class="btn_fourth ' . esc_html( $category->name ) . '" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                                    }
                                    echo trim( $output, $separator );
                                }
                            ?>
                    </div>
                    <div class="title_col">
                        <h4 class="post-title"><?php the_title(); ?></h4>
                    </div>
                    <div class="summary_col">
                        <p><?php the_excerpt(); ?></p>
                    </div>
                    <div class="link_col">
                        <a href="" download>Download</a>
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
            <?php endwhile; ?>
            <?php endif; ?>

        </div>

        <?php } elseif ($other_posts_layout == 'grid') { ?>

        <div class="post_grid <?php echo $columns; ?>">
            <?php if ( $other_posts_loop->have_posts() ) : while ( $other_posts_loop->have_posts() ) : $other_posts_loop->the_post(); ?>
            <div class="grid_cell fade_in_element">
                <!-- todo: remove one of these class names -->
                <a class="perma_wrap" href="<?php the_permalink(); ?>" class="grid_cell fade_in_element"
                    aria-label="Link to <?php the_title(); ?> project">
                    <!-- retreive metadata -->
                    <?php // $post_type = get_post_type( $post->ID )?>
                    <?php
                        foreach((get_the_category()) as $category) {
                            $postcat = $category->cat_ID;
                            $catname = $category->cat_name;
                        }
                    ?>
                    <div class="slideshow">
                        <?php if (have_rows('portfolio_images')) : ?>
                        <?php $i = 1; while (have_rows('portfolio_images')) : the_row(); ?>
                        <?php $image = get_sub_field('image'); ?>
                        <div class="portfolio_image_wrap">
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
                            if ($categories) {
                                foreach ($categories as $category) {
                                    // echo '<h6><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></h6>';
                                    echo '<h6>' . esc_html($category->name) . '</h6>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <?php } ?>
    </div>


    </div>
</section>

<?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>