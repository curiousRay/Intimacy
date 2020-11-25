<?php
/**
 * The template part for displaying content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post">置顶文章↑</span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

		

	<div class="entry-content">
		<?php
			the_content(
				sprintf(
					/* translators: %s: Post title. */
					__( 'Continue reading<span> "%s"</span>', 'intimacy' ),
					get_the_title()
				)
			);

			?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php 
		
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf(
			'<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			_x( 'Posted on', 'Used before publish date.', 'twentysixteen' ),
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
	</footer><!-- .entry-footer -->

	<hr/>

</article><!-- #post-<?php the_ID(); ?> -->
