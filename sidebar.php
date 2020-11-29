<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<aside id="secondary" class="sidebar widget-area" style="background-color: transparent;">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>