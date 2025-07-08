<?php
$row = get_row_index() - 0;

$small_title = get_sub_field('small_title');
$big_text = get_sub_field('big_text');
$text_body = get_sub_field('text_body');

// end
?>


<section class="section_big_text">


    <div class="title_cont">
        <div class="container">
            <div class="title_wrap">
                <?php if($small_title) { ?><h5><?php echo $small_title; ?></h5><?php } ?>
                <h1 class="big_text_title ani_fade_up_fold">FROM THE ARCHIVES</h1>
            </div>
        </div>
    </div>


</section>