<?php 
    $row = get_row_index() - 0; 

    $small_title = get_sub_field('small_title');
    $big_title = get_sub_field('big_title');
    $intro_text = get_sub_field('intro_text');
?>

<!-- todo: implement background image behind the entire flex  -->
<section class="section_timeline_journey row-<?php echo $row; ?> fade-in">
    <div class="container">
        <div class="title_wrap">
            <?php if($small_title) { ?><h5><?php echo $small_title; ?></h5><?php } ?>
            <?php if($big_title) { ?><h2><?php echo $big_title; ?></h2><?php } ?>
        </div>
        <?php if($intro_text) { ?><div class="intro_text_wrap"><?php echo $intro_text; ?></div><?php } ?>

        <div class="timeline_journey_container">
            <?php if(have_rows('timeline_steps')) : while(have_rows('timeline_steps')) : the_row(); ?>

            <?php 
                $title = get_sub_field('title');
                $text_body = get_sub_field('text_body');
                $date = get_sub_field('date');
                $timeline_image = get_sub_field('timeline_image');
                $icon = get_sub_field('icon');
                $reverse_cols = get_sub_field('reverse_cols');
            ?>

            <div
                class="timeline_step_wrap <?php if ($reverse_cols == true) { ?> reverse <?php } ?> fade-in fade-in-delay-1">

                <div class="text_wrap">
                    <?php if($icon) { ?>
                    <img src="<?php echo $icon; ?>" alt="timeline stage icon" class="">
                    <?php } ?>
                    <h4><?php echo $date; ?></h4>
                    <h3><?php echo $title; ?></h3>
                    <p><?php echo $text_body; ?></p>
                </div>
                <!-- todo: fix srcset problem! -->
                <div class="image_wrap" style="background-image: url('<?php echo $timeline_image; ?>');">

                </div>
            </div>
            <?php endwhile; endif;?>
        </div>

    </div>
</section>