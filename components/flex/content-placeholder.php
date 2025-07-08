<!-- in the wireframe, use this flex in place of the custom flex we've not built yet  -->

<?php $big_title = get_sub_field('big_title'); ?>
<?php $small_title = get_sub_field('small_title'); ?>
<?php $row = get_row_index() - 0; ?>


<section class="section_placeholder row-<?php echo $row; ?> fade_in_container">
    <div class="container">
        <div class="title_wrap">
            <?php if($small_title) { ?><h5><?php echo $small_title; ?></h5><?php } ?>
            <?php if($big_title) { ?><h2><?php echo $big_title; ?></h2><?php } ?>
        </div>
        <div class="placeholder_wrap">

        </div>
    </div>
</section>