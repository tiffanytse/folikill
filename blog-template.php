<?php
/*

Template Name: Blog Template 

*/
get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		
		
		<div id="blog" class="content" >
			<div class="content-top" ></div>
			<div class="body-content">
				<table class="content-table">
					<tr>
						<td class="left-side">
							<div class="header_div type-page">
								<h1 class="entry-title"><span class="first-letter">B</span>LOG</h1>
								<div class="search-div" ><?php get_search_form(); ?></div>
								<a class="follow" href="http://www.follikill.com/feed/"><div class="follow" ><img src="<? echo get_template_directory_uri();?>/images/follow2.png" alt="" /></div></a>
							</div>
					<?
						$args = array( 'numberposts' => 5, 'order' => 'DESC','orderby' => 'date' );
						$postslist = get_posts( $args );	
						
						foreach ($postslist as $post) :  setup_postdata($post); 
						/* The loop */ ?>
						
							<?php get_template_part( 'content_ar', get_post_format() ); ?>
					
					<?php 
						endforeach;
					?>

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
	
		$("#blog .entry-thumbnail>img").each(function(){
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
