<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   TEMPLATE FOR PICTURE DISCS
 */
?>
 
 <?php // if ( is_single() ) : //is single content 

 	// $releaseid = $artistsrelease->ID;
	$phptemplate = get_field('release_php_template', $releaseid);
	$releasecode = get_field('release_code', $releaseid); // 
	$releaseformat = get_field('release_format', $releaseid);
	$phptemplatestring = 'releases/'.$phptemplate.'.php';
	$releasetitle = get_field('release_title', $releaseid); // 
	$releaseartists = get_field('releases_artists', $releaseid); // relationship = bi-directional - IDS
	$releaseproductcover = get_field('release_product_image_front', $releaseid); // 
	$releaseimage = get_field('release_vinyl_label_image', $releaseid); 
	$releaseassetslocation =  get_stylesheet_directory_uri().'/releases/assets/'.$phptemplate;	
	$releaselabel = get_field('release_vinyl_label_image', $releaseid); // relationship = bi-directional - IDS	
  	?>


 	<div class="record-circle-container">
								   
	 	 <div class="sleave-square">
	      		       	
 	       	<img class="record-sleave" src="<?php echo $releaseassetslocation ;?>/pvc_sleave_400-v7.png"/>
 	       	<!--<img class="record-sleave" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/pvc_sleave_400.png"/> -->

	    </div>  
	    
	    <div class="release-details">

	      <div class="inner-container">  

		<div class="release-code">

				<?php echo $releasecode;?>

					  <?php if ($releaseformat):?>

			        	<div class="release-format">

						- <?php echo $releaseformat;?>

						</div>

					<?php endif; // if $releaseformat) ?>

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
	     
	     	<img class="record-label" src="<?php echo $releaseimage;?>">
	        
	      </div><!-- .inner-container-->							
	      
	    </div><!-- .record-circle-->

	</div> <!-- .record-circle-container-->								 


<?php// endif; // endif is_single() ?>

<?php //if ( is_archive() ) : //is archive content ?>


<?php //endif; // endif is_archive() ?>