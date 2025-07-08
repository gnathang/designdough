<?php 

if(is_front_page()){
?>
<div class="loader_wrapper">
    <div class="logo_wrap">
        <img src="<?php echo get_template_directory_uri() . '/assets/images/svg/site-logo-white.svg'; ?>"
            alt="designdough logo">
        <?php //get_template_part("/assets/images/svg/loader.svg"); ?>
    </div>
    <div class="black-wrapper"></div>
</div>

<?php 
} else { };

; ?>