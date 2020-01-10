<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *  Release - inp024
 */

//if (is_single()) : 

 //$releaseid = $artistsrelease->ID; // I reckon this might be the issues because -> ID not being passed in
$phptemplate = get_field('release_php_template', $releaseid);
$phptemplatestring = 'releases/'.$phptemplate.'.php';
$releasecode = get_field('release_code', $releaseid); // 
$releaseformat = get_field('release_format', $releaseid);
$releasetitle = get_field('release_title', $releaseid); // 
$releaseartists = get_field('releases_artists', $releaseid); // relationship = bi-directional - IDS
$releaseproductcover = get_field('release_product_image_front', $releaseid); // 
$releaseimage = get_field('release_vinyl_label_image', $releaseid); 
$releaselabel = get_field('release_vinyl_label_image', $releaseid); // relationship = bi-directional - IDS	
$releaseassetslocation = get_stylesheet_directory_uri().'/releases/assets/'.$phptemplate.'/';		
?>


	 <div class="record-circle-container">
	   
	 	 <div class="sleave-square">
	      
	      <img class="record-sleave" src="<?php echo $releaseassetslocation ;?>INP024-front_sleave.png"/>
	    
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

		    </div><!--.inner-container-->  

	    </div><!-- .release-details -->
	 
	    <div class="record-circle rotated">
	    
	      	<div class="inner-container"> 
	     
	     	     	<img class="record-label" src="<?php echo $releaseimage;?>"><!--full vinyl + label -->

	       <!-- <img class="record-label" src="<?php// echo $releaseassetslocation ;?>/web_label_seba_side_a_600.png"/>-->
	     	        
	      	</div><!-- .inner-container-->
	      
	   <!--   <div class="inner-container two"> 
	     
	        <img class="record-label two" src="<?php // echo $releaseassetslocation ;?>/web_label_seba_side_b_600.png"/>
	      
	        <img class="record-item two" src="<?php  //echo $releaseassetslocation ;?>/web_records_blank_black.png"/>
	        
	      </div> .inner-container-->
	      
	    </div><!-- .record-circle-->

	  </div> <!-- .record-circle-container-->
							  
<?php //endif; // endif is_single() ?>
