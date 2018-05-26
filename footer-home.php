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
				<a href="http://alvaroramos.com"><img src="<? echo get_template_directory_uri(); ?>/images/alvaroramos.gif" alt=""/></a>
			</div>
		</div>
	</div><!-- #page -->

	<?php wp_footer(); ?>
	
	<img src="<? echo get_template_directory_uri(); ?>/images/home-legs.png" alt="" style="position:fixed;bottom:0px;left:0px;height:40%;width:auto;z-index:200"/>
	
</body>
</html>