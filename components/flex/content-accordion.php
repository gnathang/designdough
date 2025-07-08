<?php
$row = get_row_index() - 0;
$full_width = get_sub_field('full_width');

$title = get_sub_field('title');
$subtitle = get_sub_field('sub_title');
$layout = get_sub_field('layout');
// end
?>

<section class="section_accordion row-<?php echo $row; ?> fade-in">

    <?php if(!$full_width ) { ?>
    <div class="container">
        <?php } ?>

        <div class="accord_container <?php echo $layout; ?>">
            <?php if($title) {?><h2 class=""><?php echo $title; ?></h2><?php }?>
            <?php if($subtitle) {?><h4 class=""><?php echo $subtitle; ?></h4><?php }?>

            <?php if(have_rows('accordion_rows')) : while(have_rows('accordion_rows')) : the_row(); ?>
            <?php 
            $title = get_sub_field('title');
            $text_body = get_sub_field('text_body');
            $use_image = get_sub_field('use_image');
            $image = get_sub_field('image');
            ?>
            <div class="accord_wrap fade_in_element">
                <div class="accord_head">
                    <h4><?php echo $title; ?></h3>
                </div>
                <div class="accord_image_wrap">
                    <img class="accordion_down_arrow"
                        src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-down-white.svg'; ?>"
                        alt="arrow">
                    <?php if ($use_image) { ?>
                    <img src="<?php echo $image ?>" alt="accordion image">
                    <?php } ?>
                </div>
                <div class="accord_body">
                    <?php echo $text_body; ?>
                </div>
            </div>

            <?php endwhile; endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>

        <?php if(!$full_width) { ?>
    </div>
    <?php } ?>

</section>