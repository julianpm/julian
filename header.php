<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package julian
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<p>hello</p>
	<div class="wrapper">
		<header id="masthead" class="site-header" role="banner">
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<div class="row">
					<div class="columns small-12">
						<div class="site-branding">
							<a href="<?php echo esc_url( home_url() ); ?>">
								<?php echo esc_html_e( 'Julian Meanchoff', 'jul' ); ?>
							</a>
						</div><!-- .site-branding -->

						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
						<button class="nav-toggle">
							<span class="bars"></span>
							<span class="bars"></span>
							<span class="close"></span>
							<span class="close"></span>
						</button>
					</div>
				</div>
			</nav><!-- #site-navigation -->
			<div class="flyout-nav">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</div>
		</header><!-- #masthead -->
	</div>

	<div id="content" class="site-content">
