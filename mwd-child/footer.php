<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
		</div><!-- end of main container row -->
	</div><!-- end of main container -->
</div><!-- end of main -->
 
<div class="footer">
	<div class="container">
		<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer') ) ?>
	</div><!-- end of footer container -->
</div><!-- end of footer -->

<footer>
	<div class="container">
		<div class="col-md-3 header-side">
			<h2>
				<?php the_custom_logo('custom-logo'); ?>
			</h2>
		</div>
		<div class="col-md-8 header-side footer-header-side-2">
			<p>©2019 Speed & Ease. All Rights Reserved | Web Design by <a href="https://www.myanmarwebdesigner.com/" target="_blank">Myanmar
					Web Designer</a></p>
		</div>
		<div class="col-md-1 header-side footer-header-side-3">
			<div class="buttom-social-grids">

				<ul>
					<!-- <li><a href="#"><span class="fa fa-facebook"></span></a></li> -->
					<li><a href="#"><span class="fa fa-facebook-official"></span></a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-2.2.3.min.js'></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.js"></script>
<script defer src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.flexslider.js"></script>
<!-- OnScroll-Number-Increase-JavaScript -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script> -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.waypoints.min.js"></script>
<!-- light box gallery -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/lightbox-plus-jquery.min.js"></script>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/move-top.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/easing.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.countup.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/custom.js"></script>    
<?php wp_footer(); ?>
</body>
</html>