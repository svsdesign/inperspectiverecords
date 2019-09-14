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

 
<?php if ( is_home()) :?>

	<a href="<?php echo the_permalink();?>">
			<?php the_title();?>
	</a>

<?php endif;// is home ?>

<?php if (is_single()) : 
	// single
	//$newsid = get_the_ID();
 	//$newsimage = get_field('news_featured_image'); // image
 	//$newsdescription = get_field('news_summary_description');// text area - 200 characters limit
 	//$newscontent = get_field('news_content'); // wysiwig
	$date = get_the_date('d F Y');
	$featureimage = get_field('feature_image'); // image
	$categories = get_the_category( $post->ID );
 	?>
	<?php the_content();?>


<?php endif; // is single ?>

<?php if (is_archive()): 
	$featureimage = get_field('feature_image'); // image
	//$featureimagecredit =  get_field('feature_image_credit');  // text
	$date = get_the_date('d F Y');
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
