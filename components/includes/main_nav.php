<!-- template for main nav -->

<nav class="main_nav">
    <ul>
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
            <a class="btn_anchor" href="<?php echo esc_url( $mainlink_url ); ?>"
                target="<?php echo esc_attr( $mainlink_target ); ?>"><?php echo esc_html( $mainlink_title ); ?></a>
            <?php if ($dropdown){?>

            <!-- todo: if full width dropdown:
            <div class="dropdown_area dropdown_full_wdith">
            <div class="container">
                <div class="dropdown_wrap">
                    <div class="top_level_button">
                        <?php 
                        $link = get_sub_field('top_level_button', 'option');
                        if( $link ): 
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="btn_anchor" href="<?php echo esc_url( $link_url ); ?>"
                            target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php endif; ?>
                    </div>
                    <?php $icons = get_sub_field('icons', 'option'); ?>
                    <div class="dropdown_list <?php if ($icons) { ?>icons_nav<?php } else { ?>no_icons<?php } ?>">
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
                        <a class="btn_anchor" href="<?php echo esc_url( $dropdownitem_url ); ?>"
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
                        <a class="" href="<?php echo esc_url( $dropdownitem_url ); ?>"
                            target="<?php echo esc_attr( $dropdownitem_target ); ?>"><?php echo esc_html( $dropdownitem_title ); ?></a>
                        <?php endif; ?>
                        <?php endwhile; ?>
                        <?php endif; ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div> -->

            <!-- todo: else -->
            <div class="dropdown_area dropdown_rel">
                <div class="dropdown_wrap">
                    <?php $icons = get_sub_field('icons', 'option'); ?>
                    <div class="dropdown_list <?php if ($icons) { ?>icons_nav<?php } else { ?>no_icons<?php } ?>">
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
                        <a class="btn_anchor" href="<?php echo esc_url( $dropdownitem_url ); ?>"
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
                        <a class="" href="<?php echo esc_url( $dropdownitem_url ); ?>"
                            target="<?php echo esc_attr( $dropdownitem_target ); ?>"><?php echo esc_html( $dropdownitem_title ); ?></a>
                        <?php endif; ?>
                        <?php endwhile; ?>
                        <?php endif; ?>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <?php } else { ?>

            <?php } ?>
        </li>

        <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?>
    </ul>
</nav>