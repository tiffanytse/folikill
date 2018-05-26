<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 
 AR v1.0
  
 */
?>
<!-- content_ar.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		$class_entry_title= "entry-title-nothumb";
		if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php
		$class_entry_title= "entry-title";
		endif; 
		?>

		<?php if ( is_single() ) : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<div class="<? echo $class_entry_title; ?>">
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
		</div>
		<?php endif; // is_single() ?>

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php 
			global $more;
			$more = 0;
			the_excerpt();
			?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
		
		<footer class="footer-post">
			<div class="entry-meta">
				<?php
				// twentythirteen_entry_meta(); 
				echo "<span>".get_the_date()."</span>";
				?>
				<br />
				<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-meta -->
			
			<div class="entry-comments">
				<?php if ( comments_open() && ! is_single() ) : ?>
					<div class="comments-link">
						<?php comments_popup_link( '<span class="leave-reply">' . __( '0 Comments', 'twentythirteen' ) . '</span>', __( '1 Comment', 'twentythirteen' ), __( '% Comments', 'twentythirteen' ) ); ?>
					</div><!-- .comments-link -->
				<?php endif; // comments_open() ?>

				<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
					<?php get_template_part( 'author-bio' ); ?>
				<?php endif; ?>
			</div>
			<div class="read-more">
				<a href="<?php the_permalink(); ?>">Read full article</a>
			</div>
			<div class="share-this">
				<?php if( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) { ADDTOANY_SHARE_SAVE_KIT(); } ?> Share
			</div>
		</footer>
	</header><!-- .entry-header -->
	
</article><!-- #post -->
