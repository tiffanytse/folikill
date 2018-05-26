<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 *	AR v.1
 */


get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		
		
		<div id="archive" class="content" >
		<?php if ( have_posts() ) : ?>
			<div class="content-top" ></div>
			<div class="body-content">
				<table class="content-table">
					<tr>
						<td class="left-side">
						
							<div class="header_div type-page">
								<h2 class="entry-title"><?php
								if ( is_day() ) :
									printf( __( 'Daily Archives: %s', 'twentythirteen' ), get_the_date() );
								elseif ( is_month() ) :
									printf( __( 'Monthly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentythirteen' ) ) );
								elseif ( is_year() ) :
									printf( __( 'Yearly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentythirteen' ) ) );
								else :
									_e( 'Archives', 'twentythirteen' );
								endif;?>
								</h2>
							</div>
					
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
				<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
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

