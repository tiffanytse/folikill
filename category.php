<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 *
 *	AR v.1
 */


get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		
		
		<div id="archive" class="content" >
			<div class="content-top" ></div>
			<div class="body-content">
				<table class="content-table">
					<tr>
						<td class="left-side">
							<div class="header_div type-page">
								<h2 class="entry-title"><?php printf( __( 'Category Archives: %s', 'twentythirteen' ), single_cat_title( '', false ) ); ?></h2>
								<br />																
								<?php if ( category_description() ) : // Show an optional category description ?>
								<div class="archive-meta"><h3>Description</h3><?php echo category_description(); ?></div>
								<?php endif; ?>
							</div>
					<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content_ar', get_post_format() ); ?>
			<?php endwhile; ?>

						<?php twentythirteen_paging_nav(); ?>
					
					
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
	
	
<script type="text/javascript">
						
						
	( function( $ ) {	

	
	var src="";
	var name="";
	var max_width=119;
	var max_height=119;
	var cont =0;
	var temp_path="<? echo get_template_directory_uri();?>";
	var string ="";
	var style = "";	
	var aux_style =""
	var img= "";
	
		$("#archive .entry-thumbnail>img").each(function(){
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

<?php get_footer(); ?>