<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>

	<!-- AR EDIT -->
	<link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
<meta name="google-site-verification" content="ACqi243paNxbhK5I_93RygPja6FJm1jYOAl5AxcH5MA" />
<meta name="google-site-verification" content="jNqlhuH3tDlF3Y1POa65C3wPNmem-plo8TMIL4MccqA" />
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div class="content-header">
				<div class="logo">
					<div class="site-header--logo-text">
						<a href="mailto:torontoelectrolysis&#064;gmail.com" style="color:#000">torontoelectrolysis<span style="color:#ff0060">@</span>gmail.com</a><br/><a href="sms://+1-647-870-3780" style="color:#000"><span style="color:#ff0060">+1</span> 647<span style="color:#ff0060">.</span>870<span style="color:#ff0060">.</span>3780</a>
					</div>
					<a href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri().'/images/follikill-logo-tm.gif';?>" alt=""/></a>
				</div>
			</div>

			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<h3 class="menu-toggle"><?php _e( 'Menu', 'twentythirteen' ); ?></h3>
					<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentythirteen' ); ?>"><?php _e( 'Skip to content', 'twentythirteen' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>

				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->
<a href="https://plus.google.com/u/0/106687836525064749109?rel=author"></a>
		</header><!-- #masthead -->

		<div id="main" class="site-main">







