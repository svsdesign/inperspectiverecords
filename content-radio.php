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
				 Radio
				</span><!-- inner -->

		    </div> <!--.page-title -->

		</div><!-- .page-title-position -->
		
		<?php if($featureimage): ?>

			<div class="cover-image-item outer-grid-item outer-grid-item-sm-8" style="background-image: url('<?php echo $featureimage;?>');">
<!-- <iframe width="100%" height="300" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/330517159&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"></iframe>
		-->	
	
 	 <!--	   <div href="<?php// echo $soundcloudlink; ?>" data-sc-player-data="<?php //echo $soundcloudlink; ?>" class="sc-player-data"> -->
<!-- try; and remove add add this dom via js - so we know the right dom is being assigned -->
<!--
				<div class="play-toggle">

				  <svg id="playertoggle" class=""  width="100%" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
				    <path id="play" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/>
				    <path id="play-left" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/>
				    <path id="play-right" d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/>

				    <path opacity="0" id="pause" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/>
				    <path opacity="0" id="pause-left" d="M447,1000 0,1000 0,0 447,0 447,500.084 z" fill-rule="nonzero"/>
				    <path opacity="0" id="pause-right" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/>

				    <path style="display:none;" id="play-path" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/>
				    <path style="display:none;" id="play-path-left" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/>
				    <path style="display:none;" id="play-path-right" d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/>

				  </svg>

				</div>
-->
		<?php /* if($soundcloudlink): ?>

 	 	   <a href="<?php echo $soundcloudlink; ?>" class="sc-player"></a>	 

		<?php endif; //$soundcloudlink */ ?>
 

			<?php// echo $soundcloudlink;?>


		</div><!-- image-item -->

		<?php endif; //$featureimage  ?>


 <?php /*https://codepen.io/SebL/pen/pcinL
<div id="player" class="closed">
  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/154694/vinyl.png" alt=""  id="record"/>
  <div id="cover">
    <img src="http://placekitten.com/g/250/250" width="250" height="250" alt="" id="artwork" />
    <div id="trackInfos">
      <p class="now">NOW PLAYING</p>
      <p id="band"></p>
      <p id="track"></p>
      
      <a href="#" id="play" class="ion-ios7-play"></a>
    </div>
  </div>
</div>


*/?>


 

	


		<div class="details-wrap outer-grid-item inner outer-grid-item-sm-6">

			<div class="grid">

				<?php if($showtitle): ?>

					<div class="event-name grid-item grid-item-xs-6">	
					<?php echo $showtitle; ?>
 					</div><!-- .event-name -->
			
				<?php endif; //$name ?>	

				<div class="date-item grid-item grid-item-xs-6 grid-item-md-3">
							
					<span class="date">
					<?php $showstart = get_field('show_start_date'); echo date_i18n('dS F Y', $showstart);  ?>
					</span> 

				 </div><!-- .date -->

			 
					
				<div class="show-description-wrap grid-item grid-item-xs-6 grid-item-md-3">
						
					<?php if($description): ?>

						<div class="description">

							<span><?php echo $description; ?></span>   
						
						</div><!-- .description -->

					<?php endif; //$description ?>	 

				</div><!-- .show-description-wrap -->

			</div><!--.grid -->

		</div><!--.outer-grid-item inner -->

	</section><!-- show-details outer-grid-item inner -->
	




		<?php 		
		$now = current_time( 'timestamp' );
		// prepare to get a list of events sorted by the event date
	    $argsradiopage = array(
	        
		'post_type'              => 'radio', // your event post type slug
		//'post__not_in' => array($post->ID), // exclude the current post < doing this probably mean we're creating an issue with my unique IDs
		'post_status'            => 'publish', // only show published events
	 	'order'                  => 'DESC', // Show earlier events last < this order might be cause problems with muy php ID's
		'showposts' 			 => 999,
	//	'posts_per_page'         => 1, // only want to get the next event
		//'orderby' =>  'meta_value',
		//'meta_key' =>  'show_start_date',
		/*'meta_query' => array(			 		
		        'relation' => 'AND',
		        array(
		            'key'       => 'show_end_date',
		            'compare'   => '>=', // starts after or equal
		            'value'     => $now
		        ),
		        array(
		            'key'       => 'show_start_date',
		            'compare'   => '<=', // starts before or equal
		            'value'     => '9999999999'
		        )
		    ),*/
		); 

		$argsradiopage_query = new WP_Query( $argsradiopage ); 
		$radio_found = false;  			 
 	    ?>
			
		<?php if ( $argsradiopage_query->have_posts() ) :
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

							//start get fields - sort these out
						 	$showid = get_the_ID();		// this is the post id					
							$showstart = get_field('show_start_date'); // date and time picker
							$showtend = get_field('show_end_date');  // date and time picker
							$soundcloudlink = get_field('soundcloud_link');

							?>

	 						<!-- I need to write a script that triggers a click  accordingly, but will that work if the script is only loaded once?
	 						 i.e the DOM changes here - but does the array of availabel links? 


	 						id="radio-item-<?php// echo $showid?>
	 					-->
	 						<li id="<?php echo $thisnumber?>" data-tracklink="<?php echo $soundcloudlink;?>">

		 						<a href="<?php the_permalink();?>" class="radio-item" data-trackno="<?php echo $thisnumber?>" data-radio-item="<?php echo $thisnumber?>" id="<?php echo $thisnumber?>">	

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

 								    <div class="details-wrap">

									   	<div class="show-title">
		 								<?php the_title();?>
									    </div>

									    <div class="show-start">
										<?php $showstart = get_field('show_start_date'); echo date_i18n('dS F Y', $showstart);  ?>
									    </div>
								     
								    </div>

								</a><!-- class="radio-item -->	

							</li>
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
 	
	<div class="wrapping">	

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

		<div class="details-wrap outer-grid-item inner outer-grid-item-sm-6">

			<div class="">
				
				<div class="radio-date">
					<?php $showstart = get_field('show_start_date'); echo date_i18n('dS F Y', $showstart);  ?>
				 </div><!-- .date -->

				<?php if($showtitle): ?>

					<div class="radio-name">	
					<?php echo $showtitle; ?>
 					</div><!-- .event-name -->
			
				<?php endif; //$name ?>	


			</div><!--.grid -->

		</div><!--.outer-grid-item inner -->
	
	</div><!-- wrapping -->

<?php endif; ?>
