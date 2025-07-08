<!-- template for main nav -->

<?php 
    $address = get_field('text', 'option');
    $tel = get_field('tel', 'option');
    $email = get_field('email', 'option');
    $linkedin = get_field('linkedin', 'option');
    $instagram = get_field('instagram', 'option');
    $twitter = get_field('twitter', 'option');
?>

<nav class="modal_nav">
    <div class="modal_nav_wrap">
        <ul class="modal_nav_menu">
            <?php if( have_rows('menu', 'option') ): ?>
            <?php while( have_rows('menu', 'option') ): the_row(); ?>

            <?php $mainlink = get_sub_field('menu_top_level_link', 'option'); ?>
            <?php if( $mainlink ): 
            $mainlink_url = $mainlink['url'];
            $mainlink_title = $mainlink['title'];
            $mainlink_target = $mainlink['target'] ? $mainlink['target'] : '_self';
        ?>
            <?php $dropdown = get_sub_field('dropdown', 'option'); ?>

            <li id="nav_<?php echo get_row_index(); ?>"
                class="li_level_one <?php if ($dropdown){?>dropdown<?php } else { ?><?php } ?>">

                <?php if ($dropdown) { ?>

                <p class="p_level_one btn_anchor" href="<?php echo esc_url( $mainlink_url ); ?>"
                    target="<?php echo esc_attr( $mainlink_target ); ?>"><?php echo esc_html( $mainlink_title ); ?>
                </p>

                <div class="dropdown_area_modal dropdown_full_wdith">
                    <div class="container">
                        <div class="dropdown_wrap">

                            <!--  if we're choosing to add icons -->
                            <?php $icons = get_sub_field('icons', 'option'); ?>
                            <div
                                class="dropdown_list <?php if ($icons) { ?>icons_nav<?php } else { ?>no_icons<?php } ?>">
                                <?php if ($icons) { ?>
                                <?php if( have_rows('dropdown_menu_items', 'option') ): ?>
                                <?php while( have_rows('dropdown_menu_items', 'option') ): the_row(); ?>
                                <?php $itemicon = get_sub_field('menu_item_icon', 'option'); ?>
                                <?php $dropdownitem = get_sub_field('dropdown_menu_item_link', 'option');

                            if( $dropdownitem ): 
                                $dropdownitem_url = $dropdownitem['url'];
                                $dropdownitem_title = $dropdownitem['title'];
                                $dropdownitem_target = $dropdownitem['target'] ? $dropdownitem['target'] : '_self';
                                ?>

                                <a class="submenu_item_modal btn_anchor"
                                    href="<?php echo esc_url( $dropdownitem_url ); ?>"
                                    target="<?php echo esc_attr( $dropdownitem_target ); ?>">

                                    <?php $bannerArgs = array(
                                        'class' => '' ,
                                        'id' => $itemicon,
                                        'lazyload' => false
                                    );

                                    echo build_srcset('banner', $bannerArgs); ?>

                                    <h3><?php echo esc_html( $dropdownitem_title ); ?></h3>
                                </a>
                                <?php endif; ?>
                                <?php endwhile; ?>
                                <?php endif; ?>

                                <?php } else { ?>

                                <?php if( have_rows('dropdown_menu_items', 'option') ): ?>
                                <?php while( have_rows('dropdown_menu_items', 'option') ): the_row(); ?>
                                <?php  $dropdownitem = get_sub_field('dropdown_menu_item_link', 'option');
                                if( $dropdownitem ): 
                                $dropdownitem_url = $dropdownitem['url'];
                                $dropdownitem_title = $dropdownitem['title'];
                                $dropdownitem_target = $dropdownitem['target'] ? $dropdownitem['target'] : '_self';
                                ?>
                                <a class="submenu_item_modal btn_anchor"
                                    href="<?php echo esc_url( $dropdownitem_url ); ?>"
                                    target="<?php echo esc_attr( $dropdownitem_target ); ?>"><?php echo esc_html( $dropdownitem_title ); ?></a>
                                <?php endif; ?>
                                <?php endwhile; ?>
                                <?php endif; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php } else { ?>

                <a class="btn_anchor" href="<?php echo esc_url( $mainlink_url ); ?>"
                    target="<?php echo esc_attr( $mainlink_target ); ?>"><?php echo esc_html( $mainlink_title ); ?>
                </a>
                <?php } ?>
            </li>

            <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
        </ul>
        <div class="modal_nav_contact">
            <div class="contact_top">
                <h4>Want to discuss your next project?</h4>
                <spa class="give_us_a_call">
                    Give us a <a class="btn_simple" href="tel:<?php echo $tel; ?>">call</a>
                    or<br>
                    drop us an <a class="btn_simple" href="mailto:<?php echo $email; ?>">email</a>.
                    </span>
            </div>
            <div class="contact_bottom">
                <div class="socials_wrap">
                    <a href="<?php echo $instagram;?>">
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/instagram-white.svg';?>"
                            alt="instagram link">
                    </a>
                    <a href="<?php echo $linkedin; ?>">
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/linkedin-white.svg';?>"
                            alt="linkedin link">
                    </a>
                </div>
                <div class="contact_details_wrap">
                    <p class=""><?php echo $address; ?></p>
                    <div>
                        <a class="btn_simple" href="tel:<?php echo $tel; ?>"><?php echo $tel; ?></a>
                        <a class="btn_simple" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>