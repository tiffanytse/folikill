<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0

 
  AR v2.0

  */
?>
<!-- content_ar2.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div  class="content" >
						<div class="content-top" ></div>
						<div class="body-content body-content-nosidebar">
							<header class="entry-header">
								<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
								<div class="entry-thumbnail">
									<?php the_post_thumbnail(); ?>
								</div>
								<?php endif; ?>

								<h1 class="entry-title"><?php the_title(); ?></h1>
							</header><!-- .entry-header -->

							<div class="entry-content">
								<?php the_content(); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
							</div><!-- .entry-content -->

							<footer class="footer-post">
								<div class="entry-meta">
									<?php
									// twentythirteen_entry_meta(); 
									echo "<span>".get_the_date()."</span>";
									?>
									<br />
									<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
								</div><!-- .entry-meta -->															
								<div class="share-this">
									<?php if( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) { ADDTOANY_SHARE_SAVE_KIT(); } ?> Share
								</div>
							</footer>
							
							<?php twentythirteen_post_nav(); ?>
							<?php comments_template(); ?>
							
							</div>
						<div class="content-bottom" ></div>
					</div>		
							
</article><!-- #post -->
