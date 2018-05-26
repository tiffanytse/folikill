<?php
/**
 * FOOTER FOR HOME
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php get_sidebar( 'main' ); ?>

			<div class="site-info">
				<?php do_action( 'twentythirteen_credits' ); ?>
				
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
		<div class="site-footer footer_ar">
			<div class="site-info">
				<div align="center" style="position:absolute;bottom:10px;color:#aaa;font-size:13px;padding-bottom:0px;letter-spacing:2px">
					home | about | blog | electrolysis case study | contact | +1 647.870.3780 | torontoelectrolysis@gmail.com 
				</div>
				
				
				
			</div>
		</div>
	</div><!-- #page -->

	<?php wp_footer(); ?>
	
	<img id="" src="<? echo get_template_directory_uri(); ?>/images/blog-footer.png" alt="" style="position:fixed;bottom:40px;right:0px;height:80%;width:auto"/>	
	
</body>
</html>