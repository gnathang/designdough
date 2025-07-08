</main>
<div class="footer_space">
    <!-- join this on the end of the main, as space for the fixed header to sit into  -->
</div>


<?php 
 $address = get_field('text', 'option');
 $tel = get_field('tel', 'option');
 $email = get_field('email', 'option');
 $linkedin = get_field('linkedin', 'option');
 $instagram = get_field('instagram', 'option');
 $twitter = get_field('twitter', 'option');
?>

<footer class="footer">
    <div class="container">

        <div class="footer_top">
            <h3>Want to discuss your </br>next project?</h3>
            <h4 class="cta">
                Give us a
                <a class="btn_simple" href="tel:<?php echo $tel; ?>">
                    call
                </a> or drop us an
                <a class="btn_simple" href="mailto:<?php echo $email; ?>">
                    email
                </a>.
            </h4>
        </div>

        <div class="footer_main">

            <div class="logo_wrap">
                <a href="/">
                    <img class="icon"
                        src="<?php echo get_template_directory_uri() . '/assets/images/svg/site-logo-white.svg'; ?>"
                        alt="Company logo for <?php bloginfo( 'name' ); ?>" />
                </a>
            </div>

            <nav class="nav_wrap">
                <ul>
                    <?php if( have_rows('footer_menu', 'option') ): while( have_rows('footer_menu', 'option') ): the_row(); ?>

                    <?php $mainlink = get_sub_field('menu_top_level_link', 'option'); ?>
                    <?php if( $mainlink ): 
                            $mainlink_url = $mainlink['url'];
                            $mainlink_title = $mainlink['title'];
                            $mainlink_target = $mainlink['target'] ? $mainlink['target'] : '_self';
                            ?>

                    <?php $dropdown = get_sub_field('dropdown', 'option'); ?>

                    <li id="nav_<?php echo get_row_index(); ?>"
                        class="li_level_one <?php if ($dropdown){?>dropdown<?php } else { ?><?php } ?>">
                        <a class="btn_anchor" href="<?php echo esc_url( $mainlink_url ); ?>"
                            target="<?php echo esc_attr( $mainlink_target ); ?>"><?php echo esc_html( $mainlink_title ); ?></a>

                        <div class="dropdown_wrap">
                            <ul class="dropdown_list">
                                <?php if( have_rows('dropdown_menu_items', 'option') ): ?>
                                <?php while( have_rows('dropdown_menu_items', 'option') ): the_row(); ?>
                                <?php  $dropdownitem = get_sub_field('dropdown_menu_item_link', 'option');
                                        if( $dropdown && $dropdownitem ): 
                                        $dropdownitem_url = $dropdownitem['url'];
                                        $dropdownitem_title = $dropdownitem['title'];
                                        $dropdownitem_target = $dropdownitem['target'] ? $dropdownitem['target'] : '_self';
                                        ?>
                                <li>
                                    <a class="" href="<?php echo esc_url( $dropdownitem_url ); ?>"
                                        target="<?php echo esc_attr( $dropdownitem_target ); ?>"><?php echo esc_html( $dropdownitem_title ); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>

                    <?php endif; ?>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="contact_socials_wrap">
                <div class="socials_wrap">
                    <a href="https://instagram.com/<?php echo $instagram; ?>" aria-label="Link to Instagram page"><img
                            class="social_icon"
                            src="<?php echo get_template_directory_uri() . '/assets/images/svg/instagram-white.svg'; ?>"
                            alt="instagram icon">
                    </a>
                    <a href="https://linkedin.com/company/<?php echo $linkedin; ?>"
                        aria-label="Link to Linkedin page"><img class="social_icon"
                            src="<?php echo get_template_directory_uri() . '/assets/images/svg/linkedin-white.svg'; ?>"
                            alt="linkedin icon">
                    </a>
                </div>

                <div class="contact_wrap">
                    <div class="email">
                        <div class="icon">
                            <?php get_template_part('assets/images/svg/email.svg') ?>
                            <p><a class="btn_simple" href="mailto:<?php echo $email ?>"
                                    aria-label="Link to email address"><?php echo $email ?></a></p>
                        </div>
                    </div>
                    <div class="tel">
                        <p><a class="btn_simple" href="tel:<?php echo $tel ?>"
                                aria-label="Link to telephone"><?php echo $tel ?></a></p>
                    </div>
                    <a class="btn_default" href="/contact"><span>Contact</span></a>
                </div>
            </div>

            <div class="copyright_wrap">
                <p>&copy;<?php bloginfo( 'name' ); ?> <?php echo date("Y"); ?></p>
            </div>

            <div class="legal_wrap">
                <a class="btn_simple" href="/terms-conditions/" aria-label="terms and conditions">Terms & Conditions</a>
				<a class="btn_simple" href="/privacy-policy/" aria-label="terms and conditions">Privacy Policy</a>
            </div>

        </div>

    </div>

    </div> <!-- container -->
</footer>

<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/ScrollTrigger.min.js"></script>

<script src="<?php get_site_url(); ?>/wp-content/themes/designdough/assets/js/froogaloop.js" type="text/javascript">
</script>

<script src="<?php get_site_url(); ?>/wp-content/themes/designdough/assets/js/slick.js" type="text/javascript"></script>
<script src="<?php get_site_url(); ?>/wp-content/themes/designdough/assets/js/splide/splide.min.js"
    type="text/javascript">
</script>
<script
    src="<?php get_site_url(); ?>/wp-content/themes/designdough/assets/js/splide/splide-extension-auto-scroll.min.js"
    type="text/javascript">
</script>
<!-- <script src="<?php get_site_url(); ?>/wp-content/themes/designdough/assets/js/barba.min.js" type="text/javascript">
</script> -->

<!-- unpkg -->
<script src="https://unpkg.com/@barba/core"></script>

<!-- jsdelivr -->
<script src="https://cdn.jsdelivr.net/npm/@barba/core"></script>

<!-- swup -->
<script src="https://unpkg.com/swup@3"></script>


<script src="<?php get_site_url(); ?>/wp-content/themes/designdough/assets/js/animejs/lib/anime.min.js"
    type="text/javascript"></script>
<script src="<?php get_site_url(); ?>/wp-content/themes/designdough/assets/js/animations.js" type="text/javascript">
</script>
<script src="<?php get_site_url(); ?>/wp-content/themes/designdough/assets/js/script.js" type="text/javascript">
</script>
<script src="<?php get_site_url(); ?>/wp-content/themes/designdough/assets/js/ajax-filter.js" type="text/javascript">
</script>


<?php wp_footer(); ?>

</main>
</div>
</body>

</html>