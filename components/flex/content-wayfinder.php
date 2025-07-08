<?php $row = get_row_index() - 0; ?>

<?php $big_title = get_sub_field('big_title'); ?>
<?php $small_title = get_sub_field('small_title'); ?>
<?php $intro_text_cols = get_sub_field('intro_text_cols'); ?>
<?php $intro_text_col_1 = get_sub_field('intro_text_col_1'); ?>
<?php $intro_text_col_2 = get_sub_field('intro_text_col_2'); ?>

<?php $three_columns = get_sub_field('three_columns'); ?>

<section class="section_wayfinder row-<?php echo $row; ?>">
    <div class="container">
        <div class="title_bar">
            <div class="title_bar_border"></div>
        </div>
        <div class="title_box">
            <div class="title_wrap fade_in_element">
                <?php if($small_title) { ?> <p class="small_title"><?php echo $small_title ?></p> <?php } ?>
                <?php if($big_title) { ?><h2 class="big_title ani_fade_up_fold title"><?php echo $big_title ?></h2>
                <?php } ?>
                <?php if($intro_text_cols == false && $intro_text_col_1) { ?><?php echo $intro_text_col_1 ?></h4>
                <?php } ?>
            </div>
        </div>

        <?php if($intro_text_cols && $intro_text_col_1) { ?>
        <div class="wayfinder_text_columns">
            <h4 class="intro_text fade_in_element"><?php echo $intro_text_col_1; ?></h4>
            <h4 class="intro_text fade_in_element"><?php echo $intro_text_col_2; ?></h4>
        </div>
        <?php } ?>

        <div class="wayfinder_grid <?php if($three_columns == true) { ?> three_columns <?php } ?>">
            <?php if(have_rows('signposts')) : while(have_rows('signposts')): the_row(); ?>

            <?php $title = get_sub_field('title'); ?>
            <?php $text_body = get_sub_field('text_body'); ?>
            <?php $link = get_sub_field('link'); ?>
            <?php $signpost_image = get_sub_field('signpost_image'); ?>
            <?php $signpost_image_mobile = get_sub_field('mobile_signpost_image'); ?>
            <?php if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
            <a class="signpost fade_in_element" href="<?php echo esc_url( $link_url ); ?>"
                target="<?php echo esc_attr( $link_target ); ?>">

                <?php if ( wp_is_mobile() ) : ?>
                <div class="image_wrap_mob" style="background-image: url('<?php echo $signpost_image_mobile ?>');">
                </div>
                <?php else : ?>
                <div class="image_bg">
                    <div class="image_wrap" style="background-image: url('<?php echo $signpost_image; ?>');">
                    </div>
                </div>
                <?php endif; ?>
                <div class="text_wrap">
                    <?php if($title) { ?>
                    <h3 class="btn_second">
                        <span><?php echo $title; ?><img
                                src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right-white.svg'; ?>"
                                alt="button arrow"></span>
                    </h3><?php } ?>
                    <?php if($text_body) { ?><p class="link_text"><?php echo $text_body; ?></p><?php } ?>
                </div>

                <?php /*
                if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="btn_default" href="<?php echo esc_url( $link_url ); ?>"
                    target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php endif; */ ?>
            </a>
            <?php endif; ?>
            <?php endwhile; endif; ?>
        </div>


    </div>
</section>