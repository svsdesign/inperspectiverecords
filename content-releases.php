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
<?php if ( is_home() ) :  
	//is_home - content-relases.php
	// home artist item - but there could be two types - the top featured - or the other itemes
	// so check against the variable that I pass trough:
	//echo $homefeatured;
	$releaseid = $thispostid;// get_the_ID();get_the_ID();	
	$phptemplate = get_field('release_php_template', $releaseid);
	$phptemplatestring = 'releases/'.$phptemplate.'.php';
	$releasetitle = get_field('release_title', $releaseid); // 
	$releaseartists = get_field('releases_artists', $releaseid); // relationship = bi-directional - IDS
	$size = 'large';
	$releaseproductcover = get_field('release_product_image_front', $releaseid); // relationship = bi-directional - IDS
	$frontthumb = $releaseproductcover['sizes'][ $size ]; 
	$releaselabel = get_field('release_vinyl_label_image', $releaseid); // relationship = bi-directional - IDS
	?>

	<?php if ($homefeatured == true): 
	//is homefeatured - content-relases.php
	?>
 			
		<?php if ($phptemplate):// has template?>

			<!-- removed - review + delete	<li> -->
				
				<a href="<?php echo get_permalink($releaseid); ?>">
 
 				<?php include ('releases/'.$phptemplate.'.php');?>

				</a>

			<!-- removed - review + delete	 </li> -->

		<?php else: //does not have template: ?>

			<!-- removed - review + delete	<li> -->

				<a href="<?php echo get_permalink($releaseid); ?>">

					<div class="record-circle-container">
					   
					 	 <div class="sleave-square">
					      	
					      	<?php if ($releaseproductcover):?>
					    		
					    		<img class="record-sleave" src="<?php echo $frontthumb;?>"/>

							<?php endif; // if $releaseproductcover?>

					    </div>  
					    
					    <div class="release-details">

						    <div class="inner-container">  

						        <div class="release-code">
						     	<?php echo get_the_title($releaseid); ?>
						        </div>

						        <?php if ($releasetitle):?>

							        <div class="release-title">
							     	<?php echo $releasetitle; ?>
							        </div>
							     
						        <?php endif; // if $releasetitle?>

						        <?php if ($releaseartists):?>
									 
									 <div class="release-artists">

										<?php foreach($releaseartists as $releaseartist):?>
										   	       
											 <div class="release-artist">

												<?php echo get_the_title( $releaseartist->ID ); ?>
 
									        </div>

								      	<?php endforeach; // if releaseartists?>
									      
								     </div>

						        <?php endif; // if releaseartists?>
	      
						     </div><!-- .inner-container -->

					    </div><!-- .release-details -->
					 
					    <div class="record-circle rotated">
					    
					      	<div class="inner-container"> 
					      
								<?php if ($releaselabel):?>
						    		
						    		<img class="record-label" src="<?php echo $releaselabel;?>"/>

								<?php else: // if not image use placholder - make the placeholder?>
						    		
						       		<img class="record-label" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_a_600.png"/>

						        <?php endif; // if $releaseproductcover?>
						      
						      	<img class="record-item" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
						        
						    </div><!-- .inner-container-->							
					      
					    </div><!-- .record-circle-->

					</div> <!-- .record-circle-container-->								 

				</a>

			<!-- removed - review + delete	 </li> -->

		<?php endif;//if ($phptemplate):// has template?>

	<?php else: // not home feaured:?>

		<?php if ($phptemplate):// has template?>

<!-- removed - review + delete	<li> -->
	
	<a href="<?php echo get_permalink($releaseid); ?>">

	 <?php include ('releases/'.$phptemplate.'.php');?>

	</a>

<!-- removed - review + delete	 </li> -->

<?php else: //does not have template: ?>

<!-- removed - review + delete	<li> -->

	<a href="<?php echo get_permalink($releaseid); ?>">

		<div class="record-circle-container">
		   
			  <div class="sleave-square">
				  
				  <?php if ($releaseproductcover):?>
					
					<img class="record-sleave" src="<?php echo $frontthumb;?>"/>

				<?php endif; // if $releaseproductcover?>

			</div>  
			
			<div class="release-details">

				<div class="inner-container">  

					<div class="release-code">
					 <?php echo get_the_title($releaseid); ?>
					</div>

					<?php if ($releasetitle):?>

						<div class="release-title">
						 <?php echo $releasetitle; ?>
						</div>
					 
					<?php endif; // if $releasetitle?>

					<?php if ($releaseartists):?>
						 
						 <div class="release-artists">

							<?php foreach($releaseartists as $releaseartist):?>
										  
								 <div class="release-artist">

									<?php echo get_the_title( $releaseartist->ID ); ?>

								</div>

							  <?php endforeach; // if releaseartists?>
							  
						 </div>

					<?php endif; // if releaseartists?>

				 </div><!-- .inner-container -->

			</div><!-- .release-details -->
		 
			<div class="record-circle rotated">
			
				  <div class="inner-container"> 
			  
					<?php if ($releaselabel):?>
						
						<img class="record-label" src="<?php echo $releaselabel;?>"/>

					<?php else: // if not image use placholder - make the placeholder?>
						
						   <img class="record-label" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_a_600.png"/>

					<?php endif; // if $releaseproductcover?>
				  
					  <img class="record-item" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
					
				</div><!-- .inner-container-->							
			  
			</div><!-- .record-circle-->

		</div> <!-- .record-circle-container-->								 

	</a>

<!-- removed - review + delete	 </li> -->

<?php endif;//if ($phptemplate):// has template?>


	<?php endif; //if $homefeatured ?>



<?php endif; //is_home() ?>


 <?php if ( is_single() ) : //is single content  
	
	//start get fields
	$releaseid = get_the_ID();
 	$releasecode = get_field('release_code'); // INPO00
 	$releaseformat = get_field('release_format'); // format
 	$releasetitle = get_field('release_title'); // 
	$releasedescription = get_field('release_description'); // 

	$releaseartists = get_field('releases_artists'); // relationship = bi-directional - IDS
	$releasebanner = get_field('release_cover_image'); // image
	$releaselinks = get_field('release_buy_links'); // repeater
	$size = 'large';

	$buydescription = get_field('buy_release_description'); // text
	$bcembedid = get_field('bc_id'); // text (id)

	//release_product_image_front
//release_product_image_back

	/* but I need to create a whole range of tocnte:

- index items
- php blocks
- general images

*/

	?>

<section id="artist-details" class="grid">	
		
	<?php if($releasecode): ?>

		 <div class="page-title-positioner left-side outer-grid-item outer-grid-item-sm-8 sticky">
								  
			<div class="page-titler">
						    
				 <span class="inner">
				
				<?php echo $releasecode?>

				</span><!-- inner -->
				 
		    </div> <!--.page-title -->
				    
		</div><!-- .page-title-position -->

	<?php endif; //$releasecode?>


	<?php if($releasetitle): ?>

		 <div class="page-title-positioner outer-grid-item outer-grid-item-sm-8 sticky">
								  
			<div class="page-titler">
						    
				 <span class="inner">
					
					<?php echo $releasetitle?>
				
				</span><!-- inner -->

		    </div> <!--.page-title -->
				    
		</div><!-- .page-title-position -->

	<?php endif; //$releasetitle?>

	<?php if($releasebanner): ?>
		
		<div class="outer-grid-item inner outer-grid-item-sm-8">

		    <div class="cover-image"style="background-image: url('<?php echo $releasebanner;?>');">
		    </div><!-- banner-image -->

		</div><!-- outer-grid-item -->
	
	<?php endif; //$releasebanner:?>

	<?php if ($releaseformat):?>

    	<div class="release-format">
    	Format:

	        <div class="format">
			<?php echo $releaseformat;?>
			</div>

		</div>

	<?php endif; // if $releaseformat) ?>

	<?php if($releaselinks): ?>
		
		<div id="release-links" class="outer-grid-item inner outer-grid-item-sm-6">
	
  			<div class="grid">

	  			<div class="buy center-item grid-item grid-item-sm-6 grid-item-md-4">

					<?php if($buydescription): ?>
						
					<div class="buy-description">

						<?php echo $buydescription?>

					</div>
						<span class="fade-border"></span>

					<?php endif; ?>


		  			<ul class="links">

						<?php while( have_rows('release_buy_links')): the_row(); 
							$text = get_sub_field('link_name');
							$link = get_sub_field('link_url');
							?>
			 				<li class="link-item">

								<?php if( $link ): ?>
									<a href="<?php echo $link; ?>">
								<?php endif; ?>
									<span>

										<?php echo $text ?>

									</span>

								<?php if( $link ): ?>
									</a>
								<?php endif; ?>

							</li>

						<?php endwhile; ?>

					</ul><!-- links -->
				
				</div><!-- .grid-item -->

			</div><!-- .grid -->
		 
		</div><!-- #release-links .outer-grid-item -->

	<?php endif; ?>





	<?php /*

	https://codex.wordpress.org/Embeds

[bandcamp width=100% height=274 album=4198295769 size=large bgcol=333333 linkcol=ffffff artwork=none]
wp- embedd
<iframe style="border: 0; width: 100%; height: 42px;" src="https://bandcamp.com/EmbeddedPlayer/album=1412170017/size=small/bgcol=ffffff/linkcol=0687f5/transparent=true/" seamless><a href="http://inperspectiverecords.bandcamp.com/album/inp021-who-are-you-laterality">INP021 - Who Are You / Laterality by Andy Skopes</a></iframe>
<iframe style="border: 0; width: 100%; height: 274px;" src="https://bandcamp.com/EmbeddedPlayer/album=4198295769/size=large/bgcol=333333/linkcol=ffffff/artwork=none/transparent=true/" seamless><a href="http://inperspectiverecords.bandcamp.com/album/choose-wisely">Choose Wisely by Will Miles</a></iframe>

*/  if($bcembedid): 
	/* 1.find a way of setting the heigh of the player based on the height of the html document? -
	 2. set up iframe resizing
	*/
 	?>
	  			
		<div id="release-music" class="outer-grid-item inner outer-grid-item-sm-6">

			<div class="grid">
			
				<div class="grid-item music-item item-sm-6 item-md-4">
				
					<?php //the_content();?>
					<?php //echo do_shortcode( '[bandcamp width="100%" height="274" album="4198295769" size="large" bgcol="333333" linkcol="ffffff" artwork="none"]' );?>
	 
					<iframe style="border: 0; width: 100%; height: 200px;" src="https://bandcamp.com/EmbeddedPlayer/album=<?php echo $bcembedid?>/size=large/bgcol=333333/linkcol=ffffff/artwork=none/transparent=true/" seamless></iframe>
				
					<div class="gradient-loader-wrapper">
						
						<div class="gradient-loader"></div>

					</div><!-- .gradient-loader-wrapper -->
				
				</div><!--.grid-item -->

			</div><!--.grid -->

		</div><!-- #release-music .outer-grid-item -->

	<?php endif; // if embed ?>
 	

	


	<?php if($releasedescription): ?>
	
		<div id="release-description" class="outer-grid-item inner outer-grid-item-sm-6">

			<div class="grid">

			  	<div class="description grid-item grid-item-sm-6 grid-item-md-4">

					<?php echo $releasedescription;?>
				
				</div><!-- outer-grid-item -->
			
			</div><!-- grid -->

		</div><!-- #release-description .outer-grid-item -->

	<?php endif; //$releasedescription ?>


</section> <!-- #artist-details -->


	<?php if( $releaseartists ): ?>
	 
		<section id="release-artists" class="outer-grid-item inner outer-grid-item-sm-8">
				
				<ul class="">
			
					<?php foreach( $releaseartists as $releaseartist ): 
						$artistid = $releaseartist->ID;
						$artistbanner = get_field('artist_banner_image', $artistid);
						//$artistid;?>

						<li class="">

							<a href="<?php echo get_permalink( $releaseartist->ID ); ?>">
	 
							    <div class="banner-image" style="background-image: url('<?php echo $artistbanner;?>');">
																   																	   		
							 		<div class="page-title-positioner outer-grid-item outer-grid-item-sm-8 sticky">
															  
										<div class="page-titler">
													    
											 <span class="inner artist-title">
											<?php echo get_the_title( $releaseartist->ID ); ?>
											</span><!-- .artist-title -->

									    </div> <!--.page-title -->
											    
									</div><!-- .page-title-position --> 
 
							    </div><!-- banner-image -->

							</a>

						</li>

					<?php endforeach; ?>
					
				</ul>

		</section> <!-- #release-aartist -->

	<?php endif; ?>


<?php endif; // endif is_single() ?>

<?php if ( is_archive() ) : //is archive content 

	$releaseid = get_the_ID();
 	$releasetitle = get_field('release_title'); // 
	$releaseimagefront = get_field('release_product_image_front'); 
	$releaseimageback = get_field('release_product_image_back'); 
	// $size = 'thumbnail';
 	$releaseartists = get_field('releases_artists'); // relationship = bi-directional - IDS
	$size = 'large';
	$frontthumb = $releaseimagefront['sizes'][ $size ]; 
	$backthumb = $$releaseimageback['sizes'][ $size ]; 

	?>

	<div id="release-<?php echo $releaseid?>" class="carousel__cell <?php if($firstdisc==0) { $firstdisc=1; echo 'active'; };?>">

			<a href="<?php echo the_permalink();?>" class="">
 
				<?php if ($releaseimagefront):?>
				<!--<img class="front" src="<?php //echo $releaseimagefront;?>"/> -->
				<img class="front" src="<?php echo $frontthumb;?>"/>

				<?php else:?>
				<img class="front" src="<?php echo bloginfo('template_directory'); ?>/dist/img/release_placeholder_square.png"/>

				<?php endif; // endif is_single() ?>

			</a><!-- list-item --> 		 	
			

			<?php if ($releaseimageback):?>

				<style>
					#release-<?php echo $releaseid?>.carousel__cell:after {content:''; background-image: url('<?php echo $frontthumb;?>');}
				</style>
			
			<?php else:?>
				 
				<style>
					#release-<?php echo $releaseid?>.carousel__cell:after {content:''; background-image: url('<?php echo bloginfo('template_directory'); ?>/dist/img/release_placeholder_square.png');}
				</style>
			
			<?php endif; // endif is_single() ?>


	</div>
 	
 <?php endif; // endif is_archive() ?>