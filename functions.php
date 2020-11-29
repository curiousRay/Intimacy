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

// register navigation menus
function intimacy_menus_init() {
		register_nav_menus(array(
			'primary' => __('Primary Menu'),
	));
}
add_action('init', 'intimacy_menus_init');

// register styles, scripts, etc.
function intimacy_scripts() {
	wp_enqueue_style( 'intimacy-style', get_stylesheet_uri() );
}
add_action('wp_enqueue_scripts', 'intimacy_scripts');

