<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *  Release - inp025
 */



$phptemplate = get_field('release_php_template', $releaseid);
$releaseassetslocation =  get_stylesheet_directory_uri().'/releases/assets/'.$phptemplate;	
?>
 

	 <div class="record-circle-container">
	   
	 	 <div class="sleave-square">
	      
	      <img class="record-sleave" src="<?php echo $releaseassetslocation ;?>/seba_cover_600px.jpg"/>
	    
	    </div>  
	    
	    <div class="release-details">

	      <div class="inner-container">  

	        <div class="release-code">
	     	<?php echo get_the_title( $artistsrelease->ID ); ?>

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
	     
	        <img class="record-label" src="<?php echo $releaseassetslocation ;?>/web_label_seba_side_a_600.png"/>
	      
	        <img class="record-item" src="<?php echo $releaseassetslocation ;?>/web_records_blank_black.png"/>
	        
	      </div><!-- .inner-container-->
	      
	      <div class="inner-container two"> 
	     
	        <img class="record-label two" src="<?php echo $releaseassetslocation ;?>/web_label_seba_side_b_600.png"/>
	      
	        <img class="record-item two" src="<?php echo $releaseassetslocation ;?>/web_records_blank_black.png"/>
	        
	      </div><!-- .inner-container-->
	      
	    </div><!-- .record-circle-->

	  </div> <!-- .record-circle-container-->
							  
