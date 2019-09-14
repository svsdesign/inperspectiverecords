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

  
	<article class="container grid">
				 
<!--
			<div class="carousel-options" style="display:none;">
			  <p>
			    <label>
			      Cells
			      <input class="cells-range" type="range" min="3" max="15" value="8" />
			    </label>
			  </p>
			  <p>
			    <button class="previous-button">Previous</button>
			    <button class="next-button">Next</button>
			  </p>
			  <p>
			    Orientation:
			    <label>
			      <input type="radio" name="orientation" value="horizontal" checked />
			      horizontal
			    </label>
			    <label>
			      <input type="radio" name="orientation" value="vertical" />
			      vertical
			    </label>
			  </p>
			</div>
-->
							
		<?php
		// set the "paged" parameter (use 'page' if the query is on a static front page)
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$releasesargs = array(
			'posts_per_page' => 99,
			'post_type' => 'releases',
			'paged'          => $paged
		);
		// the query
		$releases_query = new WP_Query( $releasesargs ); 
		?>

		<?php if ( $releases_query->have_posts() ) : ?>

			<div class="scene-fixer">
		
				<div class="page-title-position absolute">
					    <div class="page-title">
							Releases
						</div> <!--.page-title -->
				
				</div><!-- .page-title-position -->
 

				<div class="scene">
					
					<div class="carousel">

						<?php
						// the loop
						$firstdisc=0;

						while ( $releases_query->have_posts() ) : $releases_query->the_post();
								

							get_template_part( 'content', 'releases' );?>
	 
		 				<?php endwhile; ?>
									
					</div>

				</div>

			</div>
	
			<div class="view-module">

				<div class="view-module-wrap">

					<span class="view-title">view</span>
					
					<div class="fade-border">
					</div>			
					
					<div class="release-view">			

						<div class="release-option">

							<div class="svg-icon inline-icon">
							<?php get_template_part('/assets/svg/inline-inp_release-disc-outlined.svg'); ?>
					 		</div><!-- svg-icon inline-icon -->	
			 				
			 				<div class="svg-icon inline-icon">
							<?php get_template_part('/assets/svg/inline-inp_release-item-outlined.svg'); ?>
					 		</div><!-- svg-icon inline-icon -->	
					
						</div>

						<div class="release-pointer">

							<div class="svg-icon inline-icon">
							<?php get_template_part('/assets/svg/inline-inp_arrow-left.svg'); ?>
					 		</div><!-- svg-icon inline-icon -->	
					
						</div>
								
	 				</div>

				</div><!--.view-module-wrap -->

			</div><!--.view-module -->

			<div class="scene-height">




				<?php
					// the loop
				    $firsttitle=0;

					while ( $releases_query->have_posts() ) : $releases_query->the_post(); 
				 		//start get fields
					$releaseid = get_the_ID();
				 	$releasetitle = get_field('release_title'); // 
				 	$releasecode = get_field('release_code'); // 
					$releaseimagefront = get_field('release_product_image_front'); // Text
					$releaseimageback = get_field('release_product_image_back'); // Text
					//end get fields

					// post object relation
					$releaseartists = get_field('releases_artists'); // relationship = bi-directional - IDS
					?>			

						<?php// if($firsttitle==0) { echo 'first'; };?>

 					<div class="height-item <?php if($firsttitle==0) { $firsttitle=1; echo 'active'; };?>" id="item-<?php echo $releaseid?>" data-active-item="release-<?php echo $releaseid?>">

						<div class="code-wrap">

							<div class="release-code">
							<?php echo $releasecode?>
							</div>

						</div><!-- .code-wrap-->
	
						<a href="<?php echo the_permalink();?>" id="release-<?php echo $releaseid?>-list" class="">
								
						<!--	<div class="image-wrap">
to add as part of list view
								<img class="front" src="<?php// echo $releaseimagefront;?>"/>  
							
							</div> .description-wrap -->

							<div class="description-wrap">

								<div class="grid">

									<div class="outer-grid-item center-item outer-grid-item-xs-6 grid">

										<span class="fade-border"></span>

	
										<?php if ($releaseimagefront  || $releaseimageback) :?>
											
											<div class="image-wrap grid-item grid-item-xs-6 grid-item-sm-6 grid-item-md-4 grid-item-lg-4 list">
												 
												<div class="images">
												 
													<img class="front" src="<?php echo $releaseimagefront;?>"/>
													<img class="back" src="<?php echo $releaseimageback;?>"/>

												</div><!-- images-->


											</div>
										
										<?php endif; //$releaseimagefront?>

											
											<div class="details-wrap grid-item">

												<div class="release-code inline">
													<?php echo $releasecode?>
												</div>
										
												<div class="release-title inline"><?php echo $releasetitle?></div>

												<ul class="artists">
												
													<?php foreach( $releaseartists as $releaseartist ): 
													$artistid = $releaseartist->ID;
								 					//$artistid;?>
													<li>
 
														<?php echo get_the_title( $releaseartist->ID ); ?>

													</li>

													<?php endforeach; ?>

												</ul><!-- artists-->

											</div><!-- grid-item grid-item grid-item-md-3 grid-item-lg-3 -->

										<span class="fade-border bottom"></span>

									</div><!-- .grid-item o -->

								</div><!-- .grid -->

							</div><!-- .description-wrap -->

						</a><!-- list-item --> 		 	
							 

 

					</div>
 
	 				<?php endwhile; ?>
			</div>
			<?php

			// next_posts_link() usage with max_num_pages
			next_posts_link( 'Older Entries', $releases_query->max_num_pages );
			previous_posts_link( 'Newer Entries' );
			?>

			<?php 
			// clean up after the query and pagination
			wp_reset_postdata(); 
			?>

			<?php else:  ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php get_template_part( 'content', 'none' ); ?>
			
			<?php endif; ?>


											 
 	</article>  <!-- container -->

 

<?php get_footer(); ?>


