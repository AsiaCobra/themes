<?php
global $post;
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php wp_title( '|', true, 'right' ); ?></title>
 
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- Bootstrap -->
<!-- <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet"> -->
 
	<!--booststrap-->
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.css" rel="stylesheet" type="text/css" media="all"> 
	<!-- font-awesome icons -->
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/font-awesome.css" rel="stylesheet"> 
	<!-- banner text slider-->
 	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/flexslider.css" type="text/css" media="screen" />
 	<!-- //lightbox files -->
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/lightbox.css">
 	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Cantata+One" rel="stylesheet">

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!-- [if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif] -->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
 <div class="w3-agile-logo">
		<div class="container">
			<div class=" head-wl">
				<div class="headder-w3">
					<h1 title="<?php bloginfo( 'description' ); ?>">
						<!-- <a href="index.html"><img src="images/logo.png"></a> -->
						<?php  the_custom_logo(); ?>
					</h1>
				</div>

				<div class="w3-header-top-right-text phone_left">
					<h6 class="caption"> Contact Us</h6>
					<p> <a href="tel:01245298">01-245298</a></p>
				</div>

				<div class="email-right">
					<h6 class="caption">Email Us</h6>
					<p><a href="mailto:customerservice@speednease.com" class="info"> customerservice@speednease.com</a></p>

				</div>


				<div class="agileinfo-social-grids">
					<h6 class="caption">Follow Us</h6>
					<ul>
						<li><a href="#"><span class="fa fa-facebook-official"></span></a></li>
					</ul>
				</div>

				<div class="clearfix"> </div>
			</div>
		</div>

</div>
<div class="top-nav">
		<nav class="navbar navbar-default navbar-fixed-top">


			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					 aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>


				<div id="navbar" class="navbar-collapse collapse">					
					<?php 
					  /* Primary navigation */
						wp_nav_menu( array(
					                'menu'              => 'primary',
					                'theme_location'    => 'primary',
					                'depth'             => 2,
					                'menu_class'        => 'nav navbar-nav',
					                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					                'walker'            => new wp_bootstrap_navwalker())
					            );
				?>
				</div>
				<div class="clearfix"> </div>
		</nav>
</div>

 <?php 
	if(is_front_page()):
?>
<header>
		<div class="flexslider-info">
			<section class="slider">
					<?php echo do_shortcode("[metaslider id=80]"); ?>
			</section>
		</div>
</header>

<?php
	endif;
 ?>
<?php if(!is_front_page() && is_page() || is_search() || is_archive() || is_404() || is_attachment()): 	
					$class = $post->post_name;
							if(is_search() || is_archive() || is_404() || is_attachment())
									$class = "default  mb-5";
	?>
	
	<div class="relative  banner-<?php echo $class; ?>">
				<div class="container">
							<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Banner') ) ?>
						</div><!-- end of banner container -->
						<h1 class="title">
												<?php if ( is_single() || is_page() ) : ?>
											<?php the_title(); ?>
											<?php else : ?>
											<?= wp_get_document_title('title'); ?> 
											<?php endif; // is_single() ?>
						</h1>
 
						<!-- <hr> -->
						<?php if (function_exists('mwd_breadcrumbs')) mwd_breadcrumbs(); ?>
	</div><!-- end of banner -->
<?php endif; ?>

<div class="main">
	<div class="container">
		<div class="row">
