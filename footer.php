<?php
/**
 * The template for displaying the footer
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">	

				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentysixteen' ) ); ?>" class="imprint">
					<?php
					/* translators: %s: WordPress */
					printf( __( 'Proudly powered by %s', 'twentysixteen' ), 'WordPress' );
					?>
				</a>
		</footer><!-- .site-footer -->

<?php wp_footer(); ?>
</body>
</html>
