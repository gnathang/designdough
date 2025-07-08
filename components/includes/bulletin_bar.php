<?php 
    $bulletin_title = get_field('bulletin_title', 'option');
?>

<?php
$post_id = get_the_ID();
if ( $post_id === 711 || is_single() || strpos($_SERVER['REQUEST_URI'], '/blog') !== false ) { ?>

<!-- render nothing on the 'work' page -->

<?php } else { ?>

<div class="bulletin_bar landing_page_header_fade">
    <div class="container">
        <div
            class="bulletin_bar_wrap <?php if (strpos($_SERVER['REQUEST_URI'], '/brand-labs') !== false) { ?> black_text<?php } ?>">

            <div class="bulletin_title_wrap">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/bulletin-dot.svg'; ?>"
                    alt="bulletin dot">
                <p><?php echo $bulletin_title; ?></p>
            </div>

            <div class="bulletin_content_scroll">
                <div id="bulletin_scroll" class="splide">
                    <div class="splide__track">
                        <div class="splide__list">
                            <!-- featured news posts -->
                            <p class="splide__slide"> &nbsp;&middot; &nbsp;LATEST NEWS</p>
                            <?php if(have_rows('featured_news', 'option')) : while(have_rows('featured_news', 'option')) : the_row(); ?>
                            <?php $post_object = get_sub_field('news_post'); ?>
                            <?php if ($post_object) : ?>
                            <?php // override $post
                            $post = $post_object;
                            setup_postdata($post); ?>
                            <?php $post_type = get_post_type( $post->ID )?>
                            <div class="bulletin_wrap splide__slide">
                                &nbsp; &middot; &nbsp;
                                <a href="<?php the_permalink(); ?>" class="bulletin_title">
                                    <?php the_title(); ?>
                                </a>
                            </div>
                            <?php wp_reset_postdata(); ?>
                            <?php endif; endwhile; endif; ?>

                            <!-- latest blogs -->
                            <p class="splide__slide">&nbsp; &middot; &nbsp;NEW BLOG</p>
                            <?php if(have_rows('latest_blogs', 'option')) : while(have_rows('latest_blogs', 'option')) : the_row(); ?>
                            <?php $post_object = get_sub_field('blog_post'); ?>
                            <?php if ($post_object) : ?>
                            <?php // override $post
                            $post = $post_object;
                            setup_postdata($post); ?>
                            <?php $post_type = get_post_type( $post->ID )?>
                            <div class="bulletin_wrap splide__slide">
                                &nbsp; &middot; &nbsp;
                                <a href="<?php the_permalink(); ?>" class="bulletin_title">
                                    <?php the_title(); ?>
                                </a>
                            </div>
                            <?php wp_reset_postdata(); ?>
                            <?php endif; endwhile; endif; ?>

                            <!-- portfolio -->
                            <p class="splide__slide">&nbsp; &middot; &nbsp;PORTFOLIO</p>
                            <?php if(have_rows('portfolio', 'option')) : while(have_rows('portfolio', 'option')) : the_row(); ?>
                            <?php $post_object = get_sub_field('portfolio_item'); ?>
                            <?php if ($post_object) : ?>
                            <?php // override $post
                            $post = $post_object;
                            setup_postdata($post); ?>
                            <?php $post_type = get_post_type( $post->ID )?>
                            <div class="bulletin_wrap splide__slide">
                                &nbsp; &middot; &nbsp;
                                <a href="<?php the_permalink(); ?>" class="bulletin_title">
                                    <?php the_title(); ?></a>
                            </div>
                            <?php wp_reset_postdata(); ?>
                            <?php endif; endwhile; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>