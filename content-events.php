<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 * content-events.php -  the template for displaying events content
 */
?>

 <?php if ( is_single() ) : //is single content  
	
	$eventid = get_the_ID();	
	$name =  get_field('event_name');						
 	$eventstart = get_field('event_start_date'); // date and time picker
//	$eventend = get_field('event_end_date');  // date and time picker
	$posterart =  get_field('poster_art'); // image - large bg
	$bannerart =  get_field('banner_art'); // image - banner
	//$artists =  get_field('artists_playing');  // relationship / change to  post object?
	$venue =  get_field('venue');  // text
	$venuelink =  get_field('venue_url');  // text

	//$ticketprice =  get_field('event_ticket_price'); //text
	$description =  get_field('event_description');  // text area							 
	$fblink =  get_field('facebook_link'); //text
	$ralink =  get_field('resident_advisor_link'); //text
		$isnextevent = get_post_meta($eventid, 'is-next-event' );  // if 'true' in array 
  	$isupcomingevent = get_post_meta($eventid, 'is-upcoming-event' );  // if 'true' in array 
	$shareid = mt_rand(100000, 999999);

	//end get fields



	/*	//	 echo $isupcomingevent;

	foreach($isupcomingevent as $isupcomingeven){
    echo $isupcomingeven
};*/

// echo $isupcomingevent;

	foreach($isupcomingevent as $isupcomingeven){
	  //  echo "is upcoming event? ";
	  //  echo $isupcomingeven;

	};

	?>




	<section id="event-details" class="grid <?php if (in_array("true", $isnextevent)): ?>next-event<?php endif; //$isnextevent ?>">
	
		 <div class="page-title-positioner outer-grid-item outer-grid-item-sm-8 sticky">
								  
			<div class="page-titler">
						    
				 <span class="inner">
				 Events
				</span><!-- inner -->

		    </div> <!--.page-title -->


		</div><!-- .page-title-position -->
		
		<?php if($posterart): ?>

		<div class="cover-image-item outer-grid-item outer-grid-item-sm-8" style="background-image: url('<?php echo $posterart;?>');">
		</div><!-- image-item -->

		<?php endif; //$posterart ?>


		<div class="details-wrap outer-grid-item inner outer-grid-item-sm-6">

			<div class="grid">

				<?php if($name): ?>

					<div class="event-name grid-item grid-item-xs-6">	
					<?php echo $name; ?>
 					</div><!-- .event-name -->
			
				<?php endif; //$name ?>	

				<div class="date-item grid-item grid-item-xs-6 grid-item-md-3">
							
					<span class="date">
					<?php $startdate = get_field('event_start_date'); echo date_i18n('dS F Y', $startdate);  ?>
					</span> 

					<span class="time">
					<?php $starttime = get_field('event_start_date'); echo date_i18n('H:i', $starttime);  ?> -
					<?php $endtime = get_field('event_end_date'); echo date_i18n('H:i', $endtime);  ?>
					</span> 

				</div><!-- .date -->

				<div class="event-summary grid-item grid-item-xs-6 grid-item-md-3">
					

					<div class="event-summary-bg">	
					</div>	
			

					<?php if($venue): ?>

						<div class="venue summary-item">
							
							<a class="scale-link" target="_blank" href="<?php echo $venuelink;?>">

							<span><?php the_field('venue'); ?></span>   
							<div class="svg-icon inline-icon right">
							<?php get_template_part('/assets/svg/inline-inp_location-marker.svg'); ?>
					 		</div><!-- svg-icon inline-icon -->	
						
							</a> 

						</div><!-- .venue -->

					<?php endif; //$venue ?>	 

					<?php if($ralink): ?>

						<div class="summary-item price">
							
							<a class="scale-link" target="_blank" href="<?php echo $ralink;?>">
								
								<span class="">Buy Tickets</span>
								<div class="svg-icon inline-icon right white-icon">
								<?php get_template_part('/assets/svg/inline-inp_arrow-right.svg'); ?>
					 			</div><!-- svg-icon inline-icon -->	
					 		
					 		</a> 

						</div>	

					<?php endif; //$ralink ?>

					<?php if (in_array("true", $isupcomingevent )): ?>
						
						<?php if($fblink): ?>

						<div class="summary-item event-social">


								<a class="fb-details scale-link" target="_blank" href="<?php echo $fblink ;?>">
									
										<span>Facebook Event</span>
										<div class="svg-icon inline-icon right">
										<?php get_template_part('/assets/svg/inline-inp_facebook-logo.svg'); ?>
					 					</div><!-- svg-icon inline-icon -->	
					
				
								</a><!-- .fb-details -->
				
						</div> <!--event-social-->													
						
						<?php endif; //$fblink ?>

					<?php else: // if is in array: $isupcomingevent ?>

						<div class="summary-item past">


							<?php  
							$now = current_time( 'timestamp' );
						    // prepare to get a list of events sorted by the event date
							$nextevent = array (
								'post_type'              => 'events', // your event post type slug
								'post_status'            => 'publish', // only show published events
							 	'order'                  => 'ASC', // Show earlier events last
								'posts_per_page'         => 1, // only want to get the next event
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
							    query_posts( $nextevent );  ?>
									
									<?php if ( have_posts() ) : ?>
														
											<?php
										// Start the Loop.
										while ( have_posts() ) : the_post(); ?>
 		 
					 						<a class="event-link scale-link-right" href="<?php the_permalink();?>">	

						 						<span>This event has now passed</span>
												<span class="right">View Next Event<span>

											</a>		 
												                  
										<?php // End the loop. 
										endwhile; ?>
											
										<?php else: // elset ?>
										
											<span>This event has now passed</span>

										<?php endif; // endif have post ?>

									
								<?php wp_reset_query(); ?>								
							
							</div><!--event-social-->	

						<?php endif; // if is in array: $isupcomingevent ?>

				</div> <!-- .event-summary -->

			</div><!--.grid -->

			<div class="grid">

				<?php $lineup = get_field('lineup');	
				if( $lineup ):  //group

					if( have_rows('lineup') ): ?>
					<div id="lineup-wrap" class="grid-item grid-item-xs-6 grid-item-md-3">
					<?php 

						while( have_rows('lineup') ): the_row(); ?>
						<div>
						
							<?php 
							if( have_rows('rooms') ): ?>
								
								<ul>

								<?php 
								// loop through rows (sub repeater)
								while( have_rows('rooms') ): the_row();	?>

									<li class="room">
										
										<span class="room-name">
											<?php the_sub_field('room_name'); ?>
										</span>
	 								
										<?php if( have_rows('room_items') ): ?>
												
											<ul class="room-items">
												
												<?php while( have_rows('room_items') ): the_row();

													if( get_row_layout() == 'label_artist_item' ):
											 		$artistid = get_sub_field('label_artist');  // post id 
													$name = get_field( "artist_name", $artistid);?>

													 	<li class="artist-name label-artist">
													 	
														 	<a class="" href="<?php echo get_permalink($artistid); ?>">
															
																<span>
																<?php echo $name; ?>
																</span>

															</a>
													    
													    <?php /*
															<a class="link-animation" href="<?php echo get_permalink($artistid); ?>">

														 		<?php for ($k = 0 ; $k < 26; $k++):?>
														    	<span class="anim-text"><?php echo $name; ?> </span>
																<?php endfor; ?>
														    	<div class="height-item"><?php echo $name; ?></div>

															</a>
													    */ ?>

													    </li>
														 
													<?php elseif( get_row_layout() == 'other_artist_item' ):?>
														
														<li class="artist-name other-artist">

 															<span>
 																<?php the_sub_field('other_artist'); ?>
															</span>

														</li>

													<?php elseif( get_row_layout() == 'text_item' ):?>

														<li class="text-item">

															<span>
															<?php the_sub_field('text'); ?>
															</span>

														</li>

													<?php endif; //if( get_row_layout() == 'label_artist') ): ?>

												<?php endwhile; ?>

											</ul><!-- room-items -->

										<?php endif; //if( have_rows('room_items') ): ?>
														
									</li><!-- room-name -->

									<?php endwhile; // have_rows('rooms') )?>
									
									</ul>
								
								<?php endif; //if( have_rows('rooms') ) ?>
							
							</div>	

						<?php endwhile; // while  have_rows('lineup') ): ?>
						
						</div>

					<?php endif; // if( have_rows('lineup') ): ?>

				<?php endif; // if lineup ?>
					
				<div class="event-description-wrap grid-item grid-item-xs-6 grid-item-md-3">
						
						<?php if($description): ?>

						<div class="description">

							<span><?php echo $description; ?></span>   
						
						</div><!-- .description -->

					<?php endif; //$description ?>	 

				</div><!-- .event-description-wrap -->

			</div><!--.grid -->

		</div><!--.outer-grid-item inner -->

	</section><!-- event-details outer-grid-item inner -->
 
		<?php 		
		$now = current_time( 'timestamp' );
		// prepare to get a list of events sorted by the event date
	    $argseventspage = array(
	        
		'post_type'              => 'events', // your event post type slug
		'post__not_in' => array($post->ID), // exclude the current post
		'post_status'            => 'publish', // only show published events
	 	'order'                  => 'ASC', // Show earlier events last
		'showposts' 			 => 999,
	//	'posts_per_page'         => 1, // only want to get the next event
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

		$argseventspage_query = new WP_Query( $argseventspage ); 
		$events_found = false;  			 
    	// build up the HTML from the retrieved list of events
	    ?>
			
				<?php if ( $argseventspage_query->have_posts() ) : ?>

				<section id="upcoming-events" class="">

					<div class="upcoming-events-title grid">	
						<span class="grid-item-xs-6 grid-item-md-3 grid-item-lg-2">
						Upcoming Events:	
						</span>

					</div><!--.event-items-title-->	

					<div class="event-items grid post-total-<?php echo $argseventspage_query->post_count; ?>">	
					
						<?php
						// Start the Loop.
							while ( $argseventspage_query->have_posts() ) : $argseventspage_query->the_post(); 						 
														
							//start get fields
							$upcomingeventid = get_the_ID();							
							$eventstart = get_field('event_start_date'); // date and time picker
							$eventend = get_field('event_end_date');  // date and time picker
							$posterart =  get_field('poster_art'); // image
							$bannerart =  get_field('banner_art'); // image - banner

							$venue =  get_field('venue');  // text
							$venuelink =  get_field('venue_url');  // text
							$name =  get_field('event_name');						
							//$ticketprice =  get_field('event_ticket_price'); //text
							$fblink =  get_field('facebook_link'); //text
							$ralink =  get_field('resident_advisor_link'); //text
							$isupcomingnextevent = get_post_meta($upcomingeventid, 'is-next-event' );  // if 'true' in array 
							//end get fields
							//var_dump($isupcomingnextevent) 
							?>
		 	
								<?php if($bannerart): ?>

									<div class="event-item event-image-item outer-grid-item inner-padded outer-grid-item-sm-6 <?php if (in_array("true", $isupcomingnextevent)): ?>next-event<?php endif; //$isupcomingnextevent ?>" style="background-image: url('<?php echo $bannerart;?>');">
								
									<?php else:?>

									<div class="event-item outer-grid-item inner-padded outer-grid-item-sm-6 <?php if (in_array("true", $isupcomingnextevent)): ?>next-event<?php endif; //$isupcomingnextevent ?>">

								<?php endif; //$posterart ?>

									<div class="grid">
							
										<?php if($name): ?>

											<div class="event-name grid-item grid-item-xs-6 grid-item-md-3">
														
												<?php echo $name; ?>
															
											</div><!-- .event-name -->
									
										<?php endif; //$name ?>

										<div class="date grid-item grid-item-xs-6 grid-item-md-3">
													
											<?php $startdate = get_field('event_start_date'); echo date_i18n('dS F Y', $startdate);  ?>
											<?php// $starttime = get_field('event_start_date'); echo date_i18n('h:i', $starttime);  ?>
											<?php //$endtime = get_field('event_end_date'); echo date_i18n('h:i', $endtime);  ?>

										</div><!-- .date -->

										<div class="event-summary grid-item grid-item-xs-6 grid-item-md-3">
												
											<!-- review this <div class="event-summary-bg">	
											</div>	-->
			

											<?php if($venue): ?>

												<div class="summary-item venue">
													
													<a class="scale-link" target="_blank" href="<?php echo $venuelink;?>">

													<span><?php the_field('venue'); ?></span>   
													<div class="svg-icon inline-icon right white-icon">
													<?php get_template_part('/assets/svg/inline-inp_location-marker.svg'); ?>
											 		</div><!-- svg-icon inline-icon -->	
												
													</a> 

												</div><!-- .venue -->

											<?php endif; //$venue ?>	 

											<?php if($ralink): ?>

												<div class="summary-item price">
													
													<a class="scale-link" target="_blank" href="<?php echo $ralink;?>">
														
														<span class="">Buy Tickets</span>
														<div class="svg-icon inline-icon right white-icon">
														<?php get_template_part('/assets/svg/inline-inp_arrow-right.svg'); ?>
											 			</div><!-- svg-icon inline-icon -->	
											 		
											 		</a> 

												</div>	

											<?php endif; //$ralink ?>

											<?php if($fblink): ?>

												<div class="summary-item fb-details">
														
													<a class="scale-link" href="<?php echo $fblink ;?>">
													
														<span>Facebook Event</span>
														<div class="svg-icon inline-icon right white-icon">
														<?php get_template_part('/assets/svg/inline-inp_facebook-logo.svg'); ?>
									 					</div><!-- svg-icon inline-icon -->	
									
													</a>
								
												</div><!-- .fb-details -->

											<?php endif; //$fblink ?>
									
											<div class="summary-item event-link">

												<a class="scale-link" href="<?php the_permalink();?>">
													
													<span class="">More Information</span>
													<div class="svg-icon inline-icon right white-icon">
													<?php get_template_part('/assets/svg/inline-inp_arrow-right.svg'); ?>
										 			</div><!-- svg-icon inline-icon -->	
										 													 		
												</a>

											</div><!--.event-link"-->
											
										</div> <!-- .event-summary -->

									</div><!--.grid -->

								<?php if($posterart): ?>

									</div><!--.event-item event-image-item -->
								
									<?php else:?>

									</div><!-- .event-item -->

								<?php endif; //$posterart ?>


	                   <?php $events_found = true;?>
						                  
						<?php // End the loop. 
						endwhile; ?>
					
					</div> <!-- event-items -->									

				<?php endif; // endif have post ?>
			
		<?php
		// clean up after the query and pagination
		wp_reset_postdata(); ?>			

	</section><!-- #upcoming-events .fluid-container.modular -->

	<section class="view container">
	
		<div class="row">

	 	<a href="../../events" class="item">
	 		<span>View All Events</span>
			
			<div class="svg-icon black">
				<?php get_template_part('/assets/svg/inline-rs_three_lines.svg'); ?>
	 		</div><!-- svg-icon black -->
		</a> <!--  -->																	
		
	</div> <!-- .row  -->									


	</section><!-- view .container -->


<?php endif; // endif is_single() ?>

<?php if ( is_archive() ) : //is archive content 
	  


	//$upcomingeventid = get_the_ID();							
	$eventstart = get_field('event_start_date'); // date and time picker
	$eventend = get_field('event_end_date');  // date and time picker
	$posterart =  get_field('poster_art'); // image
	$venue =  get_field('venue');  // text
	$venuelink =  get_field('venue_url');  // text
	$name =  get_field('event_name');		//text area				

	//$ticketprice =  get_field('event_ticket_price'); //text
	$fblink =  get_field('facebook_link'); //text
	$ralink =  get_field('resident_advisor_link'); //text
	//	$isupcomingnextevent = get_post_meta($upcomingeventid, 'is-next-event' );  // if 'true' in array 
	 // 	$isupcomingevent = get_post_meta($eventid, 'is-upcoming-event' );  // if 'true' in array 

		//end get fields
	 //var_dump($isupcomingnextevent) 
	 //echo $isupcomingevent;

	//foreach($isupcomingevent as $isupcomingeven){
   // echo $isupcomingeven;
	//}

	if($isupcomingeven == false): // = isupcoming - not the other way round? ?>


		<?php if($posterart): ?>

			<div class="event-item event-image-item outer-grid-item inner-padded outer-grid-item-sm-6 <?php if (in_array("true", $isupcomingnextevent)): ?>next-event<?php endif; //$isupcomingnextevent ?>" style="background-image: url('<?php echo $posterart;?>');">
		
			<?php else:?>

			<div class="event-item outer-grid-item inner-padded outer-grid-item-sm-6 <?php if (in_array("true", $isupcomingnextevent)): ?>next-event<?php endif; //$isupcomingnextevent ?>">

		<?php endif; //$posterart ?>

			<div class="grid">

				<?php if($name): ?>

					<div class="event-name grid-item grid-item-xs-6 grid-item-md-3">
								
						<?php echo $name; ?>
									
					</div><!-- .event-name -->

				<?php endif; //$name ?>

				<div class="date grid-item grid-item-xs-6 grid-item-md-3">
							
					<?php $startdate = get_field('event_start_date'); echo date_i18n('dS F Y', $startdate);?>
					<?php //$starttime = get_field('event_start_date'); echo date_i18n('h:i', $starttime);?>
					<?php //$endtime = get_field('event_end_date'); echo date_i18n('h:i', $endtime);  ?>

				</div><!-- .date -->

				<div class="event-summary grid-item grid-item-xs-6 grid-item-md-3">

					<?php if($venue): ?>

						<div class="venue summary-item">
							
							<a class="scale-link" target="_blank" href="<?php echo $venuelink;?>">

							<span><?php the_field('venue'); ?></span>   
							<div class="svg-icon inline-icon right">
							<?php get_template_part('/assets/svg/inline-inp_location-marker.svg'); ?>
					 		</div><!-- svg-icon inline-icon -->	
						
							</a> 

						</div><!-- .venue -->

					<?php endif; //$venue ?>	 

					<?php if($ralink): ?>

						<div class="price summary-item">
							
							<a class="scale-link" target="_blank" href="<?php echo $ralink;?>">
								
								<span class="">Buy Tickets</span>
								<div class="svg-icon inline-icon right white-icon">
								<?php get_template_part('/assets/svg/inline-inp_arrow-right.svg'); ?>
					 			</div><!-- svg-icon inline-icon -->	
					 	
				 			</a> 

						</div>	

					<?php endif; //$ralink ?>
						
					<?php if($fblink): ?>

				 
						<div class="fb-details summary-item">
							
							<a class="scale-link" href="<?php echo $fblink ;?>">
								
								<span>Facebook Event</span>	
								<div class="svg-icon inline-icon right">
								<?php get_template_part('/assets/svg/inline-inp_facebook-logo.svg'); ?>
					 			</div><!-- svg-icon facebook-logo -->	
					 		
							</a>

						</div><!-- .fb-details -->		
				
					<?php endif; //$fblink ?>


					<div class="event-link summary-item">
							
							<a class="scale-link" href="<?php the_permalink();?>">
							
							<span class="">More Information</span>
							<div class="svg-icon inline-icon right white-icon">
							<?php get_template_part('/assets/svg/inline-inp_arrow-right.svg'); ?>
				 			</div><!-- svg-icon inline-icon -->	
				 		
						</a>


					</div><!--.event-link"-->
					
				</div> <!-- .event-summary -->

			</div><!--.grid -->

		<?php if($posterart): ?>

			</div><!--.event-item event-image-item -->
		
			<?php else:?>

			</div><!-- .event-item -->

		<?php endif; //$posterart ?>
						                  
	<?php else: //past event  // isnotupcoming ?>
	
	<div class="past-event-item">

		<a href="<?php the_permalink();?>" class="grid scale-me grid-item-sm-6">
 
 		 
			
			<div class="date grid-item grid-item-xs-2 grid-item-sm-1 grid-item-md-1">
						
				<?php $startdate = get_field('event_start_date'); echo date_i18n('d.m.Y', $startdate);  ?>
				<?php// $starttime = get_field('event_start_date'); echo date_i18n('h:i', $starttime);  ?>
				<?php //$endtime = get_field('event_end_date'); echo date_i18n('h:i', $endtime);  ?>

			</div><!-- .date -->

			<div class="event-name grid-item grid-item-xs-2 grid-item-sm-3 grid-item-md-3">
						
				<?php $name = the_title(); echo $name;  ?>
							
			</div><!-- .event-name -->

			<?php if($venue): ?>

				<div class="venue grid-item grid-item-xs-2">

					<span><?php the_field('venue'); ?></span>   
				
				</div><!-- .venue -->

			<?php endif; //$venue ?>	 

		</a>

	</div><!--event-item -->

	<?php endif; // endif $isupcomingevent ?>

 <?php endif; // endif is_archive() ?>