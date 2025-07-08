<?php
    $row = get_row_index() - 0; 

    $small_title = get_sub_field('small_title');
    $big_title = get_sub_field('big_title');
    $smaller_title = get_sub_field('smaller_title');
    $intro_text = get_sub_field('intro_text');
    $link = get_sub_field('link');
    $layout = get_sub_field('layout');
?>

<section class="section_text_image row-<?php echo $row; ?>">
    <div class="container">
        <?php
            $row = get_sub_field('columns', $post->ID);
            if ($row < 1) {
                $rows = 0;
            } else {
                $rows = count($row);
            }
        ?>

        <?php if ($layout == 'columns') { ?>

        <div class="title_wrap">
            <?php if($small_title) { ?><p class="small_title"><?php echo $small_title; ?></p><?php } ?>
            <?php if($big_title) { ?><h2 class="big_title"><?php echo $big_title; ?></h2><?php } ?>
            <?php if($intro_text) { ?><h4 class="intro_text"><?php echo $intro_text; ?></h4><?php } ?>
            <?php if($link) { ?>
            <a class="btn_default" href="<?php echo esc_url($link['url']); ?>"
                target="<?php echo esc_attr($link['target']); ?>"
                aria-label="link to <?php echo esc_html($link['title']); ?>"><span><?php echo esc_html($link['title']); ?></span></a>
            <?php } ?>
        </div>

        <div class="text_image_columns column_count-<?php echo $rows; ?>">
            <?php if (have_rows('columns')) : while (have_rows('columns')) : the_row(); ?>
            <?php if (get_row_layout() == 'column') : ?>

            <?php $title = get_sub_field('title'); ?>
            <?php $body = get_sub_field('body'); ?>
            <?php $image = get_sub_field('image'); ?>
            <?php $link = get_sub_field('link'); ?>

            <div class="text_image_col column-<?php echo get_row_index(); ?>">
                <?php if($title) { ?>
                <h3 class="col_title"><?php echo $title; ?></h3>
                <?php } ?>
                <?php if($body) { ?>
                <div class="col_body"><?php echo $body; ?></div>
                <?php } ?>
                <?php if($image) { ?>
                <!-- todo: fix the srcset -->
                <div class="col_image">
                    <?php $bannerOne = array(
                            'class' => '',
                            'id' => $image,
                            'lazyload' => false
                        );
                        echo build_srcset('square', $bannerOne); ?>
                </div>
                <?php } ?>
            </div>

            <?php endif; ?>
            <?php endwhile; endif; ?>
        </div>

        <?php } elseif ($layout == 'editorial') { ?>

        <div class="title_wrap <?php if ($intro_text) { ?>with_intro_text<?php } ?> fade_in_element">
            <?php if($small_title) { ?><p class="small_title"><?php echo $small_title; ?></p><?php } ?>
            <?php if($big_title) { ?><h2 class="big_title <?php if($smaller_title) { ?> smaller_title<?php } ?>">
                <?php echo $big_title; ?></h2><?php } ?>
            <?php if($intro_text) { ?><div class="intro_text"><?php echo $intro_text; ?></div><?php } ?>
            <?php if($link) { ?>
            <a class="btn_default" href="<?php echo esc_url($link['url']); ?>"
                target="<?php echo esc_attr($link['target']); ?>"
                aria-label="link to <?php echo esc_html($link['title']); ?>"><span><?php echo esc_html($link['title']); ?></span></a>
            <?php } ?>
        </div>

        <div class="text_image_editorial">
            <?php if(have_rows('items')) : while(have_rows('items')) :the_row(); ?>

            <?php if (get_row_layout() == 'text') { ?>

            <?php $title = get_sub_field('title'); ?>
            <?php $body = get_sub_field('body'); ?>
            <?php $link = get_sub_field('link'); ?>

            <div class="item_wrap fade_in_element row-<?php echo get_row_index(); ?>">
                <div class="text_wrap">
                    <?php if($title) { ?>
                    <div class="title_wrap">
                        <h2 class="big_title"><?php echo $title; ?></h2>
                    </div>
                    <?php } ?>
                    <?php if($body) { ?>
                    <div class="text_body_wrap">
                        <p><?php echo $body; ?></p>
                    </div>
                    <?php } ?>
                    <?php if($link) { ?>
                    <a class="btn_default" href="<?php echo esc_url($link['url']); ?>"
                        target="<?php echo esc_attr($link['target']); ?>"
                        aria-label="link to <?php echo esc_html($link['title']); ?>"><span><?php echo esc_html($link['title']); ?></span></a>
                    <?php } ?>
                </div>
            </div>

            <?php } elseif (get_row_layout() == 'image') { ?>

            <?php $image = get_sub_field('image'); ?>
            <?php $portrait_or_landscape = get_sub_field('portrait_or_landscape'); ?>
            <!-- logic for parallax -->
            <!-- <?php if( get_row_index() % 2 == 0) { ?> parallax_slow <?php } else { ?> parallax <?php } ?>  -->
            <div class="item_wrap row-<?php echo get_row_index(); ?> fade_in_element">
                <!-- todo: fix the srcset -->
                <div class="ani_background_reveal"></div>
                <?php if($portrait_or_landscape) { ?>
                <div class="image_wrap">
                    <?php $bannerOne = array(
                            'class' => 'border_radius_small',
                            'id' => $image,
                            'lazyload' => false
                        );
                    echo build_srcset('portrait', $bannerOne); ?>
                </div>
                <?php } else { ?>
                <div class="image_wrap">
                    <?php $bannerOne = array(
                            'class' => 'border_radius_small',
                            'id' => $image,
                            'lazyload' => false
                        );
                    echo build_srcset('landscape', $bannerOne); ?>
                </div>
                <?php } ?>
            </div>

            <?php } ?>

            <?php endwhile; endif; ?>
        </div>

        <?php } ?>

    </div>
</section>