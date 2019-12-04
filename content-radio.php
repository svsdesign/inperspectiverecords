<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   
 */
?>

<?php if ( is_home() ) :?>

// home radio item

<?php endif; //is_home() ?>

<?php if ( is_single() ) : //is single content  

	$showid = get_the_ID();	
	$showtitle = get_the_title();// title						
 	$showstart = get_field('show_start_date'); // date and time picker
    $showend = get_field('show_end_date');  // date and time picker
	$featureimage =  get_field('feature_image'); // image
	$featureimagecredit =  get_field('feature_image_credit');  // text 
 	$description =  get_field('show_description');  // text area							 
 	$soundcloudlink =  get_field('soundcloud_link'); //text
	$soundcloudembed =  get_field('soundcloud_embed'); // iframe / file?
	$itemno = 0 ;// review the use of this
//
//		$isnextevent = get_post_meta($eventid, 'is-next-event' );  // if 'true' in array 
  //	$isupcomingevent = get_post_meta($eventid, 'is-upcoming-event' );  // if 'true' in array 
	//$shareid = mt_rand(100000, 999999);

  //if (in_array("true", $isnextevent)):// next-event<?php endif; //$isnextevent  
?>
	

 	<section id="show-details" class="grid" <?php if($soundcloudlink): ?>data-radio-link="<?php echo $soundcloudlink;?>"<?php endif;?>>
	
		 <div class="page-title-positioner outer-grid-item outer-grid-item-sm-8 sticky">
								  
			<div class="page-titler">
						    
				 <span class="inner">
				<!--<a href="<?php //echo home_url();?>/radio">Radio</a> Is it worth adding links? review if so-->
				Radio
				</span><!-- inner -->

		    </div> <!--.page-title -->

		</div><!-- .page-title-position -->
		
		<?php if($featureimage): ?>

			
		<div class="cover-image-item outer-grid-item outer-grid-item-xs-8" style="background-image: url('<?php echo $featureimage;?>');">
		</div><!-- .cover-image-item -->

		<?php endif; //$featureimage  ?>

		<li data-tracklink="<?php echo $soundcloudlink;?>" class="outer-grid-item inner outer-grid-item-sm-6">

			<div class="wrapping grid">	
			
				<a class="single-radio-item single-radio-item-<?php echo $itemno;?> grid-item grid-item-sm-1" title="play <?php echo $showtitle; ?>" id="radio-item-<?php echo $showid?>">

 					<?php// get_template_part( 'content-radio' );?>

 					<div class="play-icon-wrap">

						<div class="play-toggle small"> 
						
						 	<svg id="playertoggle" class=""  width="100%" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"> 
						 		<path d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> 
						 		<path d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> 
						 		<path d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> 
						 		<path opacity="0" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> 
						 		<path opacity="0" d="M447,1000 0,1000 0,0 447,0 447,500.084 z" fill-rule="nonzero"/> 
						 		<path opacity="0" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> 
						 		<path style="display:none;" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> 
						 		<path style="display:none;" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> 
						 		<path style="display:none;" d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> 
						 	</svg> 
						
						</div> 

				    </div>
				 	
				</a><!-- .radio-item outer-grid-item outer-grid-item-sm-8-->
		
						
				<div class="details-wrap grid-item grid-item-sm-5">
							
					<div class="radio-date">
						<?php $showstart = get_field('show_start_date'); echo date_i18n('dS F Y', $showstart);  ?>
					 </div><!-- .date -->
					
					<?php if($showtitle): ?>

						<div class="radio-name">	
						<?php echo $showtitle; ?>
	 					</div><!-- .event-name -->
				
					<?php endif; //$name ?>	

				</div><!--.details-wrap -->
				
				<?php if($description): ?>

					<div class="show-description-wrap grid-item push-item-left-xs-1 grid-item-xs-4">
	
						<div class="description">

							<span><?php echo $description; ?></span>   
						
						</div><!-- .description -->

					</div><!-- .show-description-wrap -->
				
				<?php endif; //$description ?>	 

			</div><!-- wrapping -->

		</li>

	</section><!-- show-details outer-grid-item inner -->

		<?php 		
		$now = current_time( 'timestamp' );
 	    $argsradiopage = array(
	        
		'post_type'              => 'radio', // your event post type slug
		//'post__not_in' => array($post->ID), // exclude the current post < doing this probably mean we're creating an issue with my unique IDs
		'post_status'            => 'publish', // only show published events
	 	'order'                  => 'DESC', // Show earlier events last < this order might be cause problems with muy php ID's
		'showposts' 			 => 999,
	//	'posts_per_page'         => 1, // only want to get the next event
		'orderby' 				=>  'meta_value',
		'meta_key' 				=>  'show_start_date',
		'meta_query'			=> array(			 		
		'relation'				=> 'AND',
		        array(
		            'key'       => 'show_start_date',
		            'compare'   => '>=', // starts after or equal
		            'value'     => '0000000000' //$now //'0000000000
		        ),
		        array(
		            'key'       => 'show_end_date',
		            'compare'   => '<=', // starts before or equal
		            'value'     => $now//'9999999999'
		        ),
		      	array(
			        'key'	  	=> 'is_item_public', // only allow items that are "public" - by default value either not set or 0 (if set)
			        //'value'	  	=> 'true',
			        //'compare' 	=> 'NOT EXISTS'
			        'value' => '1',
    				'compare' => '==' // not really needed, this is the default
			    )

		    ),	

		); 

		$argsradiopage_query = new WP_Query( $argsradiopage ); 
		$radio_found = false;  			 
 	    
 	    if ( $argsradiopage_query->have_posts() ) :
	 	$thisnumber = 0;
 		?>

			<section id="other-shows" class="outer-grid-item inner outer-grid-item-sm-6">

				<div class="upcoming-events-title">	
				Other Shows
				</div><!--.event-items-title-->	

					<div class="radio-items grid post-total-<?php echo $argseventspage_query->post_count; ?>">	
					
						<?php
						// Start the Loop.
						while ( $argsradiopage_query->have_posts() ) : $argsradiopage_query->the_post(); 						 

 						 	$showid = get_the_ID();// this is the post id	
						 	$showtitle = get_the_title();// title		
							$showstart = get_field('show_start_date'); // date and time picker
							$showend = get_field('show_end_date');  // date and time picker
							$soundcloudlink = get_field('soundcloud_link');
							?>
							<!-- start new -->

							<li data-tracklink="<?php echo $soundcloudlink;?>" class="radio-item-li radio-item-li-<?php echo $thisnumber;?> grid-item grid-item-sm-8 <?php if ($itemno != "1"):?>grid-item-md-4<?php endif;?>">

								<div class="wrapping">	
								
									<a class="radio-item radio-item-<?php echo $thisnumber;?>" title="play <?php echo $showtitle; ?>" id="radio-item-<?php echo $showid?>">

											
										<div class="play-icon-wrap">

 										<!-- changes thesed IDs to classes + making sure clikcing them doesn't intefere with current script(s)
	<path id="play" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> 
										 		<path id="play-left" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> 
										 		<path id="play-right" d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> 
										 		<path opacity="0" id="pause" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> 
										 		<path opacity="0" id="pause-left" d="M447,1000 0,1000 0,0 447,0 447,500.084 z" fill-rule="nonzero"/> 
										 		<path opacity="0" id="pause-right" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> 
										 		<path style="display:none;" id="play-path" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> 
										 		<path style="display:none;" id="play-path-left" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> 
										 		<path style="display:none;" id="play-path-right" d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> 
										 	

 										 -->

										 <div class="play-toggle inline-small"> 
										 	<svg id="playertoggle" class=""  width="100%" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"> 
										 		<path d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> 
										 		<path d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> 
										 		<path d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> 
										 		<path opacity="0" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> 
										 		<path opacity="0" d="M447,1000 0,1000 0,0 447,0 447,500.084 z" fill-rule="nonzero"/> 
										 		<path opacity="0" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> 
										 		<path style="display:none;" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> 
										 		<path style="display:none;" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> 
										 		<path style="display:none;" d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> 
										 	</svg> 
										 </div> 

 								    </div>
									 	
									</a><!-- .radio-item outer-grid-item outer-grid-item-sm-8-->
								
									<a class="view-radio-item view-radio-item-<?php echo $thisnumber;?>" href="<?php echo the_permalink();?>" title="view <?php echo $showtitle; ?>" id="view-radio-item-<?php echo $showid?>">
										
										<div class="details-wrap">
	 											
											<div class="radio-date">
												<?php $showstart = get_field('show_start_date'); echo date_i18n('dS F Y', $showstart);  ?>
											 </div><!-- .date -->
											
											<div class="radio-view-item">
												View Item
											</div><!--view-item-->
											

											<?php if($showtitle): ?>

												<div class="radio-name">	
												<?php echo $showtitle; ?>
							 					</div><!-- .event-name -->
										
											<?php endif; //$name ?>	

										</div><!--.outer-grid-item inner -->

									</a>
									
								</div><!-- wrapping -->

				 			</li>

							<!-- end new -->
	 						<!-- I need to write a script that triggers a click  accordingly, but will that work if the script is only loaded once?
	 						 i.e the DOM changes here - but does the array of availabel links? 


	 						id="radio-item-<?php// echo $showid?>
	 					-->
	
						<?php // End the loop. 
               		 	$radio_found = true; 
						$thisnumber ++;
						endwhile; ?>
					
					</div> <!-- event-items -->									

				<?php endif; // endif have post ?>
			
		<?php
		// clean up after the query and pagination
		wp_reset_postdata(); ?>			


	</section><!--   outer-grid-item inner -->

		<!-- not sure this #radio-code is beiung used ?--> 
		<div id="radio-code" data-url="<?php echo $soundcloudlink;?>">
 
 		</div>
	
<?php endif; //is_single() ?>


<?php if ( is_archive() ) : //is archive content 

	$showid = get_the_ID();	
	$showtitle = get_the_title();// title						
 	$showstart = get_field('show_start_date'); // date and time picker
    $showend = get_field('show_end_date');  // date and time picker
	$featureimage =  get_field('feature_image'); // image
	$featureimagecredit =  get_field('feature_image_credit');  // text
 	$description =  get_field('show_description');  // text area							 
 	$soundcloudlink =  get_field('soundcloud_link'); //text
	$soundcloudembed =  get_field('soundcloud_embed'); // iframe / file?
	?>
 	
		<?php if($featureimage): ?>

			<div class="cover-image-item outer-grid-item outer-grid-item-sm-8" style="background-image: url('<?php echo $featureimage;?>');">

				<div class="play-icon-wrap">
			
					 <div class="play-toggle inline-small"> 
					
					 	<svg id="playertoggle" class=""  width="100%" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"> 
					 		<path d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> 
					 		<path d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> 
					 		<path d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> 
					 		<path opacity="0" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> 
					 		<path opacity="0" d="M447,1000 0,1000 0,0 447,0 447,500.084 z" fill-rule="nonzero"/> 
					 		<path opacity="0" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> 
					 		<path style="display:none;" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> 
					 		<path style="display:none;" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> 
					 		<path style="display:none;" d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> 
					 	</svg> 
					
					 </div> 

			    </div>
				
			</div><!-- image-item -->

		<?php endif; //$featureimage  ?>

<?php endif; ?>
