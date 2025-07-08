<?php
$row = get_row_index() - 0;

$title = get_sub_field('title');
$subtitle = get_sub_field('sub_title');
$content = get_sub_field('text_area');
$link = get_sub_field('link');
$image = get_sub_field('image');
$reverse = get_sub_field('reverse_image_and_text');


// end
?>



<section class="full_width image-text-col row-<?php echo $row; ?> fade-in ">

    <div class="container">


        <div class="wrap_<?php if ($reverse){?>image_right<?php } else { ?>image_left<?php } ?> ">
            <div class="content">
                <div class="one_half image">

                    <?php $bannerArgs = array(
                            'class' => '' ,
                            'id' => $image,
                            'lazyload' => false
                    );
                    echo build_srcset('banner', $bannerArgs); ?>

                </div>

                <div class="one_half text">
                    <?php if($title) {?><h2 class=""><?php echo $title; ?></h2><?php }?>
                    <?php if($subtitle) {?><h4 class=""><?php echo $subtitle; ?></h4><?php }?>
                    <?php if($content) {?><?php echo $content; ?><?php }?>
                    <?php if($link) {?><a href="<?php echo $link['url'] ?>" class="btn_default"
                        target="<?php echo $link['target'] ? $link['target'] : '_self'; ?>"><?php echo $link['title']; ?></a><?php }?>

                </div>
            </div>
        </div>




    </div>
</section>