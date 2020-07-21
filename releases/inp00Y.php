<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *  Release - inp00X
 */

//$releaseid = $artistsrelease->ID;
$releasecode = get_field('release_code', $releaseid); // 
$releaseformat = get_field('release_format', $releaseid);
$phptemplate = get_field('release_php_template', $releaseid);
$phptemplatestring = 'releases/'.$phptemplate.'.php';
$releasecode = get_field('release_code', $releaseid); // 
$releasetitle = get_field('release_title', $releaseid); // 
$releaseartists = get_field('releases_artists', $releaseid);
$releaseproductcover = get_field('release_product_image_front', $releaseid); // 
$releaseimage = get_field('release_vinyl_label_image', $releaseid); 
$releaseassetslocation =  get_stylesheet_directory_uri().'/releases/assets/'.$phptemplate;		
$releaselabel = get_field('release_vinyl_label_image', $releaseid); 
$size = 'large';
$frontthumb = $releaseproductcover['sizes'][ $size ]; 
?>
 
	 <div class="record-circle-container">
	   
	 	 <div class="sleave-square">
	      
	      <img class="record-sleave" src="<?php echo $frontthumb;?>"/>
	    
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
	     <!-- no inner container on this release -->
	     	     	<img class="record-label" src="<?php echo $releaseimage;?>">

	       <!-- <img class="record-label" src="<?php// echo $releaseassetslocation ;?>/web_label_seba_side_a_600.png"/>
	      
	        <img class="record-item" src="<?php //echo $releaseassetslocation ;?>/web_records_blank_black.png"/> -->
	        
	      </div><!-- .inner-container-->
	      
	   <!--   <div class="inner-container two"> 
	     
	        <img class="record-label two" src="<?php // echo $releaseassetslocation ;?>/web_label_seba_side_b_600.png"/>
	      
	        <img class="record-item two" src="<?php  //echo $releaseassetslocation ;?>/web_records_blank_black.png"/>
	        
	      </div> .inner-container-->
	      
	    </div><!-- .record-circle-->

	  </div> <!-- .record-circle-container-->
							  
