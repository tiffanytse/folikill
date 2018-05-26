<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<!-- page.php -->
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div id="pagedefault-content" class="content" >
						<div class="content-top" ></div>
						<div class="body-content body-content-nosidebar">
							<table class="content-table">
								<tr>
									<td class="left-side">
										<div class="header_div type-page">
											<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
											<div class="entry-thumbnail">
												<?php the_post_thumbnail(); ?>
											</div>
											<?php endif; ?>

											<h1 class="entry-title">
											<?php 
												$first = substr(get_the_title(),0,1); 
												$rest = substr(get_the_title(),1); 
												echo "<span class='first-letter'>$first</span>$rest";
											?>								
											</h1>
										</div>
										
									<!-- .entry-header -->

										<div class="entry-content">
											<?php the_content(); ?>
											<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
										</div><!-- .entry-content -->

										<footer class="entry-meta">
											<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
										</footer><!-- .entry-meta -->	
										<?php comments_template(); ?>
									</td>
									<td class="right-side">
										<?php get_sidebar(); ?>
									</td>
								
								</tr>
							</table>
							
						</div>
						<div class="content-bottom" ></div>
					</div>		
							
				</article><!-- #post -->

				
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<a href="https://plus.google.com/u/0/106687836525064749109?
   rel=author"></a>  

<?php get_footer(); ?>