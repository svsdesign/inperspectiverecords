<?php

/**
 * Artist Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
// Create id attribute allowing for custom "anchor" value.
$id = 'artist-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'artist-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
//$text = get_field('quote') ?: 'Your quote here...';
//$author = get_field('author') ?: 'Author name';
//$role = get_field('role') ?: 'Author role';
//$image = get_field('image') ?:'insert image';
//$background_color = get_field('background_color');
//$line_color = get_field('line_color');
//$text_color = get_field('text_color');

$artistblockid = get_field('artist'); //post object - IDS
//echo $artist;
//echo $artistid;
?>




<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> inp-block block-z-index-2">

	<div class="grid">
 
                 
 
 		 
						
		<?php //foreach( $artists as $artist ): 
		//	$artistid = $artist->ID;
		$artistblockbanner = get_field('artist_banner_image', $artistblockid);
		//$artistid;?>


			<a href="<?php echo get_permalink( $artistblockid ); ?>">

			   		<div class="banner-image" style="background-image: url('<?php echo $artistblockbanner;?>');">
												   		
												   		
			 		<div class="page-title-positioner left-side outer-grid-item outer-grid-item-sm-8 sticky">
											  
						<div class="page-titler inline">
									    
							 <span class="inner artist-title">
							<?php echo get_the_title( $artistblockid ); ?>
							</span><!-- .artist-title -->

					    </div> <!--.page-title -->
							    
					</div><!-- .page-title-position --> 

			    </div><!-- banner-image -->

			</a>

		<?php//endforeach; ?>

    </div> 
   
</div> <!-- .inp-block -->     




<style type="text/css">
    #<?php echo $id; ?> {
    color: <?php echo $text_color; ?>;
    }
</style>