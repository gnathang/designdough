
<?php
/**
 * The flexible content of the  theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage designdough
 * @since 1.0
 * @version 1.0
 */

// check if the flexible content field has rows of data
if( have_rows('flex') ):
  // loop through the rows of data
  while ( have_rows('flex') ) : the_row();



  endwhile;
else :
    // no layouts found
endif;
