<?php
/**
 * The template for displaying Comments.
 * @package BrickYard
 * @since BrickYard 1.0.0
*/
if ( post_password_required() )
	return;
?>
<?php $brickyard_num_comments = get_comments_number();
if ( comments_open() || $brickyard_num_comments != '0' ) { ?>
<div class="entry-content">
  <div class="entry-content-inner">
    <div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
    <h2 class="entry-headline"><?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'brickyard' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?></h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'brickyard_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div id="comment-nav-below" class="navigation" role="navigation">
			<div class="nav-wrapper">
      <p class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'brickyard' ) ); ?> </p>
			<p class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'brickyard' ) ); ?></p>
      </div>
		</div>
		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'brickyard' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>

	<?php $placeholder_name = __( 'Your name' , 'brickyard' );
   $placeholder_web = __( 'Website' , 'brickyard' );
   $placeholder_comment = __( 'Comment...' , 'brickyard' );
   $aria_req = ( $req ? " aria-required='true'" : '' );
   $field_req = ( $req ? " *" : '' );
   $comment_args = array(
'title_reply'=>__( 'Leave a Comment' , 'brickyard' ),
'fields' => apply_filters( 'comment_form_default_fields', array(
'author' => '<p class="comment-form-author">' . '<label for="author">' . __( '', 'brickyard' ) . '</label> ' . '<input id="author" name="author" type="text" placeholder="' . $placeholder_name . $field_req . '" value=""  size="30"' . $aria_req . ' /></p>',   
'email'  => '<p class="comment-form-email">' .
'<label for="email">' . __( '', 'brickyard' ) . '</label> ' .
'<input id="email" name="email" type="text" placeholder="E-mail' . $field_req .'" value="" size="30"' . $aria_req . ' />'.'</p>',
'url'    => '<p class="comment-form-url">' .
'<label for="url">' . __( '', 'brickyard' ) . '</label> ' .
'<input id="url" name="url" type="text" placeholder="' . $placeholder_web . '" value="" size="30" />'.'</p>' ) ),
'comment_field' => '<p>' .
'<label for="comment">' . __( '', 'brickyard' ) . '</label>' .
'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . $placeholder_comment . '"></textarea>' .
'</p>',);
comment_form($comment_args); ?>

    </div><!-- #comments .comments-area -->
  </div>
</div>
<?php } ?>