<?php
$row = get_row_index() - 0;

$small_title = get_sub_field('small_title');
$use_logo = get_sub_field('use_logo');
$logo = get_sub_field('logo');
$big_title = get_sub_field('big_title');
$text_body = get_sub_field('text_body');

$layout = get_sub_field('layout');
$full_viewport_height = get_sub_field('full_viewport_height');

$use_as_non_header = get_sub_field('use_as_non_header');
$use_image = get_sub_field('use_image');
$background_or_header_image = get_sub_field('background_or_header_image');
$page_header_image = get_sub_field('page_header_image');
$background_colour = get_sub_field('background_colour');
$image_style = get_sub_field('image_styles');
$background_image = get_sub_field('background_image');
?>

<?php $post_id = get_the_ID(); ?>
<section
    class="<?php echo $background_colour; ?> page_header row-<?php echo $row; ?> <?php if ($post_id === 711) { ?> index <?php }
                                                                                                                    if ($full_viewport_height) { ?> full_viewport_height<?php }
                                                                                                                                                                    if ($layout == 'small_heading') { ?> small_heading<?php } ?>"
    style="<?php if ($background_or_header_image == true && $background_image) { ?> background-image: url('<?php echo $background_image; ?>'); <?php } ?>">
    <div class="container <?php echo $layout; ?>">

        <?php if ($layout == 'background_image') { ?>
        <!--  background image layout -->
        <div class="title_wrap">
            <?php if ($small_title) { ?><h5><?php echo $small_title; ?></h5><?php } ?>
            <h1 class=""><?php echo $big_title; ?></h1>
            <?php if ($text_body) { ?><p><?php echo $text_body; ?></p><?php } ?>
        </div>

        <?php }
        if ($layout == 'editorial') { ?>
        <!--  editorial layout -->
        <div class="title_wrap <?php if (is_front_page()) { ?>homepage_title_wrap<?php } ?>">
            <?php if ($small_title) { ?><h5><?php echo $small_title; ?></h5><?php } ?>
            <?php if ($use_logo == true) { ?>
            <div class="heading_logo_wrap">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/brandlabs-logo.svg'; ?>"
                    alt="brandlabs logo">
            </div>
            <?php } else { ?>
            <!-- check if it's the homepage. we will use JS to add a chosen animation class to this -->
            <!-- if it's not the homepage, add the standard animation for top level pages.  -->
            <h1
                class="<?php if (is_front_page()) { ?> homepage_title<?php } else { ?> ani_fade_up_fold_top_level<?php } ?>">
                <?php echo $big_title; ?></h1>
            <?php } ?>
            <?php if ($text_body) { ?>
            <p class="text_body landing_page_header_fade"><?php echo $text_body; ?></p>
            <?php } ?>
            <!-- content unique to brandlabs page -->
            <?php if (strpos($_SERVER['REQUEST_URI'], '/brand-labs') !== false) { ?>
            <p class="brandlabs_live landing_page_header_fade">(<img
                    src=<?php echo get_template_directory_uri() . '/assets/images/svg/bulletin-dot.svg'; ?>>Returning
                in 2024 )
            </p>
            <?php } ?>
            <img class="arrow_down landing_page_header_fade <?php if (strpos($_SERVER['REQUEST_URI'], '/brand-labs') !== false) { ?>  brandlabs_arrow<?php } ?>"
                src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-down-white.svg'; ?>"
                alt="arrow down">
        </div>
        <?php if ($use_image) { ?>
        <?php if ($background_or_header_image == false) { ?>
        <?php if ($page_header_image) { ?>
        <div class="image_wrap">
            <img class="<?php echo $image_style; ?>" src="<?php echo $page_header_image; ?>" alt=""
                class="page_header_image">
        </div>
        <?php } ?>
        <?php } ?>
        <?php } ?>

        <!-- two column layout -->
        <?php }
        if ($layout == 'two_columns') { ?>
        <!--  two column layout -->
        <div class="title_wrap">
            <?php if ($small_title) { ?><h6><?php echo $small_title; ?></h6><?php } ?>
            <h1><?php echo $big_title; ?></h1>
            <?php if ($text_body) { ?><p><?php echo $text_body; ?></p><?php } ?>
        </div>
        <div class="image_wrap">
            <img class="<?php echo $image_style; ?>" src="<?php echo $page_header_image; ?>" alt=""
                class="page_header_image">
        </div>
        <?php }
        if ($layout == 'small_heading') { ?>
        <div class="title_bar">
            <div class="title_bar_border"></div>
        </div>
        <div class="title_box">
            <div class="title_wrap">
                <?php if ($small_title) { ?>
                <p class="small_title fade_in_element"> <?php echo $small_title; ?></p>
                <?php } ?>
                <?php if ($big_title) { ?>
                <h2 class="title ani_fade_up_fold_top_level"> <?php echo $big_title; ?> </h2>
                <?php } ?>
            </div>
        </div>
        <?php }
        if ($layout == 'grid') { ?>
        <div class="background-image-container"></div>
        <div class="grid-outer-container">
            <div class="grid-inner-container">
                <!--  grid layout -->
                <div class="col-one">
                    <p class="small-text-one">Creating <br>Connections</p>
                    <p class="small-text-two">Competition <br>Now Open</p>
                    <div class="heading_logo_wrap small">
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/brandlabs-logo-white.svg'; ?>"
                            alt="brandlabs logo">
                    </div>

                </div>
                <div class="col-two">


                    <div class="heading_logo_wrap large">
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/brandlabs-logo-white.svg'; ?>"
                            alt="brandlabs logo">
                    </div>


                    <!-- <p class="text_body landing_page_header_fade">Brand Labs 2024 is here! Are you a small Welsh
                        business with big dreams? We're giving one ambitious brand the chance to win a custom brand
                        identity and website, no strings attached.</p> -->

                    <h2 class="text_body_large">Connecting ambitious brands with the resources needed to thrive</h2>



                </div>

            </div>

        </div>





        <?php } // grid if
        ?>



    </div>
</section>