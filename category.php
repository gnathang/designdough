<?php get_header(); ?>

<div class="full_width">
    <div class="container">
        <div class="">
				
            <div class="logo-container">
                <h2><?php
					printf( __( '%s', 'boilerplate' ), '' . single_cat_title( '', false ) . '' );
				?></h2>
            </div>
			
        </div>
    </div>
</div>

<div class="full_width">
    <div class="container blog_loop">
          <?php if ( have_posts() ): ?>
              <div class="post_wrapper">
                  <?php while ( have_posts() ) : the_post(); ?>
                    <div class="post-wrapper">
                        <a href="<?php the_permalink(); ?>">
                    
                                <?php if ( has_post_thumbnail() ) { ?>
                                    <div class="img-container"  style="background-image: url('<?php the_post_thumbnail_url();?>')">
                                <?php } else { ?>
                                <div class="img-container" style="background-image: url('https://designdough.co.uk/wp-content/themes/designdough/assets/images/jpeg/designdough-brand-design-cardiff.jpg')">
                                <?php } ?>
                                <div class="yellow_box">
                                    <?php the_date( 'd.n.Y'); ?> | <?php echo do_shortcode("[rt_reading_time postfix='MINS' postfix_singular='MIN']"); ?>
                                        <?php
                                            $posttags = get_the_category();
                                            if ($posttags) {
                                            foreach($posttags as $tag) {?>
                                                <span class="cats"><?php echo $tag->name . ' '; ?></span>
                                            <?php }
                                            }
                                        ?>
                                </div>
                            </div>
                        </a>
                        <a class="blog_text_link" href="<?php the_permalink(); ?>">
                            <div class="post-detail">
                                <h3 class="post-title"><?php the_title(); ?></h3>
                                <span class="excerpt bold"><?php the_excerpt(); ?></span>
                            </div>
                            <?php get_template_part('assets/images/svg/arrow-pink.svg') ?>
                        </a>
		            </div>
                <?php endwhile; ?>
            </div>
          <?php else: ?>
          <h2>No posts to display</h2>
          <?php endif; ?>
	
        <div class="clear"></div>
                          
        </div>
    </div>
</div>

<div class="full_width">
    <div class="container blog_loop">

        <div class="navigation p-top-5">
            <div class="alignleft prev_butt"><h3><em><?php previous_posts_link( 'Previous Page' ); ?></em></h3></div>
            <div class="alignright next_butt"><h3><em><?php next_posts_link( 'Next Page', '' ); ?></em></h3></div>
        </div>

    </div>
</div>

<?php get_footer(); ?>