<?php 

    $row = get_row_index() - 0;
    
    $small_title = get_sub_field('small_title');
    $big_title = get_sub_field('big_title');
    $text_body = get_sub_field('text_body');

    $hero_style = get_sub_field('hero_style');

    $show_dots = get_sub_field('show_dots');
    $show_arrows = get_sub_field('show_arrows'); 
    
    $hero_image = get_sub_field('hero_image');
    $hero_video = get_sub_field('hero_video');

?>

<section class="hero row-<?php echo $row; ?> fade_in_element">

    <?php if($hero_style == 'video') { ?>
    <!--  video  -->
    <div class="video">
        <video autoplay muted loop class="video">
            <source src="<?php echo $hero_video; ?>" type="video/mp4">
        </video>

        <div class="title_wrap container">
            <?php if($small_title) { ?><h6><?php echo $small_title; ?></h6><?php } ?>
            <h1 class="header_title"><?php echo $big_title; ?></h1>
            <?php if($text_body) { ?><p><?php echo $text_body; ?></p><?php } ?>
        </div>
    </div>

    <?php } if($hero_style == 'slider') { ?>
    <!--  slides -->

    <?php if(have_rows('slides')) : ?>
    <div
        class="slider lazy <?php if ($show_dots) { ?> show_dots <?php } ?> <?php if ($show_arrows) { ?> show_arrows <?php } ?>">

        <?php while(have_rows('slides')) : the_row(); ?>
        <?php
            $image_or_video = get_sub_field('image_or_video');
            $image = get_sub_field('image');
            $video = get_sub_field('video');
            $big_title = get_sub_field('big_title');
            $small_title = get_sub_field('small_title');
            $text_body = get_sub_field('text_body');
            $page_link = get_sub_field('page_link');
        ?>



        <div class="slide">
            <!-- check if the slide is an image or a video -->
            <?php if($image_or_video == false ) { ?>
            <div class="slide_image_wrap" style="background-image: url(<?php echo $image; ?>);">
                <?php /* $bannerHero = array(
                    'class' => '' ,
                    'id' => $hero_image,
                    'lazyload' => false
                );
             echo build_srcset('medium', $bannerHero); */ ?>
            </div>
            <?php } else { ?>
            <video autoplay muted loop class="homepage_video">
                <source src="<?php echo $video; ?>" type="video/mp4">
            </video>
            <?php } ?>
            <div class="slide_text_wrap">
                <div class="container">
                    <div class="title_wrap">
                        <?php if($small_title) { ?><h6><?php echo $small_title; ?></h6><?php } ?>
                        <h1 class="header_title ani_fade_up"><?php echo $big_title; ?></h1>
                    </div>
                    <?php if($text_body) { ?><p><?php echo $text_body; ?></p><?php } ?>
                </div>
            </div>
        </div>
        <?php  endwhile; ?>
    </div>
    <?php endif; ?>

    <?php } if($hero_style == 'image') { ?>
    <!--  image -->
    <div class="hero_image" style="background-image: url('<?php echo $hero_image; ?>'); ">
        <div class="content_wrap container">
            <div class="title_wrap">
                <?php if($small_title) { ?><h6><?php echo $small_title; ?></h6><?php } ?>
                <h1 class="header_title"><?php echo $big_title; ?></h1>
            </div>
            <?php if($text_body) { ?><p><?php echo $text_body; ?></p><?php } ?>
        </div>
    </div>

    <?php } if($hero_style == 'editorial') { ?>
    <!--  editorial style -->
    <div class="hero_editorial row-1 container">
        <div class="title_wrap">
            <?php if($small_title) { ?><h6><?php echo $small_title; ?></h6><?php } ?>
            <h1 class="header_title ani_fade_up_letter"><?php echo $big_title; ?></h1>
        </div>
        <?php if($text_body) { ?><p class="text_body"><?php echo $text_body; ?></p><?php } ?>
        <?php if($hero_image)  { ?>
        <div class="image_wrap">
            <img class="<?php echo $image_style; ?>" src="<?php echo $hero_image; ?>" alt="" class="page_header_image">
        </div>
        <?php } ?>
    </div>

    <?php } ?>

</section>