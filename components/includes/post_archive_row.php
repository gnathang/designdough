<div class="post_row">
    <div class="meta_col">
        <?php
            $categories = get_the_category();
            $separator = ' ';
            $output = '';
            if ( ! empty( $categories ) ) {
                foreach( $categories as $category ) {
                    $output .= '<p class=" ' . esc_html( $category->name ) . '" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</p>' . $separator;
                }
                echo trim( $output, $separator );
            }
        ?>
    </div>
    <div class="title_col">
        <h4 class="post-title"><?php the_title(); ?></h4>
    </div>
    <div class="summary_col">
        <?php
            $summary = get_field('summary');
            if ($summary) {
                echo '<p class="summary">';
                echo $summary;
                echo '</p>';
            }
        ?>
    </div>
    <div class="view_col">
        <a href="<?php the_permalink(); ?>"><img
                src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right.svg'; ?>" /></a>
    </div>
</div>