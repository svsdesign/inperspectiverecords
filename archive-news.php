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

 	<?php if ( have_posts() ) : ?>
 
	
			<div class="grid inner outer-grid-item outer-grid-item-xs-6">

			<?php while ( have_posts() ) : the_post(); 			

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

				<div class="grid post-navigation-wrap">	
				
				<?php
				/** Stop execution if there's only 1 page */
			    if( $wp_query->max_num_pages <= 1 )
			        return;

				// 	c&p from get_template_part('/assets/svg/inline-inp_arrow-right.svg') - so review if changed.
				$arrowright = '<div class="svg-icon inline-icon"><svg class="svg-icon arrow-right-icon" width="27px" height="40px" viewBox="0 0 27 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon points="0.573,40 0,39.264 24.766,20 0,0.738 0.573,0 26.288,20"/></svg></div>';    
			    // 	c&p from get_template_part('/assets/svg/inline-inp_arrow-right.svg') - so review if changed.
			    $arrowleft 	= '<div class="svg-icon inline-icon"><svg class="svg-icon arrow-left-icon" width="27px" height="40px" viewBox="0 0 27 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon points="25.715,0 26.288,0.736 1.522,20 26.288,39.262 25.715,40 0,20 "/></svg></div>';
			    $paged 		= get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
			    $max   		= intval( $wp_query->max_num_pages );
			 
			    /** Add current page to the array */
			    if ( $paged >= 1 )
			        $links[] = $paged;
			 
			    /** Add the pages around the current page to the array */
			    if ( $paged >= 3 ) {
			        $links[] = $paged - 1;
			        $links[] = $paged - 2;
			    }
			 
			    if ( ( $paged + 2 ) <= $max ) {
			        $links[] = $paged + 2;
			        $links[] = $paged + 1;
			    }
			 
			    echo '<div class="post-navigation">' . "\n";
			 
			    /** Previous Post Link */
			    if ( get_previous_posts_link() )
			      
			     printf( '<div class="previous">%s </div>' . "\n", get_previous_posts_link(''.$arrowleft.'<span>Newer News</span>'));
			    
			     echo '<ul class="paginate-number">'; // this problematic - is in in if statement?

			    /** Link to first page, plus ellipses if necessary */
			    if ( ! in_array( 1, $links ) ) {
			        $class = 1 == $paged ? ' class="active"' : '';
			 
			        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
			 
			        if ( ! in_array( 2, $links ) )
			            echo '<li>…</li>';
			    }
			 
			    /** Link to current page, plus 2 pages in either direction if necessary */
			    sort( $links );
			    foreach ( (array) $links as $link ) {
			        $class = $paged == $link ? ' class="active"' : '';
			        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
			    }
			 
			    /** Link to last page, plus ellipses if necessary */
			    if ( ! in_array( $max, $links ) ) {
			        if ( ! in_array( $max - 1, $links ) )
			            echo '<li>…</li>' . "\n";
			 
			        $class = $paged == $max ? ' class="active"' : '';
			        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
			    }
			 
			     echo '</ul>';

			    /** Next Post Link */
			    if ( get_next_posts_link() )
			  			
		 		printf( '<div class="next">%s </div>' . "\n", get_next_posts_link(''.$arrowright.'<span>Older News</span>'));
			    echo '</div>' . "\n"; ?>

				</div><!-- .grid-->	

		<?php else:  ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>	

		</div>  <!-- container (for articles)-->


	</div>  <!-- container -->

<?php get_footer(); ?>