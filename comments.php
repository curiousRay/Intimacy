<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: Post title. */
				printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'intimacy' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: Number of comments, 2: Post title. */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'intimacy'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 42,
					)
				);
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'twentysixteen' ); ?></p>
	<?php endif; ?>

	<?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $fields =  array('author' => 
      '<p class="comment-form-author">'
      . '<label for="author">' . __( 'Name' ) . '</label> '
      . ( $req ? '<span class="required">*</span>' : '' )
      . '<input id="author" name="author" type="text" value="'
      . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req
      . ' /></p>',

      'email'  =>
      '<p class="comment-form-email"><label for="email">'. __( 'E-mail' ) . '</label> '
      . ( $req ? '<span class="required">*</span>' : '' ) .
      '<input id="email" name="email" type="text" value="'
      . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req
      . ' /></p>',
    );
    $consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
    $fields['cookies'] =
    '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"'
    .$consent
    .' />'
    .'<label for="wp-comment-cookies-consent">'
    .__('Remenber me for the next time I comment', 'textdomain')
    .'</label></p>';

    $comments_args = array(
      'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
      'title_reply_after'  => '</h2>',
      'title_reply' => 'Write me',
      'comment_notes_before' => '',
      'fields' =>  $fields,
      'label_submit' => 'SEND MESSAGE'
    );
    
    // customize comment field
    function custom_comment_field ($defaults) {
      $defaults['comment_field'] = 
      '<p class="comment-form-comment"><label for="Message">'
      . _x( 'Message', 'noun' )
      . '</label> <textarea placeholder="'
      . _x( 'Write text here...', 'noun' )
      . '" id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>';
      return $defaults;
    }
    add_filter('comment_form_defaults', 'custom_comment_field', 10);

    // remove url in comment form
    function wp_remove_comment_url($arg) {
      $arg['url'] = '';
      return $arg;
    }
    add_filter('comment_form_default_fields', 'wp_remove_comment_url');

    // move comment textbox after name&email fields
    function move_comment_field_to_bottom( $fields ) {
      $comment_field = $fields['comment'];
      unset( $fields['comment'] );
      $fields['comment'] = $comment_field;
      return $fields;
    }
    add_filter( 'comment_form_fields', 'move_comment_field_to_bottom' );

    comment_form($comments_args);
		?>

</div><!-- .comments-area -->
