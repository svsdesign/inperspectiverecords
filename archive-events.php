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


<div class="ajax-container" data-barba="container" data-barba-namespace="archive-events">
  
   <article class="container grid">
	
		<section id="upcoming-events" class="archive">
						
			<?php 
			$now = current_time( 'timestamp' ); // Get current unix timestamp
			$hour = 24;
			$today              = strtotime($hour . ':00:00');
			$tendaysago       	= strtotime('-10 day', $today);
			$yesterday          = strtotime('-1 day', $today);
			$tommorow        	= strtotime('+1 day', $today);
			$dayaftertommorow   = strtotime('+2 day', $today);
			$tendayslater    	= strtotime('+10 day', $today);
		 	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$upcomingarg = array (
			'post_type'              => 'events', // your event post type slug
			'post_status'            => 'publish', // only show published events
			//'orderby'                => 'meta_value', // order by date
			//'meta_key'               => 'event_start', // your ACF Date & Time Picker field
			//'meta_value'             => $now, // Use the current time from above
			//'meta_compare'           => '>=', // Compare today's datetime with our event datetime
			'order'                  => 'ASC', // Show earlier events last
			'posts_per_page'         => 24, // because, divisible by 1, 2 and 3 (ensuring all breakpoint designs)
			'paged' 				 => $paged,

			//		 		'orderby' =>  'date',
			'orderby' =>  'meta_value',
			'meta_key' =>  'event_start_date',
			'meta_query' => array(			 		
			        'relation' => 'AND',
			        array(
			            'key'       => 'event_start_date',
			            'compare'   => '>=', // starts after or equal
			            'value'     => $now
			        ),
			        array(
			            'key'       => 'event_end_date',
			            'compare'   => '<=', // starts before or equal
			            'value'     => '9999999999'
			        )
			    ),
			); 
				 
			$upcoming_events_query = new WP_Query( $upcomingarg ); 
			//remove_filter( 'get_meta_sql', 'get_meta_sql_date', 10, 2 );	?>

				<?php if ( $upcoming_events_query->have_posts() ) : ?>
							
					<?php $countevents = 0; ?>

					<div class="event-items">

							 <div class="page-title-positioner outer-grid-item outer-grid-item-sm-6 sticky">
							    <div class="page-titler">
							    
							    <span class="inner">

							      Events
							  	</span><!-- inner -->

							    </div> <!--.page-title -->
							</div><!-- .page-title-position -->

						
						<?php
						// the loop
						while ( $upcoming_events_query->have_posts() ) : $upcoming_events_query->the_post(); 

							include(locate_template('content-events.php')); ?>

						<?php endwhile;	?>
			
					</div><!--event -items -->	

						<div class="page-nav container">
 								
						<?php global $upcoming_events_query;

						    $big = 999999999; // need an unlikely integer

						    echo paginate_links( array(
						        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						        'format' => '?paged=%#%',
						        'current' => max( 1, get_query_var('paged') ),
						        'total' => $upcoming_events_query->max_num_pages,
						        'prev_next' =>true,
						//	      'format' => '/page/%#%',  
						//	      'current' => $current_page,  
						//	      'total' => $total_pages,
						//	      'type' => 'list',
								'prev_text' => '<svg version="1.1" class="svg-icon rs_arrow_left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><g class="arrow_left"><polygon points="50,49.667 50,0 0,24.667"/></g></svg>',
					     	 	'next_text' => '<svg version="1.1" class="svg-icon rs_arrow_right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="10px" height="10px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><g class="arrow_right"><polygon points="0,0 0,49.667 50,25"/></g></svg>'
				

									//'prev_text' => '<div class="hoverlink"><div class="svg-icon hover-icon arrow-left" data-path-hover="M0,6.5L11 0 11 13 0 6.5 0 6.5z"> <svg width="100%" height="100%" xmlns:svg="http://www.w3.org/2000/svg" version="1.0" xml:space="preserve" width="11px" height="13px" viewBox="0 0 11 13"> <path d="M0,6L11 6 11 7 0 7 0 6.5z" class="arrow_right_path" fill="#000" /> </svg> </div><span>Previous</span></div>',
									//'next_text' => '<div class="hoverlink"><div class="svg-icon hover-icon arrow-right" data-path-hover="M11,6.5L0 13 0 0 11 6.5 11 6.5z"> <svg width="100%" height="100%" xmlns:svg="http://www.w3.org/2000/svg" version="1.0" xml:space="preserve" width="11px" height="13px" viewBox="0 0 11 13"> <path d="M11,7L0 7 0 6 11 6 11 6.5z" class="arrow_right_path" fill="#000" /></svg></div><span>Next</span></div>',
									
						    ) );
						?>

					</div>	<!-- ".page-nav" -->		 

					<?php 
					// clean up after the query and pagination
					wp_reset_postdata(); ?>

	 

				<?php else:  ?>

					<?php //_e( 'Sorry, no events' );  
 						
//include a random image of a previous event

								$randomimagearg = array (
									'post_type'              => 'events', // your event post type slug
									'post_status'            => 'publish', // only show published events
									//'orderby'                => 'meta_value', // order by date
									//'meta_key'               => 'event_start', // your ACF Date & Time Picker field
									//'meta_value'             => $now, // Use the current time from above
									//'meta_compare'           => '>=', // Compare today's datetime with our event datetime
								//	'order'                  => 'ASC', // Show earlier events last
									'posts_per_page'         => 1, // because, divisible by 1, 2 and 3 (ensuring all breakpoint designs)
								//	'paged' 				 => $paged,
   									'orderby' 				 => 'rand'
   									); 
										 
									$random_image_query = new WP_Query( $randomimagearg );?>

										<?php if ($random_image_query->have_posts() ) : ?>

											<div class="event-items">

												 <div class="page-title-positioner outer-grid-item outer-grid-item-sm-6 sticky">
												    <div class="page-titler">
												    
												    <span class="inner">

												      Events
												  	</span><!-- inner -->

												    </div> <!--.page-title -->
												</div><!-- .page-title-position -->


												<?php while ( $random_image_query->have_posts() ) : $random_image_query->the_post(); 

													$randomposterart =  get_field('poster_art'); // image
													?>

														<div id="random-event-details" class="grid random-event">
																
															<?php// if($posterart): ?>

															<div class="cover-image-item outer-grid-item outer-grid-item-sm-8" style="background-image: url('<?php echo $randomposterart;?>');">
															</div><!-- image-item -->

															<?php //endif; //$posterart ?>

														</div>


												<?php endwhile;	?>
											
											</div><!--event -items -->	

										<?php endif; //$posterart ?>

									<?php 
									// clean up after the randomn image query
									wp_reset_postdata();  

					 //_e( 'Sorry, no events' );  

				 	endif; ?>

			<?php wp_reset_query(); //reset: $upcoming_events_query  ?>			

				 	
		</section><!-- -->	


		<section id="past-events" class="outer-grid-item inner outer-grid-item-sm-6">


			<?php
			$now = current_time( 'timestamp' ); // Get current unix timestamp
			$hour = 24;
			$today              = strtotime($hour . ':00:00');
			$tendaysago       	= strtotime('-10 day', $today);
			$yesterday          = strtotime('-1 day', $today);
			$tommorow        	= strtotime('+1 day', $today);
			$dayaftertommorow   = strtotime('+2 day', $today);
			$tendayslater    	= strtotime('+10 day', $today);
		 
			 	
 			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$pastarg = array (
			'post_type'              => 'events', // your event post type slug
			'post_status'            => 'publish', // only show published events
			//'orderby'                => 'meta_value', // order by date
			//'meta_key'               => 'event_start', // your ACF Date & Time Picker field
			//'meta_value'             => $now, // Use the current time from above
			//'meta_compare'           => '>=', // Compare today's datetime with our event datetime
			'order'                  => 'DESC', // Show later events last
			'posts_per_page'         => 24, // because, divisible by 1, 2 and 3 (ensuring all breakpoint designs)
			'paged' 				 => $paged,

			//		 		'orderby' =>  'date',
			'orderby' =>  'meta_value',
			'meta_key' =>  'event_start_date',
			'meta_query' => array(			 		
			        'relation' => 'AND',
			        array(
			            'key'       => 'event_start_date',
			            'compare'   => '>=', // starts after or equal
			            'value'     => '0000000000' //$now //'0000000000
			        ),
			        array(
			            'key'       => 'event_end_date',
			            'compare'   => '<=', // starts before or equal
			            'value'     => $now//'9999999999'
			        )
			    ),
			); 
				 
			$past_events_query = new WP_Query( $pastarg ); 
			//remove_filter( 'get_meta_sql', 'get_meta_sql_date', 10, 2 );	?>

				<?php if ( $past_events_query->have_posts() ) : ?>
							
					<?php $countevents = 0; ?>

					<div class="past-event-title">
					Past Events

					</div>

					<div class="event-items">
						
  							<?php
							// the loop
							while ( $past_events_query->have_posts() ) : $past_events_query->the_post(); 
 											
							//start get fields

 				/*		$eventstart = get_field('event_start_date'); // date and time picker
							$eventend = get_field('event_end_date');  // date and time picker
							$posterart =  get_field('poster_art'); // image
							$venue =  get_field('venue');  // text
							//	$artists =  get_field('artists_playing');  // relationship / change to  post object?

							$ticketprice =  get_field('event_ticket_price'); //text
							$description =  get_field('event_description');  // text area							 
							$fblink =  get_field('facebook_link'); //text
							$ralink =  get_field('resident_advisor_link'); //text

							*/
							$eventid = get_the_ID();
							$upcomingeventid = $eventid;
							$isupcomingnextevent = get_post_meta($upcomingeventid, 'is-next-event' );  // if 'true' in array 
							$isupcomingevent = get_post_meta($eventid, 'is-upcoming-event' );  // if 'true' in array 

							//end get fields

								foreach($isupcomingevent as $isupcomingeven){
								  //  echo "is upcoming event? ";
								   // echo $isupcomingeven;

								};

 							 include(locate_template('content-events.php')); ?>


 								
 
						<?php endwhile;	?>
			
					</div><!--event -items -->	

						<div class="page-nav container">
 								
						<?php global $past_events_query;

						    $big = 999999999; // need an unlikely integer

						    echo paginate_links( array(
						        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						        'format' => '?paged=%#%',
						        'current' => max( 1, get_query_var('paged') ),
						        'total' => $past_events_query->max_num_pages,
						        'prev_next' =>true,
						//	      'format' => '/page/%#%',  
						//	      'current' => $current_page,  
						//	      'total' => $total_pages,
						//	      'type' => 'list',
								'prev_text' => '<svg version="1.1" class="svg-icon rs_arrow_left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><g class="arrow_left"><polygon points="50,49.667 50,0 0,24.667"/></g></svg>',
					     	 	'next_text' => '<svg version="1.1" class="svg-icon rs_arrow_right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="10px" height="10px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><g class="arrow_right"><polygon points="0,0 0,49.667 50,25"/></g></svg>'
				

									//'prev_text' => '<div class="hoverlink"><div class="svg-icon hover-icon arrow-left" data-path-hover="M0,6.5L11 0 11 13 0 6.5 0 6.5z"> <svg width="100%" height="100%" xmlns:svg="http://www.w3.org/2000/svg" version="1.0" xml:space="preserve" width="11px" height="13px" viewBox="0 0 11 13"> <path d="M0,6L11 6 11 7 0 7 0 6.5z" class="arrow_right_path" fill="#000" /> </svg> </div><span>Previous</span></div>',
									//'next_text' => '<div class="hoverlink"><div class="svg-icon hover-icon arrow-right" data-path-hover="M11,6.5L0 13 0 0 11 6.5 11 6.5z"> <svg width="100%" height="100%" xmlns:svg="http://www.w3.org/2000/svg" version="1.0" xml:space="preserve" width="11px" height="13px" viewBox="0 0 11 13"> <path d="M11,7L0 7 0 6 11 6 11 6.5z" class="arrow_right_path" fill="#000" /></svg></div><span>Next</span></div>',
									
						    ) );
						?>

					</div>	<!-- ".page-nav" -->		 

					<?php 
					// clean up after the query and pagination
					wp_reset_postdata(); ?>

	 

				<?php else:  ?>
				
					<div class="" style="">
						<?php _e( 'Sorry, no events' ); ?>
					</div>
					<?php get_template_part( 'content', 'none' ); ?>
				

				<?php endif; ?>

			<?php wp_reset_query(); //reset: $past_events_query  ?>	

		</section><!-- -->						 
	 
	</article>  <!-- container -->

</div><!-- class="ajax-container" data-barba="container" data-barba-namespace -->
		 
<?php get_footer(); ?>