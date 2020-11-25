<?php

if ( ! function_exists( 'intimacy_setup' ) ) :
	function intimacy_setup() {
		// Load regular editor styles into the new block-based editor.
		// add_theme_support( 'editor-styles' );
	}
endif;
add_action('after_setup_theme', 'intimacy_setup' );


// register a widget area
function intimacy_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'intimacy' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'intimacy' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'intimacy_widgets_init' );