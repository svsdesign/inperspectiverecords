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
  
	<div class="container grid">
			
		 <div class="page-title-positioner outer-grid-item outer-grid-item-sm-8 sticky">
								  
			<div class="page-titler">
						    
				 <span class="inner">
				News
				</span><!-- inner -->

		    </div> <!--.page-title -->


		</div><!-- .page-title-position -->
	
		<?php
		// set the "paged" parameter (use 'page' if the query is on a static front page)
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$newsargs = array(
			'posts_per_page' => 9,
			'post_type' => 'news',
			'paged'          => $paged
		);
		// the query
		$news_query = new WP_Query( $newsargs ); 
	  	
	  		if ( $news_query->have_posts() ) :?>


			<?php // are we on page one- so we can include the first item
			//if(1 == $paged):
			//$pageno = 'first';?>
			<?php //endif;  //  are we on page 1 ?>


	
			<div class="grid inner outer-grid-item outer-grid-item-xs-6">

			<?php
			// the loop
			$itemno = 1;
			while ( $news_query->have_posts() ) : $news_query->the_post(); 

				$newsid = get_the_ID();	
				$itemnumber++;			
				// end get fields
				// echo $newsid;
				if  ($itemnumber > 10) {// after the 10th item
				// for article items; 
				$layoutclass = 'grid-item-md-3 grid-item-lg-2';
				} else{
				//$layoutclass = $itemnumber.'-number';
	
				};

				?>
 
				<article class="news-item item-<?php echo $itemnumber;?> grid-item <?php echo $layoutclass;?> grid-item-sm-6" data-itemnumber="<?php echo $itemnumnber;?>">
			 		<?php get_template_part( 'content', 'news' );?>
		 		</article>


			<?php
			// End the loop.
			endwhile;?>


 				
		 	</div><!-- .container added this assuming we have atleast 2 items and .container div exists -->

							
			<?php global $news_query;
			//https://kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin < maybe better solution in terms of genering html

			   $big = 999999999; // need an unlikely integer

			   $paginate = paginate_links( array(
			        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			        'format' => '?paged=%#%',
			        'current' => max( 1, get_query_var('paged')),
			        'total' => $news_query->max_num_pages,
			        'prev_next' =>true,
			       // 'before_page_number' =>'<div class="test">',
			       // 'after_page_number' =>'</div>',
			//	      'format' => '/page/%#%',  
			//	      'current' => $current_page,  
			//	      'total' => $total_pages,
		 		      'type' =>  'plain',//list',//array',//list',
			//     'prev_text' => '<div class="next">' . get_template_part('svg/inline', 'dm_arrow_left.svg') .'</div>',
					'prev_text' => '<div class="small nav-previous align-left"><svg class="svg-icon previous-arrow-icon" width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g fill="#FFFFFF" fill-rule="nonzero"> <polygon transform="translate(19.874778, 20.000000) scale(-1, 1) rotate(-270.000000) translate(-19.874778, -20.000000) " points="19.8747779 29.2278846 37.6296018 6.12522213 39.8747779 7.85068148 19.8747779 33.8747779 -0.12522213 7.85068148 2.1199539 6.12522213"></polygon> </g> </g> </svg></div><div class="text">Newer Shows</div>',
					'next_text' => '<div class="small nav-next align-right"><svg class="svg-icon next-arrow-icon" width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g fill="#FFFFFF" fill-rule="nonzero"> <polygon transform="translate(19.874778, 20.000000) scale(-1, 1) rotate(-270.000000) translate(-19.874778, -20.000000) " points="19.8747779 29.2278846 37.6296018 6.12522213 39.8747779 7.85068148 19.8747779 33.8747779 -0.12522213 7.85068148 2.1199539 6.12522213"></polygon> </g> </g> </svg></div><div class="text">Older Shows</div>',
		    		));
			
				if ($paginate):?>
			
					<div class="page-nav outer-grid-item outer-grid-item-xs-6 inner">

						<div class="grid">

							<div class="page-nav-wrapper grid-item grid-item-xs-6">

							<?php echo $paginate;?>

							</div>
						
							</div>

					</div>	<!-- ".page-nav-->		 

				<?php endif;  // if we have paginated links ?>


			<?php endif;  // if ( $news_query->have_posts?>



	</div>  <!-- container -->

<?php get_footer(); ?>