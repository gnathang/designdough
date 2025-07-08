<?php 
$row = get_row_index() - 0;

$full_image = get_sub_field('full_width_image');
$image = get_sub_field('image');
$overlay = get_sub_field('overlay');
$textoverlay = get_sub_field('image_text_overlay');
$textposition = get_sub_field('image_text_position');
?>


<section class="full_width image_wrapper row-<?php echo $row; ?> fade-in fade-delay-<?php echo $row; ?>">
    <div <?php if ($full_image){?> class="full_width" <?php } else { ?> class="container" <?php } ?>>
        <div class="image-container">
            <div class="wrapper">
                <div class="image_area">
                    <img src="<?php echo $image; ?>" alt="" />
                </div>
                <?php if ($overlay){ ?>
                <div class="image_text_area <?php echo $textposition; ?>">
                    <div <?php if ($full_image){?> class="container" <?php } else { ?> class="grid_img" <?php } ?>>
                        <div class="image_text_area_bg">
                            <?php echo $textoverlay; ?>
                        </div>
                    </div>
                </div>
                <?php } else { ?><?php } ?>
            </div>
        </div>
    </div>
</section>