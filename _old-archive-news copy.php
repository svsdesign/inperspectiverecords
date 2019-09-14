<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   
 */

   
get_header(); ?>

  
	<div class="container grid">
			
		 <div class="page-title-positioner outer-grid-item outer-grid-item-sm-8 sticky">
								  
			<div class="page-titler">
						    
				 <span class="inner">
				News
				</span><!-- inner -->

		    </div> <!--.page-title -->


		</div><!-- .page-title-position -->



		<?php
		// set the "paged" parameter (use 'page' if the query is on a static front page)
	  	// $thispaged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		 $newsargs = array(
		//	'posts_per_page' => 3, // 
			'post_type' => 'news',
		 //	'paged'     => $thispaged
		); 
 		//$news_query = new WP_Query( 'post_type=news&paged=' . $paged ); 

		// the query
		$news_query = new WP_Query( $newsargs ); 
		?>

 <div class="post-navigation">

			 	<?php if( get_next_posts_link() ) :?>
				 	<div class="next">
					<?php next_posts_link( 'Older News', $news_query->max_num_pages );?>
				 	</div><!-- .next -->
				<?php endif; ?>
				
				<?php if( get_previous_posts_link() ) :?>	 	
				 	<div class="previous">
					<?php // dio we need this???
					// next_posts_link() usage with max_num_pages
					previous_posts_link( 'Newer News');?>
 					</div><!-- .previous -->

				<?php endif; ?>

			 </div><!--.post-navigation -->

		<?php if ( $news_query->have_posts() ) :
				$itemnumnber = 0;
				 ?>

	

			<?php
			// the loop
			while ( $news_query->have_posts() ) : $news_query->the_post();
			 
				$newsid = get_the_ID();	
				$itemnumnber++;			
				// end get fields
				// echo $newsid;?>
				<article class="news-item item-<?php echo $itemnumnber;?> outer-grid-item inner outer-grid-item-sm-6" data-itemnumber="<?php echo $itemnumnber;?>">
			 		<?php get_template_part( 'content', 'news' );?>
		 		</article>
			
			<?php
			// End the loop.
			 endwhile;?>

		

			<?php 
			// clean up after the query and pagination
			//wp_reset_postdata(); 
			?>

		<?php else:  ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		

		<?php wp_reset_query(); //reset: $past_events_query  ?>	
					 

	</div>  <!-- container -->

<?php get_footer(); ?>