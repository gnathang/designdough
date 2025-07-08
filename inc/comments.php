<?php /* Comments */

/**
 * Custom callback for outputting comments
 *
 * @return void
 * @author Keir Whitaker
 */
 
function starkers_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  ?>
  <?php if ( $comment->comment_approved == '1' ): ?>
  <li>
    <article id="comment-<?php comment_ID() ?>">
      <?php echo get_avatar( $comment ); ?>
      <h4><?php comment_author_link() ?></h4>
      <time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
      <?php comment_text() ?>
    </article>
  <?php endif;
}
