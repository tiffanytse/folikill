<?php
/*

Template Name: Page Without Sidebar

*/

get_header(); ?>
<!-- page-withoutsidebar.php -->
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
<? global $post;
?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div id="<?echo  "content_".strtolower($post->post_name); ?>" class="content" >
						<div class="content-top" ></div>
						<div class="body-content body-content-nosidebar ">
							<header class="entry-header">
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
							</header><!-- .entry-header -->

							<div class="entry-content">
								<?php the_content(); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
							</div><!-- .entry-content -->

							<footer class="entry-meta">
								<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
							</footer><!-- .entry-meta -->
							
						</div>
						<div class="content-bottom" ></div>
					</div>		
						<script type="text/javascript">
						
						
	( function( $ ) {	

	
	var src="";
	var name="";
	var max_width=200;
	var max_height=200;
	var cont =0;
	var temp_path="<? echo get_template_directory_uri();?>";
	var string ="";
	var style = "";	
	var aux_style =""
	var img= "";
	
		$("#content_gallery .entry-content a>img").each(function(){
			src = $(this).attr('src');
			name = src.split('/').pop();
			name = name.substr(0, name.lastIndexOf('.')) || name;								
			cont++;
			name = "id_slide_"+ cont;
			//alert($(this).parent().html());
			
			$(this).parent().attr("id", name);
			//$(this).parent().attr("target", "_blank");
			
			
				var string = 'action=image2div&src_image=' + src+ '&max_width=' + max_width+ '&max_height=' + max_height ;							
				
				$.ajax({
					type: "POST",
					url: temp_path + "/ar/arlib.php",
					data: string,
					async: false,
					cache: false,
					success: function(data){		
					//alert(data);		
						if(data!="error")
						{														
							style = data.split("||||");	
							aux_style = $("#"+ name).children().attr("style");
							$("#"+ name).children().attr("style", aux_style + ";" + style[1]);
							img= $("#"+ name).html();
							$("#"+ name).html("<div class='thumb_div' style='"+ style[0]+"'>" + img + "</div>");						
							//$("#"+ name).children().css("position", "relative");
						}
					}			 
				});
			
		});
					
	} )( jQuery );				
						
						</script>	
						
				</article><!-- #post -->

				<?php comments_template(); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php// get_sidebar(); ?>
<?php get_footer(); ?>