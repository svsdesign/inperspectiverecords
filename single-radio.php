<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   
 */

get_header();

if ( have_posts() ) :?>
   
    <article class="grid">

		<?php while ( have_posts() ) : the_post();?>

	  		<?php get_template_part( 'content', 'radio' );?>
	  
	  	<?php endwhile;?>
	
	</article>

<?php endif;

wp_reset_query(); //reset  			

get_footer();?>

