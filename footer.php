<?php
/**
 * The template for displaying the footer
 */
?>

						
			</main><!-- .site-main -->
		</div>
		
		<footer class="site-footer">	
						<span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?>&nbsp; </a></span>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'intimacy' ) ); ?>">
					</a>
					<span class="copyr"><a href="https://creativecommons.org/licenses/by-nc-sa/4.0/">
						<?php printf(__( 'CC BY-NC-SA', 'intimacy' )); ?>
					</a></span>
					<?php
						printf( __( '&nbsp; theme Intimacy', 'intimacy' ));
					 ?>
					<nav class="site-nav">
				<?php wp_nav_menu(array(
					'theme_location' => 'bottom',
					'container'  => 'div', // if set to '', there is no container
					'container_class' => 'c-class',
					'container_id'  => 'c-id', 
					'menu_class'   => 'm-class',  
					'menu_id'   => 'm-id', 
					'before' => '<span>',
					'after'  => '</span>',
					'link_before'  => '',  
					'link_after'  => '',	
					'items_wrap'  => '<div id="%1$s" class="items-wrap %2$s">%3$s</div>',
					)); ?>
				</nav><!-- .site-nav -->
					</footer><!-- .site-footer -->
				<?php wp_footer(); ?>
	</body>
</html>
