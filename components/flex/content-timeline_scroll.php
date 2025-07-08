<?php
    $row = get_row_index() - 0; 

    $small_title = get_sub_field('small_title');
    $big_title = get_sub_field('big_title');
    $intro_text = get_sub_field('intro_text');
    $link = get_sub_field('link');
    $stick_position = get_sub_field('stick_position');
?>


<section class="section_timeline_scroll row-<?php echo $row; ?>">
    <div class="container">
        <?php
            $row = get_sub_field('columns', $post->ID);
            if ($row < 1) {
                $rows = 0;
            } else {
                $rows = count($row);
            }
        ?>

        <div class="title_wrap">
            <?php if($small_title) { ?><p class="small_title"><?php echo $small_title; ?></p><?php } ?>
            <?php if($big_title) { ?><h2 class="big_title"><?php echo $big_title; ?></h2><?php } ?>
            <?php if($intro_text) { ?><h4 class="intro_text"><?php echo $intro_text; ?></h4><?php } ?>
            <?php if($link) { ?>
            <a class="btn_default" href="<?php echo esc_url($link['url']); ?>"
                target="<?php echo esc_attr($link['target']); ?>"><span><?php echo esc_html($link['title']); ?></span></a>
            <?php } ?>
        </div>

        <div class="timeline_grid">
            <?php if(have_rows('timeline_stages')) : while(have_rows('timeline_stages')) : the_row(); ?>
            <?php $stage_title = get_sub_field('stage_title'); ?>
            <?php $stage_body_text = get_sub_field('stage_body_text'); ?>
            <?php $stage_icon = get_sub_field('stage_icon'); ?>
            <?php $stage_icon_second = get_sub_field('stage_icon_second'); ?>
            <?php $stage_list = get_sub_field('stage_list'); ?>
            <div
                class="timeline_stage <?php if ($stick_position) { ?> stick_at_center<?php } ?> <?php if(!$stage_body_text) { ?> shorten_height<?php } ?>">
                <div class="stage_icon_wrap">
                    <img class="stage_icon" src="<?php echo $stage_icon; ?>" alt="project stage icon">
                    <img class="stage_icon_second" src="<?php echo $stage_icon_second; ?>" alt="project stage icon">
                    <h4><?php echo $stage_title; ?></h4>
                </div>
                <div class="stage_body_text">
                    <h4><?php echo $stage_title; ?></h4>
                    <?php if($stage_body_text) { ?><p><?php echo $stage_body_text; ?></p> <?php } ?>
                </div>
                <div class="stage_list"><?php echo $stage_list; ?></div>
            </div>

            <?php endwhile; endif; ?>
        </div>

    </div>
</section>