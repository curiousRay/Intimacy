<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<div class="container extended flex">
		<header id="masthead" class="site-header" role="banner">
			<div class="site-header-main">
				<div class="site-branding">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->
					
			<nav class="site-nav">
				<?php wp_nav_menu(array(
					'theme_location' => 'primary',
					'container'  => 'div', // if set to '', there is no container
					'container_class' => 'c-class',
					'container_id'  => 'c-id', 
					'menu_class'   => 'm-class',  
					'menu_id'   => 'm-id', 
					'before' => '<span>',
					'after'  => '</span>',
					'link_before'  => '- ',  
					'link_after'  => ' -',	
					'items_wrap'  => '<div id="%1$s" class="items-wrap %2$s">%3$s</div>',
					)); ?>
			</nav><!-- .site-nav -->
				
			<?php if (is_active_sidebar( 'Sidebar-1' ) ) : ?>
				<ul id="widget-sidebar">
					<?php get_sidebar( 'Sidebar' ); ?>
				</ul>
			<?php endif; ?>

			</div><!-- .site-header-main -->
		</header><!-- .site-header -->

		<div id="content" class="site-content">
