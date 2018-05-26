<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<!-- index.php -->
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php if ( have_posts() ) : ?>
		
		<div id="blog" class="content" >
			<div class="content-top" ></div>
			<div class="body-content">
				<table>
					<tr>
						<td class="left-side">
							<div class="header_div">
								<h1 class="entry-title"><span class="first-letter">B</span>LOG</h1>
								<div class="search-div" ><?php get_search_form(); ?></div>
								<div class="follow" ></div>
							</div>
											
						<?php /* The loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', get_post_format() ); ?>
						<?php endwhile; ?>

						<?php twentythirteen_paging_nav(); ?>

					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
					
						</td>
						<td class="right-side">
							<?php get_sidebar(); ?>
						</td>
					
					</tr>
				</table>
						
				
			</div>
			<div class="content-bottom" ></div>
		</div>		
		
		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); ?>