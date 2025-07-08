<?php $row = get_row_index() - 0; ?>

<?php $big_title = get_sub_field('big_title'); ?>
<?php $small_title = get_sub_field('small_title'); ?>
<?php $add_bios = get_sub_field('add_bios'); ?>

<section class="section_team row-<?php echo $row; ?> fade-in">
    <div class="container">

        <div class="title_wrap">
            <?php if($small_title) { ?> <h5><?php echo $small_title; ?></h5> <?php } ?>
            <?php if($big_title) { ?> <h2><?php echo $big_title; ?></h2> <?php } ?>
        </div>

        <div id="team_carousel" class="team_grid splide">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php if(have_rows('team_members')) : while(have_rows('team_members')) : the_row(); ?>
                    <?php $post_object = get_sub_field('team_member'); ?>
                    <?php if ($post_object) : ?>
                    <?php // override $post
                    $post = $post_object;
                    setup_postdata($post); ?>
                    <?php 
                        $name = get_the_title();
                        $role = get_field('role');
                        $image = get_field('image');
                        $linkedin = get_field('linkedin');
                        $email = get_field('email');
                        $bio = get_field('bio');
                        $row = get_row_index() - 0;
                    ?>

                    <!-- todo: add fade delays -->
                    <!-- fade-in fade-delay-<?php //echo $row; ?> -->
                    <li class="team_member_wrap splide__slide fade_in_element">
                        <div class="member_image" style="background-image: url('<?php echo $image; ?>');">
                            <?php if($add_bios) { ?>
                            <div class="team_member_overlay">
                                <h6 class="bio">View Bio</h6>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="member_profile_wrap">
                            <h4 class="member_name"><?php echo $name; ?></h4>
                            <h4 class="member_role"><?php echo $role; ?></h4>
                        </div>
                        <!-- <div class="member_socials_wrap">
                            <a class="anchor_second" href="<?php echo $linkedin; ?>"><img
                                    src="<?php echo get_template_directory_uri() . '/assets/images/svg/linkedin-black.svg';?>"
                                    alt="">
                            </a>
                            <a class="email_icon anchor_second" href="mailto:<?php echo $email; ?>"><img
                                    src="<?php echo get_template_directory_uri() . '/assets/images/svg/mail-black.svg';?>"
                                    alt="">
                            </a>
                        </div> -->

                        <?php if($add_bios) { ?>
                        <div class="team_member_modal">
                            <img class="member_modal_close"
                                src="<?php echo get_template_directory_uri() . '/assets/images/svg/close-icon.svg' ?>">

                            <div class="image_wrap">
                                <img class="member_image_modal" src="<?php echo $image; ?>">
                                <div class="member_info_wrap">
                                    <h6 class="member_name"><?php echo $name; ?></h6>
                                    <h6 class="member_role"><?php echo $role; ?></h6>
                                    <div class="member_socials_wrap">
                                        <a class="anchor_second" href="<?php echo $linkedin; ?>"><img
                                                src="<?php echo get_template_directory_uri() . '/assets/images/svg/linkedin-black.svg';?>"
                                                alt=""></a>
                                        <a class="email_icon anchor_second" href="mailto:<?php echo $email; ?>"><img
                                                src="<?php echo get_template_directory_uri() . '/assets/images/svg/mail-black.svg';?>"
                                                alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="text_wrap">
                                <?php if($bio) { echo $bio; } ?>
                            </div>
                        </div>
                        <?php } ?>

                    </li>

                    <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

    </div>
</section>