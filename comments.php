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
    <div class="comment-long-underline"></div>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments("callback=mycomment_list");
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

  <?php endif; // Check for have_comments(). ?>
  
  
  <?php // redefine comment list rendering function.
  function mycomment_list($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
      <div id="comment-<?php comment_ID(); ?>">
       <div class="comment-author vcard">
          <?php echo get_avatar($comment,$size='36',$default='<path_to_url>' ); ?>
  
          <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
       </div>
       <?php if ($comment->comment_approved == '0') : ?>
          <em><?php _e('Your comment is awaiting moderation.') ?></em>
          <br />
       <?php endif; ?>
  
       <div class="comment-meta commentmetadata">
           <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
               <?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
           </a>
           <?php edit_comment_link(__('(Edit)'),'  ','') ?>
       </div>
  
       <?php comment_text() ?>
  
       <div class="reply">
          <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
       </div>
      </div>
  <?php } ?>


	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'intimacy' ); ?></p>
	<?php endif; ?>

	<?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $title_reply = '<h2 id="reply-title" class="comment-reply-title">Write me</h2><div class="comment-short-underline"></div>';
    $fields =  array('author' => $title_reply
      .'<p class="comment-form-author">'
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
    .__('Remember me', 'textdomain')
    .'</label></p>';

    $comments_args = array(
      'title_reply_before' => '',
      'title_reply_after'  => '',
      'title_reply' => '',
      'comment_notes_before' => '',
      'comment_notes_after' => '',
      'label_submit' => 'SEND MESSAGE',
      'fields' =>  $fields,
      'logged_in_as' => sprintf(
        '<div id="comment-left">
        '.$title_reply.'
        <p class="logged-in-as">%s</p></div>',
        sprintf(__( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>' ),
          get_edit_user_link(),
          esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
          $user_identity,
          wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
        )
      )
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
    add_filter('comment_form_default_fields', function($arg) {
      $arg['url'] = '';
      return $arg;
    });

    // move comment textbox after name&email fields
    add_filter( 'comment_form_fields',  function( $fields ) {
      $comment_field = $fields['comment'];
      unset( $fields['comment'] );
      $fields['comment'] = $comment_field;
      return $fields;
    });


    // configure unlogged-in comment box layout
    add_action('comment_form_before_fields', function(){
      echo '<div id="comment-left">';
    });
    add_action('comment_form_after_fields', function(){
      echo '</div><div id="comment-right">';
    });
    
    // configure logged-in comment box layout
    add_action('comment_form_logged_in_after', function(){
      echo '<div id="comment-right">';
    });

    // remove "Logged in as ... Log out?"
    // add_filter( 'comment_form_logged_in', '__return_empty_string' );


    comment_form($comments_args);
		?>

</div><!-- .comments-area -->
