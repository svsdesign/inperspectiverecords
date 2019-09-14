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

content.php


<?php if ( is_home() ) :?>

// home news

<?php endif;// is home ?>

<?php if (is_single()) : 
	// single
	//$newsid = get_the_ID();
 	//$newsimage = get_field('news_featured_image'); // image
 	//$newsdescription = get_field('news_summary_description');// text area - 200 characters limit
 	//$newscontent = get_field('news_content'); // wysiwig
 	
the_content();

 	?>
 

<?php endif; // is single ?>

<?php if (is_archive()) : ?>



	
// archive news


<?php endif;  // is archive ?>
