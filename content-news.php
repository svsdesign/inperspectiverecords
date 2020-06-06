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

 
<?php if ( is_home()):
	

	$newsid = $thispostid;//get_the_ID();	- this coming from the , $thispostid ); 
	$date = get_the_date('jS F Y', $thispostid);
	$featureimage = get_field('feature_image', $thispostid); // image
	$categories = get_the_category($thispostid);
	$postname = get_the_title($newsid);	//text area				
 	$thepostcontent = get_post_field('post_content', $newsid);
 	$blocks = parse_blocks($thepostcontent);


	if ($homefeatured == true):?>

		<div class="container post-entry-content grid inner outer-grid-item outer-grid-item-xs-8">

		
			<div class="post-entry-details grid inner outer-grid-item outer-grid-item-xs-6">
		 
			 	<div class="grid-item grid-item-xs-8 grid-item-sm-4 grid-item-md-3">

					<div class="news-item-title">
					<?php// the_title($newsid);?>
					<?php echo $postname;?>

					</div><!--news-item-title -->

					<div class="date-wrap">

						<div class="date">
						 <?php echo $date;?>
						</div>

					</div><!--date-wrap-->

				</div><!--.grid-item-->

		 	</div><!--.post-entry-details -->
			
			<div class="post-content grid inner outer-grid-item outer-grid-item-xs-8">
	 		<?php //the_content($newsid);?>
	 		<?php //echo $thepostcontent;
	 		//https://florianbrinkmann.com/en/display-specific-gutenberg-blocks-of-a-post-outside-of-the-post-content-in-the-theme-5620/
				foreach ( $blocks as $block ) {
					//if ( 'soliloquy/soliloquywp' === $block['blockName'] ) {
						//echo do_shortcode( $block['innerHTML'] ); < this in comment format; block data.
					//	break;
					//}
						/*if ( 'soliloquy/soliloquywp' === $block['blockName'] ) {
								echo do_shortcode( $block['innerHTML'] );
								break;
							} else{

										$content_markup .= render_block( $block );

							}
							*/
						$content_markup .= render_block( $block );

				}//foreach ( $blocks as $block ) {
	 			
	 			//https://florianbrinkmann.com/en/display-specific-gutenberg-blocks-of-a-post-outside-of-the-post-content-in-the-theme-5620/
				// Remove wpautop filter so we do not get paragraphs for two line breaks in the content.

				$priority = has_filter( 'the_content', 'wpautop' );
				if ( false !== $priority ) {
					remove_filter( 'the_content', 'wpautop', $priority );
				}

				echo apply_filters( 'the_content', $content_markup );

				if ( false !== $priority ) {
					add_filter( 'the_content', 'wpautop', $priority );
				}

	 		?>

		 	</div><!--.post-content -->

	 	</div><!--.post-entry-content -->

	<?php else:// is not homefeatured:  */?>

		<a href="<?php echo the_permalink($newsid);?>" class="">

			<div class="date-wrap">

				<div class="date">
					<?php echo $date;?>
				</div>

				<div class="line">
				</div>

			</div><!--date-wrap-->

			<?php if($featureimage)://	$featureimage available?>

				<img class="thumb-image-item" src="<?php echo $featureimage;?>">
				<!--<div class="thumb-image-item" style="background-image: url('<?php // echo $featureimage;?>');">
				</div>-->
			<?php else: // $featureimage not available?>
				

				<?php 
				foreach($categories as $category){
				$categoryid = $category->cat_ID;
				//echo $categoryid;
				};

				if($categoryid == '7' ): // if merchandise: ?>
				
					<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/assets/img/news_placeholder_1.png">
 
				<?php elseif ($categoryid == '8' ): // if release: ?>
				
					<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/assets/img/release_placeholder_square.png">
 
				<?php elseif ($categoryid == '1' ): // if Uncategorised: ?>
					
					<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/assets/img/news_placeholder_1.png">
 		
				<?php else: // No Category has been ticked: ?>

					<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/assets/img/news_placeholder_1.png">
 
				<?php endif; //$categories  ?>



			<!--create placeholder images for news items that don't have images:
			if merch category
			if release category
			if general?
			
			Review this - additional categories - Maybe I need to create custom field for each of the categories; allowing placeholder images to be uploaded like that
			or/and have random images // so always unique?
			etc?
			-->

			<?php endif; //$featureimage  ?>
		
			<div class="news-item-title">
			<?php the_title($newsid);?>
			</div><!--news-item-title -->

		</a>

	<?php endif;// is homefeatured */?>

<?php endif;// is home */?>

<?php if (is_single()): 
	// single
	//$newsid = get_the_ID();
 	//$newsimage = get_field('news_featured_image'); // image
 	//$newsdescription = get_field('news_summary_description');// text area - 200 characters limit
 	//$newscontent = get_field('news_content'); // wysiwig
	$postname = get_field('event_name', $thispostid );		//text area				

	$date = get_the_date('jS F Y');
	$featureimage = get_field('feature_image'); // image
	$categories = get_the_category( $post->ID );
 	?>
 
 	<div class="container post-entry-content grid inner outer-grid-item outer-grid-item-xs-8">

		<div class="page-title-positioner outer-grid-item outer-grid-item-sm-8 sticky">
									  
			<div class="page-titler">
						    
				<span class="inner">
				News
				</span><!-- inner -->

		    </div> <!--.page-title -->

		</div><!-- .page-title-position -->

		<div class="post-entry-details grid inner outer-grid-item outer-grid-item-xs-6">
	 
		 	<div class="grid-item grid-item-xs-8 grid-item-sm-4 grid-item-md-3">

				<div class="news-item-title">

				<?php the_title();?>
				</div><!--news-item-title -->

				<div class="date-wrap">

					<div class="date">
					 <?php echo $date;?>
					</div>

				</div><!--date-wrap-->

			</div><!--.grid-item-->

	 	</div><!--.post-entry-details -->
		
		<div class="post-content grid inner outer-grid-item outer-grid-item-xs-8"><!-- was outer-grid-item-xs-6 - review + delete comment -->
 		<?php the_content(); ?>
	 	</div><!--.post-content -->

 	</div><!--.post-entry-content -->

<?php /*we current don use any of the "related releasse" custom fields that are being added if category is release & news is single 
*/?>

<?php endif; // is single ?>

<?php if (is_archive()): 
	$featureimage = get_field('feature_image'); // image
	//$featureimagecredit =  get_field('feature_image_credit');  // text
	$date = get_the_date('jS F Y');
	$categories = get_the_category( $post->ID )
	?>
			
		
		<a href="<?php echo the_permalink();?>" class="">

			<div class="date-wrap">

				<div class="date">
					<?php echo $date;?>
				</div>

				<div class="line">
				</div>

			</div><!--date-wrap-->

			<?php if($featureimage)://	$featureimage available?>

				<img class="thumb-image-item" src="<?php echo $featureimage;?>">
				<!--<div class="thumb-image-item" style="background-image: url('<?php // echo $featureimage;?>');">
				</div>-->
			<?php else: // $featureimage not available?>
				

				<?php 
 
				foreach($categories as $category){
				$categoryid = $category->cat_ID;
				//echo $categoryid;
				};

				if($categoryid == '7' ): // if merchandise: ?>
				
					<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/assets/img/news_placeholder_1.png">
 
				<?php elseif ($categoryid == '8' ): // if release: ?>
				
					<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/assets/img/release_placeholder_square.png">
 
				<?php elseif ($categoryid == '1' ): // if Uncategorised: ?>
					
					<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/assets/img/news_placeholder_1.png">
 		
				<?php else: // No Category has been ticked: ?>

					<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/assets/img/news_placeholder_1.png">
 
				<?php endif; //$categories  ?>



			<!--create placeholder images for news items that don't have images:
			if merch category
			if release category
			if general?
			
			Review this - additional categories - Maybe I need to create custom field for each of the categories; allowing placeholder images to be uploaded like that
			or/and have random images // so always unique?
			etc?
			-->

			<?php endif; //$featureimage  ?>
		
			<div class="news-item-title">
			<?php the_title();?>
			</div><!--news-item-title -->

		</a>

	</article><!-- .news-item -->

<?php endif;  // is archive ?>
