<?php
    $add_header = get_sub_field('add_header');
    $big_title = get_sub_field('big_title');
    $small_title = get_sub_field('small_title');

    $address = get_field('text', 'option');
    $tel = get_field('tel', 'option');
    $email = get_field('email', 'option');
        
    $linkedin = get_field('linkedin', 'option');
    $instagram = get_field('instagram', 'option');

    $contact_image = get_sub_field('contact_image');
?>

<section class="section_contact_card <?php if ($add_header) { ?> add_header <?php } ?>">
    <div class="container">

        <?php if ($add_header) { ?>
        <div class="title_bar">
            <div class="title_bar_border"></div>
        </div>
        <div class="title_box">
            <div class="title_wrap">
                <?php if($small_title) { ?> <p class="small_title fade_in_element"> <?php echo $small_title; ?></p>
                <?php } ?>
                <?php if($big_title) { ?>
                <h2 class="title ani_fade_up_fold_top_level"><?php echo $big_title; ?></h2>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <div class="contact_card_grid landing_page_header_fade">

            <div class="links_wrap">
                <?php if(have_rows('links')) : while(have_rows('links')) : the_row(); ?>
                <?php $link = get_sub_field('link'); ?>
                <?php 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="btn_second" href="<?php echo esc_url( $link_url ); ?>"
                    target="<?php echo esc_attr( $link_target ); ?>">
                    <span><?php echo $link_title; ?><img
                            src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right-white.svg'; ?>"
                            alt="button arrow"></span>
                </a>
                <?php endwhile; endif; ?>
            </div>


            <div class="address_tel_email_wrap">
                <p class=""><?php echo $address; ?></p>
                <p class=""><?php echo $tel; ?></p>
                <p class=""><?php echo $email; ?></p>
            </div>

            <div class="socials_wrap">
                <a class="btn_second" href="https://linkedin.com/company/<?php echo $linkedin; ?>"
                    target="https://linkedin.com/company/<?php echo esc_attr( $linkedin ); ?>">
                    <span>Linkedin<img
                            src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right-white.svg'; ?>"
                            alt="button arrow">
                    </span>
                </a>
                <a class="btn_second" href="https://instagram.com/<?php echo $instagram; ?>"
                    target="https://instagram.com/<?php echo esc_attr( $instagram ); ?>">
                    <span>Instagram<img
                            src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right-white.svg'; ?>"
                            alt="button arrow">
                    </span>
                </a>
            </div>
            <?php if ($contact_image) { ?>
            <div class="image_wrap">
                <?php $bannerArgs = array(
                    'class' => '' ,
                    'id' => $contact_image,
                    'lazyload' => false
                );

                echo build_srcset('banner', $bannerArgs); ?>
            </div>
            <?php } ?>
        </div>

    </div>
</section>