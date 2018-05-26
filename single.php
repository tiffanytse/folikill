<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<!-- single.php -->
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content_ar2', get_post_format() ); ?>
				<?php// twentythirteen_post_nav(); ?>
				<?php// comments_template(); ?>

			<?php endwhile; ?>

<span class="post_date date updated"><?php the_time('j F,Y'); ?></span>
<span class=”vcard author”><span class=”fn”><?php the_author(); ?></span></span>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php// get_sidebar(); ?>
<?php get_footer(); ?>
