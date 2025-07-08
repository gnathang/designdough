<?php
/**
 * Flex content loop
 */

//  $flex = have_rows('flex');
//  var_dump($flex);

if (have_rows('flex')) {
    // Loop through the rows of data
    while (have_rows('flex')) {
        the_row();
        // $layout = get_row_layout();
        // var_dump($layout);
        include (locate_template('components/flex/content-' . get_row_layout() . '.php'));
    }
}