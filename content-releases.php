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



 <?php if ( is_single() ) : //is single content  
	
	//start get fields
	$releaseid = get_the_ID();
 	$releasecode = get_field('release_code'); // INPO00
 	$releasetitle = get_field('release_title'); // 
	$releasedescription = get_field('release_description'); // 

	$releaseartists = get_field('releases_artists'); // relationship = bi-directional - IDS
	$releasebanner = get_field('release_cover_image'); // image
	$releaselinks = get_field('release_buy_links'); // repeater

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
				
				</div>

			</div>

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
	$releaseimagefront = get_field('release_product_image_front'); // Text
	$releaseimageback = get_field('release_product_image_back'); // Text
 	$releaseartists = get_field('releases_artists'); // relationship = bi-directional - IDS
	?>

	<div id="release-<?php echo $releaseid?>" class="carousel__cell <?php if($firstdisc==0) { $firstdisc=1; echo 'active'; };?>">

			<a href="<?php echo the_permalink();?>" class="">

				<img class="front" src="<?php echo $releaseimagefront;?>"/>

			</a><!-- list-item --> 		 	

			<style>
				#release-<?php echo $releaseid?>.carousel__cell:after {content:''; background-image: url('<?php echo $releaseimageback;?>');}
			</style>

	</div>
 	
 <?php endif; // endif is_archive() ?>