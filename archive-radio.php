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
			        ),
			        array(
			        'key'	  	=> 'is_item_public', // only allow items that are "public" - by default value either not set or 0 (if set)
			        //'value'	  	=> 'true',
			        //'compare' 	=> 'NOT EXISTS'
			        'value' => '1',
    				'compare' => '==' // not really needed, this is the default
			    	)

			    )
 
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
			 			
			 			<div class="container top-container radio-items grid">		
			
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

			 			<div class="container radio-items grid">		

				<?php endif;  //  are we on page 1 ?>

 
					<?php
					// the loop
					$itemno = 1;
					while ( $radio_query->have_posts() ) : $radio_query->the_post(); 

							$showid = get_the_ID();	
							$showtitle = get_the_title();// title						
						 	$showstart = get_field('show_start_date'); // date and time picker
						    $showend = get_field('show_end_date');  // date and time picker
							$featureimage =  get_field('feature_image'); // image
							$featureimagecredit =  get_field('feature_image_credit');  // text
						 	$description =  get_field('show_description');  // text area							 
						 	$soundcloudlink =  get_field('soundcloud_link'); //text
							$soundcloudembed =  get_field('soundcloud_embed'); // iframe / file?
							$public =  get_field('is_item_public'); // iframe / file?
							
//var_dump($public);

					 // initial counter if we have post
					if(1 == $paged): // page one: 

						if ($itemno == 1): // of first item of archive :?>

							
							<?php if($featureimage): ?>

								<div class="cover-image-item outer-grid-item outer-grid-item-sm-8" style="background-image: url('<?php echo $featureimage;?>');">
								</div><!-- image-item -->

							<?php endif; //$featureimage  ?>

						 	<li data-tracklink="<?php echo $soundcloudlink;?>" class="radio-item-li radio-item-li-<?php echo $itemno;?> outer-grid-item inner outer-grid-item-xs-6 <?php if ($itemno != "1"):?>grid-item-md-4<?php endif;?>">

								<div class="wrapping grid">	
								
									<a class="radio-item radio-item-<?php echo $itemno;?> grid-item grid-item-xs-1" title="play <?php echo $showtitle; ?>" id="radio-item-<?php echo $showid?>">

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
														 	
									</a><!-- .radio-item outer-grid-item outer-grid-item-sm-8-->
								
									<a class="view-radio-item view-radio-item-<?php echo $itemno;?> grid-item grid-item-sm-5" href="<?php echo the_permalink();?>" title="view <?php echo $showtitle; ?>" id="view-radio-item-<?php echo $showid?>">
										
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

			 			<?php else:// other itmems
			 			//else if ($itemno == 1){ // NOt the first item
			 			?>

			 				<li data-tracklink="<?php echo $soundcloudlink;?>" class="test radio-item-li  <?php if ($itemno != "1"):?><?php if ($itemno > "7"):?> outer-grid-item outer-grid-item-xs-6 <?php else:?> grid-item grid-item-xs-6 grid-item-md-3 <?php endif;?> <?php else:?> grid-item grid-item-xs-6 <?php endif;?>">

								<div class="wrapping <?php if ($itemno > "7")://if items on rows?>grid<?php endif;?>">	
								
									<a class="radio-item radio-item-<?php echo $itemno;?> <?php if ($itemno > "7")://if items on rows?>grid-item grid-item-xs-1<?php endif;?>" title="play <?php echo $showtitle; ?>" id="radio-item-<?php echo $showid?>">

					 					<?php get_template_part( 'content-radio' );?>
									 	
									</a><!-- .radio-item outer-grid-item outer-grid-item-sm-8-->
								
									<a class="view-radio-item view-radio-item-<?php echo $itemno;?> <?php if ($itemno > "7")://if items on rows?>grid-item grid-item-xs-5<?php endif;?>" href="<?php echo the_permalink();?>" title="view <?php echo $showtitle; ?>" id="view-radio-item-<?php echo $showid?>">
										
										<div class="details-wrap"><!-- classes - delete? outer-grid-item inner outer-grid-item-sm-6"-->
	 											
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

										</div><!--.details-wrap -->

									</a>
									
								</div><!-- wrapping -->

				 			</li>

						<?php endif;// of item = 1

						if($itemno == 1): ?>
						</div>  <!-- top container--> 
				 		<div class="container radio-items outer-grid-item outer-grid-item-sm-6 inner grid">  
					 	<?php endif; //item no == 2  

						if($itemno == 7): ?>
						</div>  <!-- container--> 
				 		<div class="container radio-items bottom-container outer-grid-item outer-grid-item-sm-6 inner">  
				 
				 			<div class="bottom-title">
				 				Other Shows
					 		</div>

					 	<?php endif; //item no == 7  

					else: // not page 1 :
					 
						$showid = get_the_ID();	
						$showtitle = get_the_title();// title						
		 				$soundcloudlink = get_field('soundcloud_link');

						?>

						<?php // are we on page one?
						//if($itemno == 2):?>
					<!--	<div class="container outer-grid-item outer-grid-item-sm-6 inner"> -->
					 	<?php //endif; // endif paged ?>
					 	<li data-tracklink="<?php echo $soundcloudlink;?>" class="radio-item-li grid-item grid-item-sm-8 <?php if ($itemno != "1"):?>grid-item-md-4<?php endif;?>">

							<div class="wrapping">	
							
								<a class="radio-item radio-item-<?php echo $itemno;?>" title="play <?php echo $showtitle; ?>" id="radio-item-<?php echo $showid?>">

				 					<?php get_template_part( 'content-radio' );?>
								 	
								</a><!-- .radio-item outer-grid-item outer-grid-item-sm-8-->
							
								<a class="view-radio-item view-radio-item-<?php echo $itemno;?>" href="<?php echo the_permalink();?>" title="view <?php echo $showtitle; ?>" id="view-radio-item-<?php echo $showid?>">
									
									<div class="details-wrap"><!-- classes - delete? outer-grid-item inner outer-grid-item-sm-6"-->
 											
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

									</div><!--.details-wrap -->

								</a>
								
							</div><!-- wrapping -->

			 			</li>
 								
					<?php endif;  //  are we on page 1
		


					$itemno++;

					endwhile;// End the loop. ?>
				
		 			</div><!-- .container added this assuming we have atleast 2 items and .container div exists -->

							
					<?php global $radio_query;

					   $big = 999999999; // need an unlikely integer

					   $paginate = paginate_links( array(
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
				    		));
					
						if ($paginate):?>
					
						<div class="page-nav outer-grid-item-xs-6 inner">

							<div class="grid page-nav-wrapper">

							<?php echo $paginate;?>

							</div>
						
						</div>	<!-- ".page-nav-->		 

						<?php endif;  // if we have paginated links ?>


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