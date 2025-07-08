<?php $big_title = get_sub_field('big_title'); ?>
<?php $small_title = get_sub_field('small_title'); ?>
<?php $row = get_row_index() - 0; ?>

<section class="section_search_banner row-<?php echo $row; ?> fade_in_container">
    <div class="container">
        <div class="search_banner_grid">
            <div class="text_wrap">
                <div class="title_wrap">
                    <?php if($small_title) { ?> <h5 class="small_title"><?php echo $small_title; ?></h5><?php } ?>
                    <?php if($big_title) { ?> <h2 class="big_title"><?php echo $big_title; ?></h2><?php } ?>
                </div>
            </div>
            <div class="searchbar_wrap">
                <?php get_template_part('components/includes/searchbar'); ?>
            </div>
        </div>
    </div>
</section>