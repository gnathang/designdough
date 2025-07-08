<?php
    $row = get_row_index() - 0;
    
    $banner_type = get_sub_field('banner_type');
    $link = get_sub_field('link');
    $cta_text = get_sub_field('cta_text');

    $small_title = get_sub_field('small_title');
    $big_title = get_sub_field('big_title');
    $intro_text = get_sub_field('intro_text');
    $cta_image = get_sub_field('image');
    
    $links = get_sub_field('links');

?>

<section class="section_cta_banner row-<?php echo $row; ?>">
    <div class="container">


        <?php if($banner_type == 'skinny') { ?>

        <div class="cta_skinny">
            <div class="text_wrap">
                <h3 class="cta_text"><?php echo $cta_text; ?></h3>
            </div>
            <div class="links_wrap">
                <?php if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="btn_default" href="<?php echo esc_url( $link_url ); ?>"
                    target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php endif; ?>
            </div>
        </div>

        <?php } if($banner_type == 'text_image') { ?>
        <div class="cta_text_image fade_in_element">
            <div class="image_wrap">
                <?php $bannerArgs = array(
                'class' => '' ,
                'id' => $cta_image,
                'lazyload' => false
            );
            echo build_srcset('square', $bannerArgs); ?>
            </div>
            <div class="text_wrap">
                <div class="title_wrap">
                    <?php if($small_title) { ?><p class="small_title"><?php echo $small_title; ?></p><?php } ?>
                    <?php if($big_title) { ?><h2 class="big_title"><?php echo $big_title; ?></h2><?php } ?>
                    <?php if($intro_text) { ?><h4 class="intro_text"><?php echo $intro_text; ?></h4><?php } ?>
                </div>
                <div class="links_wrap">
                    <?php if(have_rows('links')) : while(have_rows('links')) : the_row();?>
                    <?php $link = get_sub_field('link'); ?>
                    <?php if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                    <a class="btn_default" href="<?php echo esc_url($link['url']); ?>"
                        target="<?php echo esc_attr($link['target']); ?>"><span><?php echo esc_html($link['title']); ?></span></a>
                    <?php endif; ?>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>


        <?php } else if($banner_type == 'text_cols') { ?>

        <?php if($big_title) { ?><h2 class="big_title"><?php echo $big_title; ?></h2><?php } ?>
        <div class="cta_text_cols">
            <div class="text_wrap">
                <?php if($small_title) { ?><h6 class="small_title"><?php echo $small_title; ?></h6><?php } ?>
                <?php if($intro_text) { ?><p class="intro_text"><?php echo $intro_text; ?></p><?php } ?>
            </div>
            <div class="links_wrap">
                <?php if(have_rows('links')) : while(have_rows('links')) : the_row();?>
                <?php $link = get_sub_field('link'); ?>
                <?php if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="btn_second" href="<?php echo esc_url( $link_url ); ?>"
                    target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?>
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-next.svg'; ?>"
                        alt="arrow-right" />
                </a>
                <?php endif; ?>
                <?php endwhile; endif; ?>
            </div>

        </div>
        <?php } ?>


    </div>
</section>