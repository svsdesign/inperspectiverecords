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

	<div class="ajax-container" data-barba="container" data-barba-namespace="single">

		<?php if ( have_posts() ) :?>
		
			<article class="grid">
			
				<?php while ( have_posts() ) : the_post();?>

					<?php the_title();?>

					<?php get_template_part('content'); ?>

				<?php endwhile;?>

			</article>

		<?php endif;?>

	</div><!-- class="ajax-container" data-barba="container" data-barba-namespace -->

<?php get_footer(); ?>