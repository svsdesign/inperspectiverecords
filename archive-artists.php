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

<div class="ajax-container" data-barba="container" data-barba-namespace="archive-artists">

	   <article class="container grid">
					
				 <div class="page-title-positioner outer-grid-item outer-grid-item-sm-8 sticky">
										  
					<div class="page-titler">
								    
						 <span class="inner">
						Artists
						</span><!-- inner -->

				    </div> <!--.page-title -->


				</div><!-- .page-title-position -->
				
				<?php
				// set the "paged" parameter (use 'page' if the query is on a static front page)
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$artistsargs = array(
					'posts_per_page' => 99,
					'post_type' => 'artists',
					'paged'          => $paged
				);
				// the query
				$artists_query = new WP_Query( $artistsargs ); 
				?>

				<?php if ( $artists_query->have_posts() ) : ?>

 					<div class="image-items">

						<?php
						// the loop
						while ( $artists_query->have_posts() ) : $artists_query->the_post();
						 
							$artistid = get_the_ID();
								$artistimage = get_field('artist_profile_image'); // image
						 	//end get fields
							?>

						    <div class="image-item" data-image="<?php echo $artistid;?>-image" style="background-image: url('<?php echo $artistimage;?>');">
						    </div><!-- image-item -->
						 
						<?php
						// End the loop.
						 endwhile;?>

						</div><!-- image-items -->
 
 					<div class="list-items">
				
						<?php
						// the loop
						while ( $artists_query->have_posts() ) : $artists_query->the_post();
						 
					 	$artistid = get_the_ID();
						$artistname = get_field('artist_name'); // Text
						?>
						 
						     <?php if($artistname): ?>
						    	
						    	<a href="<?php echo the_permalink();?>" class="list-item" data-imgid="<?php echo $artistid;?>-image">

						     		<div class="item-text">
								
											<?php echo $artistname;?>

									</div><!-- item-text -->		
						    	</a><!-- list-item -->

							<?php endif; //$artistname ?>
						    
						<?php
						// End the loop.
						 endwhile;?>
			
					</div><!-- list-items -->


			<?php // dio we need this???
			// next_posts_link() usage with max_num_pages
			next_posts_link( 'Older Entries', $artists_query->max_num_pages );
			previous_posts_link( 'Newer Entries' );
			?>

			<?php 
			// clean up after the query and pagination
			wp_reset_postdata(); 
			?>

			<?php else:  ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>							 

	</article>  <!-- container -->

</div><!-- class="ajax-container" data-barba="container" data-barba-namespace="archive-artists"-->

<?php get_footer(); ?>