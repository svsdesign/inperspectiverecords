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

	<div class="ajax-container" data-barba="container" data-barba-namespace="page">

		<?php if ( have_posts() ) :

			while ( have_posts() ) : the_post();?>

				<article class="container grid">

					<?php get_template_part( 'content-page' );?>

				</article><!-- container -->

			<?php endwhile;

		endif;?>

	</div><!-- class="ajax-container" data-barba="container" data-barba-namespace -->

<?php get_footer();?>
