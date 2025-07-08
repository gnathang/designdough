<?php $quotes_layout = get_sub_field('quotes_layout'); ?>

<?php $big_title = get_sub_field('big_title'); ?>
<?php $small_title = get_sub_field('small_title'); ?>
<?php $intro_text = get_sub_field('intro_text'); ?>
<?php $row = get_row_index() - 0; ?>

<section class="section_testimonials row-<?php echo $row; ?>">
    <div class="container">
        <div class="title_wrap">
            <?php if($small_title) { ?> <p class="small_title"><?php echo $small_title ?></p> <?php } ?>
            <?php if($big_title) { ?><h2 class="title ani_fade_up_fold"><?php echo $big_title ?></h2><?php } ?>
            <?php if($intro_text) { ?><h4 class="intro_text"><?php echo $intro_text ?></h4><?php } ?>
        </div>

        <?php if($quotes_layout == 'slider') { ?>
        <?php $show_dots_tst = get_sub_field('show_dots'); ?>
        <?php $show_arrows_tst = get_sub_field('show_arrows'); ?>

        <div id="testimonials_carousel" class="bg_image_slides splide">
            <div class="splide__track">
                <ul class="splide__list testimonials_splide_list">
                    <?php if(have_rows('quote_slides')) : while(have_rows('quote_slides')) :the_row(); ?>
                    <?php 
                        $background_image = get_sub_field('background_image');
                        $background_image_mob = get_sub_field('background_image_mob');
                        $logo = get_sub_field('logo');
                        $quote = get_sub_field('quote');
                        $name = get_sub_field('name');
                        $role = get_sub_field('job_title');
                        $big_quote_marks = get_sub_field('big_quote_marks');
                        $quote_title = get_sub_field('quote_title');
                    ?>

                    <li class="splide__slide rel_wrap test_slide fade_in_element fade-delay-<?php echo get_row_index(); ?>"
                        role="slider">
                        <div class="slide_box">
                            <div class="quotation_bg_wrap">
                                <?php if($big_quote_marks) { ?>
                                <img class="quotation_marks"
                                    src="<?php echo get_template_directory_uri() . '/assets/images/svg/quotation-marks-yellow.svg'; ?>"
                                    alt="quotation marks">
                                <?php } ?>
                                <?php if($logo) { ?>
                                <img class="logo" src="<?php echo $logo; ?>" alt="client logo">
                                <?php } ?>
                                <p class="quote"><?php echo $quote; ?></p>
                                <div class="quoter_wrap">
                                    <p class="name"><?php echo $name; ?></p>
                                    <?php if ($role) { ?>
                                    <p class="role">
                                        <?php echo $role; ?></p>
                                    <?php } ?>


                                    <?php 
                                    $link = get_sub_field('link');
                                    if( $link ):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                    <a class="btn_simple" href="<?php echo esc_url( $link_url ); ?>"
                                        target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </li>

                    <?php endwhile; endif; ?>
                </ul class="splide__list">
            </div class="splide__track">
        </div>

        <?php } if($quotes_layout == 'two_col_text') { ?>
        <?php $show_dots = get_sub_field('show_dots'); ?>
        <?php $show_arrows = get_sub_field('show_arrows'); ?>
        <div
            class="quotation_grid slider lazy <?php if ($show_dots_tst) { ?> show_dots <?php } ?> <?php if ($show_arrows_tst) { ?> show_arrows <?php } ?>">
            <?php if(have_rows('quote_slides')) : while(have_rows('quote_slides')) : the_row(); ?>
            <?php 
            $background_image = get_sub_field('background_image');
            $background_image_mob = get_sub_field('background_image_mob');
            $quote = get_sub_field('quote');
            $name = get_sub_field('name');
            $role = get_sub_field('job_title'); 
            $quoter_logo = get_sub_field('quoter_logo');
            $quote_title = get_sub_field('quote_title');
            $big_quote_marks = get_sub_field('big_quote_marks');
        ?>
            <div class="quotation_grid_wrap">
                <div class="quote_title">
                    <?php if($quote_title) { ?><h2><?php echo $quote_title; ?></h2> <?php } ?>
                </div>
                <div class="quote_wrap">
                    <?php if($big_quote_marks == true) { ?>
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/quotation-marks-yellow.svg';?>"
                        alt="quotation marks">
                    <?php } ?>
                    <h6 class="quote"><?php echo $quote; ?></h6>
                    <div class="logo_and_quoter_wrap">
                        <?php if($quoter_logo) { ?>
                        <div class="quoter_logo">
                            <img src="<?php echo $quoter_logo; ?>">
                        </div>
                        <?php } ?>
                        <div class="quoter_wrap">
                            <h6 class=""><?php echo $name; ?></h6>
                            <h6 class="bolden"><?php echo $role; ?></h6>
                        </div>
                    </div>
                </div>
            </div>

            <?php endwhile; endif; ?>
        </div>
        <?php } ?>
    </div>
</section>

<!-- Add a container for the custom cursor arrows -->
<!-- <div id="custom-cursor">
    <img src="<?php echo get_template_directory_uri() . '/assets/images/svsg/arrow-right-white.svg';?>" id="right-arrow"
        alt="Right Arrow">
    <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/facebook-white.svg';?>" id="left-arrow"
        alt="Left Arrow">
</div> -->