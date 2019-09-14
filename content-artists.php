<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 * content-artists.php -  the template for displaying 'artists content
 */
?>

 <?php if ( is_single() ) : //is single content  
	
	//start get fields
	$artistid = get_the_ID();
	$artistimage = get_field('artist_profile_image'); // image
	$artistname = get_field('artist_name'); // Text 
	$artistdescription = get_field('artist_description'); // Text	
	//$artistlinks = get_field('artist_links'); // repeater	
 	$artistsreleases = get_field('releases_artists'); // relationship = bi-directional - IDS

	?>

	<section id="artist-details" class="grid">

		<?php if($artistname): ?>

			 <div class="page-title-positioner outer-grid-item outer-grid-item-sm-8 sticky">
									  
				<div class="page-titler">
							    
					 <span class="inner">
						<?php echo $artistname;?>
					</span><!-- inner -->

			    </div> <!--.page-title -->
					    
			</div><!-- .page-title-position -->

		<?php endif; //$artistname?>
		 
		<?php if($artistimage): ?>

			<div class="cover-image-item outer-grid-item outer-grid-item-sm-8" data-image="<?php echo $artistid;?>-image" style="background-image: url('<?php echo $artistimage;?>');">
			</div><!-- image-item -->
				
		<?php endif; //$artistimages // what if doesn't exists??>

		<div id="artist-info" class="outer-grid-item inner outer-grid-item-xs-6">

			<div class="grid">

				<div class="grid-item grid-item-sm-6 grid-item-md-4 grid-item-lg-3  push-item-right-lg-1">
							
					<header class="">					 

					 	<?php if($artistdescription): ?>

					 		<div class="item-text artist-description">
									<?php echo $artistdescription;?>
							</div><!-- item-text -->		

						<?php endif; //$artistdescription?>

					</header>	

				</div><!-- grid-item -->

				<?php if( have_rows('artist_links') ): ?>

					<div class="artist-links grid-item grid-item grid-item-xs-6 grid-item-sm-4 grid-item-md-2 grid-item-lg-2">
						

			 			<div class="more-links">More <?php echo $artistname;?></div>
						<ul class="links">

							<?php while( have_rows('artist_links') ): the_row(); 
								// vars
		  						$link = get_sub_field('link_url');
		  						$title = get_sub_field('link_name');
								?>

								<li class="link-item">

									<?php if( $link ): ?>
										
										<a href="<?php echo $link; ?>">
		 								
											<?php if( $title ): ?>

											 <?php echo $title ?>
											
											<?php else: ?>

												Visit <?php echo $link; ?>

											<?php endif; ?>

		 								</a>

									<?php endif; ?>

								</li>

							<?php endwhile; ?>

						</ul>

					</div><!-- grid-item -->
				
				<?php endif; ?>

			</div><!-- grid -->

		</div><!-- outer-grid-item -->

	<?php if( $artistsreleases ): ?>

		<div id="artist-releases">

			<div class="outer-grid-item inner outer-grid-item-sm-6 section-title">
				Releases

			</div><!--outer-grid-item -->

			<div class="outer-grid-item inner outer-grid-item-sm-6">

				<ul>
				<?php foreach( $artistsreleases as $artistsrelease ): 

					$releaseid = $artistsrelease->ID;
					$phptemplate = get_field('release_php_template', $releaseid);
					$phptemplatestring = 'releases/'.$phptemplate.'.php';
					$releasetitle = get_field('release_title', $releaseid); // 
					$releaseartists = get_field('releases_artists', $releaseid); // relationship = bi-directional - IDS
					$releaseproductcover = get_field('release_product_image_front', $releaseid); // relationship = bi-directional - IDS
					$releaselabel = get_field('release_vinyl_label_image', $releaseid); // relationship = bi-directional - IDS
					?>
					
					<?php if ($phptemplate):// has template?>

 						<li>
							
							<a href="<?php echo get_permalink( $artistsrelease->ID ); ?>">

							<?php include ('releases/'.$phptemplate.'.php');?>

							</a>

						</li>

					<?php else: //does not have template: ?>
 
 						<li>

							<a href="<?php echo get_permalink( $artistsrelease->ID ); ?>">

								<div class="record-circle-container">
								   
								 	 <div class="sleave-square">
								      	
								      	<?php if ($releaseproductcover):?>
								    		
								    		<img class="record-sleave" src="<?php echo $releaseproductcover;?>">

										<?php else: // if not image use placholder - make the placeholder?>
								    		
								    		<img class="record-sleave" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/seba_cover_600px.jpg"/>

								        <?php endif; // if $releaseproductcover?>

								    </div>  
								    
								    <div class="release-details">

								      <div class="inner-container">  

								        <div class="release-code">
								     	<?php echo get_the_title( $artistsrelease->ID ); ?>

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

														<?php echo get_the_title( $releaseartist->ID );  ?>
		 
											        </div>

										      	<?php endforeach; // if releaseartists?>
											      
										     </div>

								        <?php endif; // if releaseartists?>
			      
								      </div><!-- .inner-container -->

								    </div><!-- .release-details -->
								 
								    <div class="record-circle rotated">
								    
								      <div class="inner-container"> 
								      

    									<?php if ($releaselabel):?>
								    		
								    		<img class="record-label" src="<?php echo $releaselabel;?>">

										<?php else: // if not image use placholder - make the placeholder?>
								    		
								       		<img class="record-label" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_a_600.png"/>

								        <?php endif; // if $releaseproductcover?>
								      
								      	<img class="record-item" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
								        
								      </div><!-- .inner-container-->							
								      
								    </div><!-- .record-circle-->

								</div> <!-- .record-circle-container-->								 

							</a>

						</li>

					<?php endif;?>

				<?php endforeach; ?>

				</ul>

			</div><!--outer-grid-item -->
	
		</div><!--#artist-releases-->
	
	</section><!-- id="artist-details" class="grid" this end tag was missing; added 27may -->


 <?php
 /*
<!-- this nieed to be integrated in the above relase php blcok -->

<div id="container">

   <div class="record-circle-container">

    <div class="record-circle rotated">
       
      <div class="inner-container">  

         <img class="record-label" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_a_600.png"/>
        
         <img class="record-item" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
    
      </div><!--inner-container-->  

    </div><!-- .record-circle-->
  
  </div> <!-- .record-circle-container-->
 

  <div class="record-circle-container">
   
    <div class="sleave-square">
      
      <img class="record-sleave" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/seba_cover_600px.jpg"/>
    
    </div>
 
    <div class="record-circle rotated">
    
      <div class="inner-container"> 
     
        <img class="record-label" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_a_600.png"/>
      
        <img class="record-item" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
        
      </div><!-- .inner-container-->     

    </div><!-- .record-circle-->

  </div> <!-- .record-circle-container--> 
 
  <div class="record-circle-container">
   
    <div class="record-circle rotated">
    
      <div class="inner-container"> 
     
        <img class="record-label" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_a_600.png"/>
      
        <img class="record-item" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
        
      </div><!-- .inner-container-->
      
      <div class="inner-container two"> 
     
        <img class="record-label two" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_b_600.png"/>
      
        <img class="record-item two" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
        
      </div><!-- .inner-container-->
      
    </div><!-- .record-circle-->

  </div> <!-- .record-circle-container-->
  
  <div class="record-circle-container">
   
    <div class="sleave-square">
      
      <img class="record-sleave" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/seba_cover_600px.jpg"/>
    
    </div>
 
    <div class="record-circle rotated">
    
      <div class="inner-container"> 
     
        <img class="record-label" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_a_600.png"/>
      
        <img class="record-item" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
        
      </div><!-- .inner-container-->
      
      <div class="inner-container two"> 
     
        <img class="record-label two" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_b_600.png"/>
      
        <img class="record-item two" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
        
      </div><!-- .inner-container-->
      
    </div><!-- .record-circle-->

  </div> <!-- .record-circle-container-->
 

  <div class="record-circle-container">
   
 	 <div class="sleave-square">
      
      <img class="record-sleave" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/seba_cover_600px.jpg"/>
    
    </div>  
    
    <div class="release-details">

      <div class="inner-container">  

        <div class="release-code">
          INP026
        </div>
        <div class="release-artist">
          Seba
        </div>
        <div class="release-tracks">
          No One Dies / Island Dub
        </div>
      
      </div><!-- .inner-container -->

    </div><!-- .release-details -->
 
    <div class="record-circle rotated">
    
      <div class="inner-container"> 
     
        <img class="record-label" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_a_600.png"/>
      
        <img class="record-item" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
        
      </div><!-- .inner-container-->
      
      <div class="inner-container two"> 
     
        <img class="record-label two" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_b_600.png"/>
      
        <img class="record-item two" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
        
      </div><!-- .inner-container-->
      
    </div><!-- .record-circle-->

  </div> <!-- .record-circle-container-->
  
</div> <!-- #container-->
 
*/?>


	<?php endif; ?>


 


<?php endif; // endif is_single() ?>

<?php if ( is_archive() ) : //is archive content 

		//start get fields

		$artistid = get_the_ID();
		$artistname = get_field('artist_name'); // Text
		$artiststatus = get_field('artist_status'); // Radio Button
		$artisturl = get_field('artist_url'); // Text
		$artistprofile = get_field('artist_profile_image'); // Image
		$artistprofilecredit = get_field('artist_profile_image_credit'); // text
	
	/*	$artistquote = get_field('artist_quote'); // Text Area
		$artistbiointro = get_field('artist_biography_introduction'); // Text Area
		$artistsbiohighlighttext = get_field('artists_biography_highlight_text'); // Text Area
		$artistsbiohighlightimage = get_field('artists_biography_highlight_image'); // Image
		$artistbiocontinue = get_field('artist_biography_continuation'); // Text Area
		$artistbiocredit = get_field('artist_biography_credit'); // Text Area
		
		$audiotitle = get_field('artist_audio_title'); // text
		$mp3audio = get_field('artist_audio_mp3_upload'); // File (return as url)
		$oggaudio = get_field('artist_audio_ogg_upload'); // File (return as url)

		$artistbroomitems = get_field('boiler_room_items'); // Post object

		$artistmemoir = get_field('memoir'); // Post Object; return as ID
		$releases = get_field('associated_releases'); // Relationship
		$videos = get_field('associated_videos'); // Relationship */
		//end get fields
	?>
 

 
  <div class="image-items">

    <div class="image-item" data-image="andy-skopes-image" style="background-image: url('https://svsdesign.co.uk/wp-content/themes/inperspectiverecords/images/web-test-2018/artist-image-profane.jpg');">
    </div><!-- image-item -->
 
  </div><!-- image-items -->

  <div class="list-items">

    <div class="list-item" data-imgid="andy-skopes-image">
 
      	<?php if($artistname): ?>

     		<div class="item-text">
					<?php echo $artistname;?>

			</div><!-- item-text -->		

		<?php endif; //$artistname ?>
     
    </div><!-- list-item -->
	
 <?php endif; // endif is_archive() ?>