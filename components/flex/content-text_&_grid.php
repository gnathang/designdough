<?php 
    $row = get_row_index() - 0;
    
    $small_title = get_sub_field('small_title');
    $big_title = get_sub_field('big_title');
    $intro_text = get_sub_field('intro_text');

    $background_colour = get_sub_field('background_colour');
    $three_or_four_cols = get_sub_field('three_or_four_cols');
    $center_content = get_sub_field('center_content'); 
?>

<!-- todo: change this  -->
<section
    class="section_text_and_grid row-<?php echo $row; ?> <?php if($background_colour == 'grey') { ?>grey<?php } else { }?>">
    <div class="container">

        <div class="title_bar">
            <div class="title_bar_border"></div>
        </div>

        <?php if($big_title) { ?>
        <div class="title_box">
            <div class="title_bar_border"></div>
            <div class="title_wrap">
                <p class="small_title fade_in_element"><?php echo $small_title; ?></p>
                <h2 class="big_title ani_fade_up_fold"><?php echo $big_title; ?></h2>
                <?php if($intro_text) { ?> <div class="intro_text fade_in_element"><?php echo $intro_text; ?></div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <?php if( have_rows('grid') ) : ?>
        <div
            class="grid <?php if($column_count == 'two') { ?> two_col <?php } elseif($column_count == 'three') { ?> three_col <?php } elseif($column_count == 'four') { ?> four_col <?php } else { ?> five_col <?php } ?>">
            <?php while( have_rows('grid') ) : the_row(); ?>
            <?php $row = get_row_index(); ?>

            <?php $image = get_sub_field('image'); ?>
            <?php $title = get_sub_field('title'); ?>
            <?php $intro_text = get_sub_field('intro_text'); ?>

            <?php $choose_button = get_sub_field('choose_button'); ?>

            <?php $link = get_sub_field('link'); ?>

            <?php $modal_label = get_sub_field('modal_label'); ?>
            <?php $modal_title = get_sub_field('modal_title'); ?>
            <?php $modal_body = get_sub_field('modal_body'); ?>
            <?php $modal_bg_colour = get_sub_field('modal_bg_colour'); ?>

            <?php $download_label = get_sub_field('download_label'); ?>
            <?php $download = get_sub_field('download'); ?>

            <!-- todo: add modal functionality -->
            <div class="grid_cell fade_in_element fade-delay-<?php echo $row; ?>">
                <?php if($image) { ?>
                <img src="<?php echo $image; ?>">
                <?php } ?>

                <?php 
                // if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="btn_second" href="<?php echo esc_url( $link_url ); ?>"
                    target="<?php echo esc_attr( $link_target ); ?>">
                    <span><?php echo $title; ?><img
                            src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right-white.svg'; ?>"
                            alt="button arrow"></span>
                </a>
                <?php // endif; ?>


                <p><?php echo $intro_text; ?></p>

                <?php if($choose_button == 'link') { ?>

                <?php if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                <a class="btn_default open_grid_modal" href="<?php echo esc_url( $link_url ); ?>"
                    target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php endif; ?>


                <!-- ty hafan old button -->
                <a href="<?php echo $link['url'] ?>" class="btn_default <?php echo $button_style; ?>"
                    target="<?php echo $link['target'] ? $link['target'] : '_self'; ?>"><?php echo $link['title']; ?></a>


                <?php } if($choose_button == 'download') { ?>
                <a target="_blank" href="<?php echo $download; ?>"
                    class="btn_default download_button"><?php echo $button_label; ?></a>
                <?php } if($choose_button == 'modal') { ?>
                <a class="btn_default open_grid_modal"><?php echo $modal_label; ?></a>
                <?php } elseif ($choose_button == 'none') { ?>
                <!-- do nothing -->
                <?php } ?>
            </div>

            <div
                class="grid_modal <?php if ($modal_bg_colour == false) { ?> bg_yellow <?php } else { ?> bg_slateblue <?php } ?>">
                <div class="container">
                    <img class="modal_close"
                        src="<?php echo get_template_directory_uri() . '/assets/images/svg/close-icon.svg' ?>">
                    <h5><?php echo $title; ?></h5>
                    <h3><?php echo $modal_title; ?></h3>
                    <p><?php echo $modal_body; ?></p>
                </div>
            </div>

            <?php wp_reset_postdata(); ?>
            <?php endwhile;?>
        </div>
        <?php endif; ?>

    </div>
</section>