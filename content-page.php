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


<?php //if ( is_page(2) ) : //is about page - id = 2   
if ( is_page( array( 2, 679, 'about') ) ): // ensure to target the correct id's or permalinks on the live site as well
$intro = get_field( 'introduction' ); // text area
$contactintro = get_field( 'contact_intro' ); // text area
// time line items:

?>

	<section id="about-page-details" class="grid">
 
		<div class="page-title-positioner outer-grid-item outer-grid-item-sm-8 sticky">
								  
			<div class="page-titler">
						    
				 <span class="inner">
    			  <?php the_title();?>
				</span><!-- inner -->

		    </div> <!--.page-title -->
				    
		</div><!-- .page-title-position -->


		<?php // check if the flexible content field has rows of data - display top line if so
		if( have_rows('timeline') ):?>

			<div id="top-line" class="outer-grid-item inner outer-grid-item-sm-8">
	 		
	 			<div class="line"></div>
 			
 			</div>

		<?php endif; //have rows timeline ?>	

		
		<div id="about-logo" class="outer-grid-item outer-grid-item-xs-6 inner">
			
			<div class="grid">

				<div class="logo-wrap grid-item grid-item-xs-4 grid-item-sm-3 grid-item-lg-2 push-item-left-md-4 push-item-left-lg-3">

	 				<img class="logo-image" src="<?php echo bloginfo('template_directory'); ?>/assets/svg/inp_logo_white.svg">
				
				</div><!-- .logo-wrap -->

  			</div><!-- .grid -->

 		</div> <!-- id="about-logo"-->
			
 		<?php if($intro) :?>

			<div id="intro-copy" class="grid">

				<div id="intro-copy-inner" class="outer-grid-item inner outer-grid-item-xs-6">

					<div class="grid">

						<div class="intro-wrap grid-item grid-item-xs-6 grid-item-sm-6 grid-item-md-3 grid-item-lg-2">	
						
							<span class="copy-pos">
							<?php echo $intro;?>
							</span>
						
						</div><!--.intro-wrap -->
				
					</div><!--.grid -->

				</div><!-- #inner-intro-copy .outer-grid-item-->
		  		
		  	</div><!-- #intro-copy -->
		  		
	  	<?php endif; //$name ?>	


		<?php

		// check if the flexible content field has rows of data
		if( have_rows('timeline') ):?>

			<div id="time-line" class="outer-grid-item inner outer-grid-item-sm-8">
 			<!-- so keep the line as absolute () position? -->

 			<div class="line">
 			</div>

		   	<?php // loop through the rows of data
		    while ( have_rows('timeline') ) :  the_row();



		        if( get_row_layout() == 'timeline-date_item' ):
		        	$timelinedate = get_sub_field('timeline_date');
		            $timelinetext = get_sub_field('timeline_title');
					$layout = get_row_layout('timeline-date_item');
					if (!isset($layout_counts[$layout])) {
					$layout_counts[$layout] = 0;
					}
					$layout_counts[$layout]++;
					$class = 'left';
					if ($layout_counts[$layout] % 2) {
					$class = 'right';
					} ?>

		        	<div class="time-line-item date-item align-<?php echo $class; ?>" id="item-id-<?php echo get_row_index(); ?>">

				 		<?php if($timelinedate) :?>
	 
			 				<div class="time-line-item-date">
							<?php echo $timelinedate;?>
				 			</div><!-- .time-line-item-date -->

				 		<?php endif; //$timelinedate ?>
		
				 		<div class="time-line-item-line">
						</div><!-- .time-line-item-line -->			

						<?php if($timelinetext) :?>
	 
				 			<div class="time-line-item-title">
							<?php echo $timelinetext;?>
				 			</div><!-- .time-line-item-title -->

				 		<?php endif; //$timelinetext ?>

				 	</div><!-- .time-line-item.date-item-->
 
 
		        <?php elseif( get_row_layout() == 'timeline-image_item'): 
				 	$timelineimage = get_sub_field('timeline_image');
				 	$maxsize = get_sub_field('image_max_size');
				 	$size = get_sub_field('image_size');
				 	$align = get_sub_field('image_allignment');
					?>
					
					<div class="time-line-item image" id="item-id-<?php echo get_row_index(); ?>">


						<?php if($timelineimage)
							/*	

					<img src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/crowd_test_1200.png" class="image full">
			
  					option(s) for different image alignment? through classes?
						number of columns, alignment and margin left? - Across multiple breakpoints?
 					<img src="" class="image full-?left">
				Or use bg images - better for viewport based scaling and design.


 					 */		
						 :?>
	 
				 			<div class="time-line-image-item-wrap align-<?php echo $align ; ?>">
								<img src="<?php echo $timelineimage; ?>" class="image" style="max-width:<?php if($maxsize):?><?php echo $maxsize; ?>px<?php else:?>max-content<?php endif;?>; width:<?php echo $size; ?>%;">
				 			</div><!-- .time-line-item-title -->

				 		<?php endif;// $timelineimage ?>

					</div>
  		
		        <?php elseif( get_row_layout() == 'timeline-text_item' ): 
		            $timelinetext = get_sub_field('timeline_text');
					?>

					 <?php //if get_row_index == 0 ;?>

					<div class="time-line-item text-item" id="item-id-<?php echo get_row_index(); ?>">
		
						<?php if($timelinetext) :?>
	 
				 			<div class="time-line-item-text">
							<?php echo $timelinetext;?>
				 			</div><!-- .time-line-item-title -->

				 		<?php endif; //$timelinedate ?>


					</div>


		       <?php endif; // row layout

		    endwhile; // while have rows?>
 		

 		</div><!-- .time-line-->
 
		<?php else : // else if now rows - so what to put instead?

		    // no layouts found

		endif; // endif
		?>
 		
	</section><!--<section id="about-page-details" class="grid"-->
	


 		




	<section id="about-page-contact-details" class="grid">
		
		<div id="contact"><!-- anchor -->
		</div>

		<div class="page-title-positioner outer-grid-item outer-grid-item-sm-8 sticky">
								  
			<div class="page-titler">
						    
				 <span class="inner">
    			  Contact
				</span><!-- inner -->

		    </div> <!--.page-title -->
				    
		</div><!-- .page-title-position -->


		<?php if($contactintro) :?>

			<div id="contact-intro-copy" class="grid">

				<div id="contact-intro-copy-inner" class="outer-grid-item inner outer-grid-item-xs-6">

					<div class="grid">

						<div class="intro-wrap grid-item grid-item-xs-6 grid-item-sm-6 grid-item-md-3 grid-item-lg-2 push-item-right-md-3">	
						
							<span class="copy-pos">
							<?php echo $contactintro;?>
							</span>
						
						</div><!--.intro-wrap -->

						<?php if( have_rows('contact_details') ):?>

							<!--<div id="contact-items" class="outer-grid-item inner outer-grid-item-xs-6 outer-grid-item-md-3">-->

					   			<?php // loop through the rows of data
							    while ( have_rows('contact_details') ) :  the_row();
							 	$title = get_sub_field('contact_title');
							   	$email = get_sub_field('contact_email'); 
							   	?>

								   	<div class="contact-item grid-item grid-item-xs-6 grid-item-sm-6 grid-item-md-3 grid-item-lg-2">

								   		<div class="contact-title">
										<?php echo $title;?>:
								  	 	</div>	

								   		<div class="contact-email">
								   		
								   			<a href="mailto:<?php echo $email;?>?subject=Inperspective Records <?php echo $title;?>">
											<?php echo $email;?>
											</a>
								  	 	
								  	 	</div>	

								   	</div><!--.contact-item -->	

								<?php endwhile; // while have rows?>

							<!-- </div>id="contact-items"-->

						<?php endif; //have rows contact_details ?>	

					</div><!--.grid -->

				</div><!-- #inner-intro-copy .outer-grid-item-->

			</div><!--id="contact-intro-copy" class="grid"> -->

		<?php endif; //$contactintro ?>	

		


	  		
	</section><!-- #about-page-contact-details -->
		  		

<?php else: // other pages: ?>
<!-- not about page -->

<div class="container">
  
  <div class="page-title-position">
    <div class="page-title">
      <?php the_title();?>
    </div> <!--.page-title -->
  </div><!-- .page-title-position -->
 
</div>
<?php endif; ?>
