<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   
 */

get_header();?>

<div class="ajax-container" data-barba="container" data-barba-namespace="single-post">

	<?php if ( have_posts() ) :?>
   
    <article class="grid">
    
    	<?php while ( have_posts() ) : the_post();?>

		 	<?php get_template_part( 'content' , 'news' );?>
 
 	  	<?php endwhile;?>

	</article>

<?php endif;?>

<?php wp_reset_query(); //reset?>	

</div><!-- class="ajax-container" data-barba="container" data-barba-namespace -->

<?php get_footer();?>