<?php $big_title = get_sub_field('big_title'); ?>
<?php $small_title = get_sub_field('small_title'); ?>
<?php $intro_text = get_sub_field('intro_text'); ?>
<?php $layout = get_sub_field('layout'); ?>
<?php $row = get_row_index() - 0; ?>


<section class="section_info_cards row-<?php echo $row; ?>">
    <div class="container">
        <div class="info_cards_container">
            <div class="title_wrap fade_in_element">
                <?php if($small_title) { ?> <p class="small_title"><?php echo $small_title; ?></p><?php } ?>
                <?php if($big_title) { ?> <h2 class="big_title"><?php echo $big_title; ?></h2><?php } ?>
                <?php if($intro_text) { ?> <h4 class="intro_text"><?php echo $intro_text; ?></h4><?php } ?>
            </div>
            <?php 
                $cards = get_sub_field('cards', $post->ID);
                $rows = count($cards);
            ?>

            <div
                class="info_cards_grid <?php if ($layout == 'staggered') { ?> <?php if($rows >= 8) { ?>staggered 20_rows <?php } else if ($rows >= 6){ ?>staggered 16_rows <?php } else { ?>staggered 12_rows<?php } } ?>">
                <?php if(have_rows('cards')) : while(have_rows('cards')) : the_row(); ?>
                <?php $card_title = get_sub_field('card_title'); ?>
                <?php $card_text_body = get_sub_field('card_text_body'); ?>
                <?php $remove_uppercase = get_sub_field('remove_uppercase'); ?>
                <?php $make_body_text_bigger = get_sub_field('make_body_text_bigger'); ?>
                <?php $link = get_sub_field('link'); ?>
                <?php $card_icon = get_sub_field('card_icon'); ?>
                <?php $card_number = get_sub_field('card_number'); ?>
                <?php $card_row = get_row_index() - 0; ?>

                <div class="card fade_in_element">
                    <?php if($card_number) { ?>
                    <h4>0<?php echo $card_row?></h4>
                    <?php } ?>
                    <div class="card_title_wrap">
                        <?php if($card_icon) { ?>
                        <img src="<?php echo $card_icon; ?>" alt="info card icon">
                        <?php } ?>
                        <h3 class="card_title <?php if($remove_uppercase) { ?> remove_uppercase<?php } ?>">
                            <?php echo $card_title; ?></h3>
                    </div>
                    <?php if($make_body_text_bigger) { ?>
                    <h4 class="card_main_body"><?php echo $card_text_body; ?></h4>
                    <?php } else { ?>
                    <p class="card_main_body"><?php echo $card_text_body; ?></p>
                    <?php } ?>
                    <?php 
                        if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a class="btn_third" href="<?php echo esc_url( $link_url ); ?>"
                        target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?>
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right-slant.svg'; ?>"
                            alt="arrow-right-slant" /></a>
                    <?php endif; ?>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>

</section>