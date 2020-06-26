<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   TEMPLATE SE4006. 
 * 	"Digital template"
 */


	$releasecode = get_field('release_code', $releaseid); // 
	$releaseformat = get_field('release_format', $releaseid);
	$phptemplate = get_field('release_php_template', $releaseid);
	$phptemplatestring = 'releases/'.$phptemplate.'.php';
	$releasetitle = get_field('release_title', $releaseid); // 
	$releaseartists = get_field('releases_artists', $releaseid); // relationship = bi-directional - IDS
	$releaseproductcover = get_field('release_product_image_front', $releaseid); // 
	$releaseimage = get_field('release_vinyl_label_image', $releaseid); 
 	$releaseassetslocation = get_stylesheet_directory_uri().'/releases/assets/'.$phptemplate.'/';			
	$releaselabel = get_field('release_vinyl_label_image', $releaseid); // relationship = bi-directional - IDS	
  	?>


	<div class="record-square-container">

		<div class="flip-card">

		  <div class="flip-card-inner">
		  
		    <div class="flip-card-front">
			
				<img class="record-sleave" src="<?php echo $releaseproductcover;?>">
		    
		    </div>
		  
		    <div class="flip-card-back" style="background-image:url('<?php echo $releaseassetslocation ;?>digital-cover-back.png')">		

		    	<img class="record-sleave back" src="<?php echo $releaseassetslocation ;?>digital-icon_v2.png">

		    </div>

		  </div>

		</div><!-- flipcard -->
			 
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

	</div> <!-- .record-square-container-->	
 