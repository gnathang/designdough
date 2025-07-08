<?php 
    $row = get_row_index() - 0; 

    $small_title = get_sub_field('small_title');
    $big_title = get_sub_field('big_title');
    $remove_border = get_sub_field('remove_border');
    $use_columns = get_sub_field('use_columns');
    $title = get_sub_field('title');
    $body = get_sub_field('body');
    $link = get_sub_field('link');
    $column_1 = get_sub_field('column_1');
    $column_2 = get_sub_field('column_2');
    $glance_box = get_sub_field('use_glance_box');
    $glance_image = get_sub_field('glance_image');
    $glance_title = get_sub_field('glance_title');
    $add_stats = get_sub_field('add_stats');
    $align_center = get_sub_field('align_center')
?>

<!-- todo: add downloadables and links to columns and no column layouts. -->

<section class="section_text row-<?php echo $row; ?>">
    <div class="container">

        <div class="title_bar">
            <?php if($remove_border == false) { ?>
            <div class="title_bar_border"></div>
            <?php } ?>
        </div>

        <div class="title_box">
            <div class="title_wrap <?php if($glance_box) { ?>title_box_grid<?php } ?>">
                <?php if($small_title) { ?> <p class="small_title fade_in_element"> <?php echo $small_title; ?></p>
                <?php } ?>
                <?php if($glance_box) { ?>
                <div class="glance_box fade_in_element">
                    <div class="glance_box_title_wrap">
                        <img src="<?php echo $glance_image; ?>" alt="at glance eye icon">
                        <h4 class="glance_title"><?php echo $glance_title; ?></h4>
                    </div>
                    <ul class="stats_list">
                        <?php if(have_rows('glance_stats')) : while(have_rows('glance_stats')) : the_row(); ?>
                        <?php $list_item = get_sub_field('glance_stat'); ?>
                        <li><?php echo $list_item; ?></li>
                        <?php endwhile; endif; ?>
                    </ul>
                </div>
                <?php } ?>
                <?php if($big_title) { ?>
                <h2 class="title ani_fade_up_fold"> <?php echo $big_title; ?> </h2>
                <?php } ?>
            </div>
        </div>

        <!-- no column layout -->
        <?php if($use_columns == false) { ?>
        <div class="text_no_cols">
            <?php /* if($title) { ?> <h2 class="no_col_title"> <?php echo $title; ?> </h2> <?php } */?>
            <div class="no_col_body fade_in_element <?php if($align_center) { ?> align_center<?php } ?>">
                <?php echo $body; ?></div>
        </div>

        <!-- column layout -->
        <?php } else { ?>
        <div
            class="text_cols <?php if($column_1['on'] && $column_2['on']) { ?>two_cols<?php } ?> <?php if($align_center) { ?> align_center<?php } ?>">
            <div class="text_col_1 fade_in_element fade-delay-1">
                <?php if($column_1['on']) { ?>
                <?php if($column_1['title']) { ?><h3
                    class="col_title <?php if($column_1['border_title_col_1']) { ?> border_bottom <?php } ?>">
                    <?php echo $column_1['title']; ?></h3> <?php } ?>
                <?php if($column_1['body']) { ?><div class="col_body"><?php echo $column_1['body']; ?></div><?php } ?>
                <?php } ?>
            </div>
            <div class="text_col_2  fade_in_element fade-delay-2">
                <?php if($column_2['on']) { ?>
                <?php if($column_2['title']) { ?><h3
                    class="col_title <?php if($column_2['border_title_col_2']) { ?> border_bottom <?php } ?>">
                    <?php echo $column_2['title']; ?></h3> <?php } ?>
                <?php if($column_2['body']) { ?><div class="col_body"><?php echo $column_2['body']; ?></div><?php } ?>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <?php if($add_stats) { ?>
        <div class="stats_wrap">
            <?php if(have_rows('stats')) : while(have_rows('stats')) : the_row(); ?>
            <?php $stat = get_sub_field('stat'); ?>
            <?php $stat_desc = get_sub_field('stat_description'); ?>
            <div class="stat_wrap">
                <h2><?php echo $stat; ?></h2>
                <p><?php echo $stat_desc; ?></p>
            </div>
            <?php endwhile; endif; ?>
        </div>
        <?php } ?>
    </div>
</section>