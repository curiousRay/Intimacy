<?php
/**
 * The template for displaying the footer
 */
?>

						<footer class="site-footer">	
						<span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentysixteen' ) ); ?>">
						<?php
						/* translators: %s: WordPress */
						printf( __( 'Proudly powered by %s', 'twentysixteen' ), 'WordPress' );
						?>
					</a>
					</footer><!-- .site-footer -->
				<?php wp_footer(); ?>
			</main><!-- .site-main -->
		</div>
	</body>
</html>
