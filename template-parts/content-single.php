<?php
/**
 * The template part for displaying content
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('content-single-card'); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	<p class="entry-footer">
		<?php 
		
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date()
		);

		printf(
			'<span class="posted-on"><span>%1$s </span><a href="%2$s">%3$s</a></span>',
			_x( 'Posted on', 'Used before publish date.', 'intimacy' ),
			esc_url( get_permalink() ),
			$time_string
		);
		
		?>
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Post title. */
					__( 'Edit<span> "%s"</span>', 'intimacy' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
	</p><!-- .entry-footer -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
      the_content();
    ?>
	</div><!-- .entry-content -->

	<div class="hr-eod"></div>
	<div class="text-eod">End of document</div>

</article><!-- #post-<?php the_ID(); ?> -->
