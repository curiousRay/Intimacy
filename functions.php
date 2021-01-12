<?php

if ( ! function_exists( 'intimacy_setup' ) ) :
	function intimacy_setup() {
		// Load regular editor styles into the new block-based editor.
		// add_theme_support( 'editor-styles' );
		add_theme_support( 'post-thumbnails' );
		do_clean_tags();
	}
endif;
add_action('after_setup_theme', 'intimacy_setup' );


// register a widget area
function intimacy_widgets_init() {
	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory -> widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));

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
	wp_enqueue_style( 'intimacy-style', get_stylesheet_directory_uri()."/scss/style.css" );
	wp_enqueue_script( 'intimacy-script', get_template_directory_uri() . "/js/script.js");
	wp_deregister_script( 'wp-embed' );
}
add_action('wp_enqueue_scripts', 'intimacy_scripts');

function do_clean_tags() {
	remove_action('wp_head','rsd_link');
	remove_action('wp_head','wlwmanifest_link');
	remove_action('wp_head', 'wp_generator'); // remove wp version info

	// remove wp-json link
	add_filter('rest_enabled', '_returned_false');
	add_filter('rest_jsonp_enabled', '_returned_false');
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
	remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

	// remove wp-emoji
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script');
	remove_action( 'admin_print_styles', 'print_emoji_styles');
	remove_action( 'wp_head', 'print_emoji_detection_script', 7);
	remove_action( 'wp_print_styles', 'print_emoji_styles');
	remove_filter( 'the_content_feed', 'wp_staticize_emoji');
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji');
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email');

	// remove dns-prefetch
	remove_action( 'wp_head', 'wp_resource_hints', 2 );
}

// add custom class to body tag, show different styles for each category
function custom_body_class_by_category($classes) {
	if ( is_front_page() && is_home() ) {
		$classes[] = 'bg-texture-homepage';
	} else

	if ( in_category( 'uncategorized' ) || in_category( 'life' ) ) {
		$classes[] = 'bg-texture';
	}
	return $classes;
}
add_filter('body_class', 'custom_body_class_by_category');



