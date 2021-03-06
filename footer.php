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
					<a href="<?php echo get_site_url(); ?>">home</a> | <a href="<?php echo get_site_url(); ?>/about">about</a> | <a href="<?php echo get_site_url(); ?>/blog">blog</a>| <a href="<?php echo get_site_url(); ?>/electrolysis case study">electrolysis case study</a> |<a href="<?php echo get_site_url(); ?>/electrolysis-toronto-fees">fee schedule</a> |<a href="<?php echo get_site_url(); ?>/contact">contact</a> | <a href="/contact">+1 647.870.3780</a> | <a href="mailto:torontoelectrolysis@gmail.com">torontoelectrolysis@gmail.com</a>
				</div>



			</div>
		</div>
	</div><!-- #page -->

	<?php wp_footer(); ?>

	<? if (is_front_page()) { ?>
		<img class="footer_img" src="<? echo get_template_directory_uri(); ?>/images/home-legs-crossed.png" alt="" style="position:fixed;bottom:30px;left:0px;height: 200px;width:auto"/>
	<? } ?>

	 <? if (strpos($_SERVER["REQUEST_URI"],"electrolysis-black-skin")) { ?>
		<img class="footer_img" src="<? echo get_template_directory_uri(); ?>/images/black-skin-hair-woman.png" alt="african woman" style="position:fixed;bottom:45px; right: 10px; height:300px;width:auto;z-index:200"/>
	<? } ?>

	<? if (strpos($_SERVER["REQUEST_URI"],"blog")) { ?>
		<img class="footer_img" src="<? echo get_template_directory_uri(); ?>/images/blog-footer.png" alt="" style="position:fixed;bottom:40px;right:0px;height:80%;width:auto"/>
	<? } ?>

	<? if (strpos($_SERVER["REQUEST_URI"],"about")) { ?>
		<img class="footer_img" src="<? echo get_template_directory_uri(); ?>/images/footer_woman3.png" alt="" style="position:fixed;bottom:45px;left:0px;height:320px;width:auto;"/>
	<? } ?>

	<? if (strpos($_SERVER["REQUEST_URI"],"electrolysis-toronto")) { ?>
		<img class="footer_img" src="<? echo get_template_directory_uri(); ?>/images/footer_legs.png" alt="" style="position:fixed;bottom:20px;left:0px;height: 260px;width:auto"/>
	<? } ?>

</body>
</html>