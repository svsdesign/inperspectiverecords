<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *  Release - inp025
 */
/*
-

-  if multiple artists - such as an collective album? - Mabe the details 
-

Variables:

This will also require the js that I have - which might be possibly be different for each release.
- but the release code, name of release and artist associated should as a "template" remain the same. - so maybe those variabvles are pulled into this template accordingly?
- So do we

*/



?>
 

	 <div class="record-circle-container">
	   
	 	 <div class="sleave-square">
	      
	      <img class="record-sleave" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/seba_cover_600px.jpg"/>
	    
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
	     
	        <img class="record-label" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_a_600.png"/>
	      
	        <img class="record-item" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
	        
	      </div><!-- .inner-container-->
	      
	      <div class="inner-container two"> 
	     
	        <img class="record-label two" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_b_600.png"/>
	      
	        <img class="record-item two" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
	        
	      </div><!-- .inner-container-->
	      
	    </div><!-- .record-circle-->

	  </div> <!-- .record-circle-container-->
							  
