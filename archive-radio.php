<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   
 */

get_header();?>

		<article class="container grid">
		 
			<?php
			$now = current_time( 'timestamp' ); // Get current unix timestamp

			// set the "paged" parameter
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$radiosargs = array(

				'post_type' => 'radio',
				'post_status' => 'publish', // only show published events
				'order' => 'DESC', // Show earlier events last
				'paged' => $paged,
				'posts_per_page' => 9,

				'orderby' =>  'meta_value',
				'meta_key' =>  'show_start_date',
				'meta_query' => array(			 		
			        'relation' => 'AND',
			        array(
			            'key'       => 'show_start_date',
			            'compare'   => '>=', // starts after or equal
			            'value'     => '0000000000' //$now //'0000000000
			        ),
			        array(
			            'key'       => 'show_end_date',
			            'compare'   => '<=', // starts before or equal
			            'value'     => $now//'9999999999'
			        )
			    ),
 
			);
			// the query
			$temp = $radio_query;
			$radio_query = new WP_Query( $radiosargs ); 
			?>

			<?php if ( $radio_query->have_posts() ) :
			 ?>

				<?php // are we on page one- so we can include the first item
				 if(1 == $paged):
				$pageno = 'first';?>
				

					<section id="past-radios" class="archive show-items grid <?php echo $pageno;?>-page">
					
						<div class="page-title-positioner outer-grid-item outer-grid-item-sm-6 sticky">
								   
						    <div class="page-titler">
						    
							    <span class="inner">
									Radio
							  	</span><!-- inner -->

						    </div> <!--.page-title -->

						</div><!-- .page-title-position -->
			 			
			 			<div class="container top-container radio-items">		
			
				<?php else : // not page 1 :
					 $pageno = 'not-first';
					 ?>
		
					<section id="past-radios" class="archive show-items grid <?php echo $pageno;?>-page">
							
			 			 <div class="page-title-positioner outer-grid-item outer-grid-item-sm-6 sticky">
								   
						    <div class="page-titler">
						    
							    <span class="inner">
									Radio
							  	</span><!-- inner -->

						    </div> <!--.page-title -->

						</div><!-- .page-title-position -->

			 			<div class="container radio-items">		

				<?php endif;  //  are we on page 1 ?>

 
					<?php
					// the loop
					$itemno = 1;
					while ( $radio_query->have_posts() ) : $radio_query->the_post(); 
					 // initial counter if we have post
					if(1 == $paged): // page one: 

						$showid = get_the_ID();	
						$showtitle = get_the_title();// title		
						$soundcloudlink = get_field('soundcloud_link');
						?>
					 	<li data-tracklink="<?php echo $soundcloudlink;?>">

							<a class="radio-item radio-item-<?php echo $itemno;?> outer-grid-item outer-grid-item-sm-8 <?php if ($itemno != "1"):?> outer-grid-item-md-4<?php endif;?>" href="<?php echo the_permalink();?>" title="<?php echo $showtitle; ?>" id="radio-item-<?php echo $showid?>">

			 					<?php get_template_part( 'content-radio' );?>
							 	
							</a><!-- .radio-item outer-grid-item outer-grid-item-sm-8-->
					 	</li>

						<?php //$itemno++;

						if($itemno == 1): ?>
						</div>  <!-- top container--> 
				 		<div class="container radio-items outer-grid-item outer-grid-item-sm-6 inner">  
					 	<?php endif; //item no == 2  

						if($itemno == 7): ?>
						</div>  <!-- container--> 
				 		<div class="container radio-items bottom-container outer-grid-item outer-grid-item-sm-6 inner">  
				 
				 			<div class="bottom-title">
				 				Other Shows
					 		</div>

					 	<?php endif; //item no == 7  

					else : // not page 1 :
					 
						$showid = get_the_ID();	
						$showtitle = get_the_title();// title						
		 				$soundcloudlink = get_field('soundcloud_link');

						?>

						<?php // are we on page one?
						//if($itemno == 2):?>
					<!--	<div class="container outer-grid-item outer-grid-item-sm-6 inner"> -->
					 	<?php //endif; // endif paged ?>
					 	<li data-tracklink="<?php echo $soundcloudlink;?>">

							<a class="radio-item radio-item-<?php echo $itemno;?> outer-grid-item outer-grid-item-sm-8 <?php if ($itemno != "1"):?> outer-grid-item-md-4<?php endif;?>" href="<?php echo the_permalink();?>" title="<?php echo $showtitle; ?>" id="radio-item-<?php echo $showid?>">

			 					<?php get_template_part( 'content-radio' );?>
							 	
							</a><!-- .radio-item outer-grid-item outer-grid-item-sm-8-->

						</li>	

 								
					<?php endif;  //  are we on page 1

					$itemno++;

					endwhile;// End the loop. ?>
				
		 			</div><!-- .container added this assuming we have atleast 2 items and .container div exists -->

				<div class="page-nav">
							
					<?php global $radio_query;

					    $big = 999999999; // need an unlikely integer

					    echo paginate_links( array(
					        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					        'format' => '?paged=%#%',
					        'current' => max( 1, get_query_var('paged') ),
					        'total' => $radio_query->max_num_pages,
					        'prev_next' =>true,
					//	      'format' => '/page/%#%',  
					//	      'current' => $current_page,  
					//	      'total' => $total_pages,
					//	      'type' => 'list',
					//     'prev_text' => '<div class="next">' . get_template_part('svg/inline', 'dm_arrow_left.svg') .'</div>',
							'prev_text' => '<div class="small nav-previous align-left"><svg class="svg-icon previous-arrow-icon" width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g fill="#FFFFFF" fill-rule="nonzero"> <polygon transform="translate(19.874778, 20.000000) scale(-1, 1) rotate(-270.000000) translate(-19.874778, -20.000000) " points="19.8747779 29.2278846 37.6296018 6.12522213 39.8747779 7.85068148 19.8747779 33.8747779 -0.12522213 7.85068148 2.1199539 6.12522213"></polygon> </g> </g> </svg></div>Newer Shows',
							'next_text' => '<div class="small nav-next align-right"><svg class="svg-icon next-arrow-icon" width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g fill="#FFFFFF" fill-rule="nonzero"> <polygon transform="translate(19.874778, 20.000000) scale(-1, 1) rotate(-270.000000) translate(-19.874778, -20.000000) " points="19.8747779 29.2278846 37.6296018 6.12522213 39.8747779 7.85068148 19.8747779 33.8747779 -0.12522213 7.85068148 2.1199539 6.12522213"></polygon> </g> </g> </svg></div>Older Shows',
				    ) );
					?>

				</div>	<!-- ".page-nav-->		 

   


			</section><!-- .past-radios-->

			<?php
			// clean up after the query and pagination
			$radio_query = null;
			$radio_query = $temp; ?>
			

			<?php else:  ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php get_template_part( 'content', 'none' );  				// I should pull in the ;404??>

			<?php endif; ?>
											 
				 

 		</article><!-- -->


<?php get_footer(); ?>