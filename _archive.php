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

	<article class="container grid">


		<?php if ( have_posts() ) :

			while ( have_posts() ) : the_post();?>

		Don't think this template is being used - or maybe something is broken?

		Its probably worth just setting up another custom post type "news" - then hiding normal post in the control panel

		I think we should probably also 

		 	<?php get_template_part( 'content' );

			endwhile;
		endif;?>

 	</article>  <!-- container -->

<?php get_footer(); ?>
