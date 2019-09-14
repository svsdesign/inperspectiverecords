<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

	    <article class="grid">

			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'releases' );
 		
 			endwhile; ?>

	 		<?php endif;?>

	    </article>

	<?php wp_reset_query(); //reset  ?>			
 

<?php get_footer(); ?>