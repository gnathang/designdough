<?php 
$row = get_row_index() - 0;

$full_video = get_sub_field('full_width_video');
$video = get_sub_field('video');
$preview = get_sub_field('preview_image');
$autoplay = get_sub_field('autoplay');
$overlay = get_sub_field('overlay');
$textoverlay = get_sub_field('video_text_overlay');
$textposition = get_sub_field('video_text_position');

$native_or_iframe = get_sub_field('native_or_iframe');
$video_file = get_sub_field('video_file');

?>

<section class="full_width section_video landing_page_header_fade" id="row-<?php echo $row; ?>">

    <?php if($native_or_iframe == false) { ?>

    <div <?php if ($full_video){?> class="full_width" <?php } else { ?> class="container" <?php } ?>>
        <div class="video_wrapper">
            <div class="wrapper">

                <?php if ( wp_is_mobile() ) : ?>
                <div class="bg_cover"
                    style="padding:56.25% 0 0 0;position:relative;background-image: url(<?php echo $preview ?>)">

                    <?php if ($autoplay){ ?>
                    <iframe id="projectplayer" title="company homepage video"
                        src="https://player.vimeo.com/video/<?php echo $video ?>?api=1&background=1&autoplay=1&muted=1"
                        frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen
                        allow="fullscreen; picture-in-picture"
                        style="position:absolute;top:0;left:0;width:100%;height:100%;" allow=autoplay title=""></iframe>

                    <?php } else { ?>

                    <iframe id="projectplayer" title="company homepage video"
                        src="https://player.vimeo.com/video/<?php echo $video ?>?api=1&muted=0" frameborder="0"
                        webkitallowfullscreen mozallowfullscreen allowfullscreen allow="fullscreen; picture-in-picture"
                        style="position:absolute;top:0;left:0;width:100%;height:100%;"
                        <?php if ($autoplay){ ?>allow=autoplay<?php } else {  } ?> title=""></iframe>

                    <?php } ?>

                </div>

                <?php if ($overlay){ ?>

                <div
                    class="video_text_area <?php echo $textposition; ?> <?php if ($autoplay){ ?>autoplay<?php } else { ?>clickplay<?php } ?>">
                    <div <?php if ($full_video){?> class="container" <?php } else { ?> class="grid_vid" <?php } ?>>
                        <div class="video_text_area_bg">
                            <?php echo $textoverlay; ?>
                        </div>
                    </div>
                </div>

                <?php } else { ?><?php } ?>

                <?php else : ?>
                <div class="bg_cover"
                    style="padding:56.25% 0 0 0;position:relative;background-image: url(<?php echo $preview ?>)">


                    <?php if ($autoplay){ ?>

                    <div class="video_buttons <?php if ($autoplay){ ?>autoplay<?php } else { ?>clickplay<?php } ?>">
                        <div class="button" id="play-button"></div>

                        <div class="button" id="pause-button"></div>

                    </div>

                    <?php if ($overlay){ ?>

                    <div
                        class="video_text_area <?php echo $textposition; ?> <?php if ($autoplay){ ?>autoplay<?php } else { ?>clickplay<?php } ?>">
                        <div <?php if ($full_video){?> class="" <?php } else { ?> class="grid_vid" <?php } ?>>
                            <div class="video_text_area_bg">
                                <?php echo $textoverlay; ?>
                            </div>
                        </div>
                    </div>

                    <?php } else { ?><?php } ?>

                    <iframe id="projectplayer" title="company homepage video"
                        src="https://player.vimeo.com/video/<?php echo $video ?>?api=1&background=1&autoplay=1&muted=1"
                        frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen
                        allow="fullscreen; picture-in-picture"
                        style="position:absolute;top:0;left:0;width:100%;height:100%;" allow=autoplay title=""></iframe>

                    <?php } else { ?>


                    <?php if ($overlay){ ?>

                    <div
                        class="video_text_area <?php echo $textposition; ?> <?php if ($autoplay){ ?>autoplay<?php } else { ?>clickplay<?php } ?>">
                        <div <?php if ($full_video){?> class="" <?php } else { ?> class="grid_vid" <?php } ?>>
                            <div class="video_text_area_bg">
                                <?php echo $textoverlay; ?>
                            </div>
                        </div>
                    </div>

                    <?php } else { ?><?php } ?>


                    <iframe id="projectplayer" title="company homepage video"
                        src="https://player.vimeo.com/video/<?php echo $video ?>?api=1&muted=0" frameborder="0"
                        webkitallowfullscreen mozallowfullscreen allowfullscreen allow="fullscreen; picture-in-picture"
                        style="position:absolute;top:0;left:0;width:100%;height:100%;"
                        <?php if ($autoplay){ ?>allow=autoplay<?php } else {  } ?> title=""></iframe>



                    <?php } ?>


                </div>
                <?php endif; ?>



            </div>
        </div>
    </div>
    <?php } else { ?>

    <video autoplay playsinline muted loop class="native_video">
        <source src="<?php echo $video_file; ?>" type="video/mp4">
    </video>

    <?php } ?>

</section>