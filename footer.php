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
				<div align="center" class="menu_footer">
					<a href="/home">home</a> | <a href="/about">about</a> | <a href="/blog">blog</a>| <a href="/electrolysis case study">electrolysis case study</a> |<a href="/fee schedule">fee schedule</a> |<a href="/contact">contact</a> | <a href="/contact">+1 647.870.3780</a> | <a href="mailto:torontoelectrolysis@gmail.com">torontoelectrolysis@gmail.com</a>
				</div>



			</div>
		</div>
	</div><!-- #page -->

	<?php wp_footer(); ?>

	<? if (strpos($_SERVER["REQUEST_URI"],"home")) { ?>
		<img class="footer_img" src="<? echo get_template_directory_uri(); ?>/images/home-legs.png" alt="" style="position:fixed;bottom:0px;left:0px;height:40%;width:auto;z-index:200"/>
	<? } ?>

	<? if (strpos($_SERVER["REQUEST_URI"],"blog")) { ?>
		<img class="footer_img" src="<? echo get_template_directory_uri(); ?>/images/blog-footer.png" alt="" style="position:fixed;bottom:40px;right:0px;height:80%;width:auto"/>
	<? } ?>

	<? if (strpos($_SERVER["REQUEST_URI"],"about")) { ?>
		<img class="footer_img" src="<? echo get_template_directory_uri(); ?>/images/footer_woman3.png" alt="" style="position:fixed;bottom:45px;left:0px;height:60%;width:auto;"/>
	<? } ?>

	<? if (strpos($_SERVER["REQUEST_URI"],"gallery")) { ?>
		<img class="footer_img" src="<? echo get_template_directory_uri(); ?>/images/footer_woman4.png" alt="" style="position:fixed;bottom:40px;right:0px;height:80%;width:auto"/>
	<? } ?>

</body>
</html>