<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   
 */?>


<!DOCTYPE html>
<html <?php language_attributes(); ?> class="">
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>

 <?php /* to do - consider type use + font loading
 	<link rel="preload" href="<?php echo bloginfo('template_directory'); ?>/assets/fonts/HelveticaNeue.woff" as="font" crossorigin><!-- added to speed up load -->
	<link rel="preload" href="<?php echo bloginfo('template_directory'); ?>/assets/fonts/HelveticaNeue-Medium.woff" as="font" crossorigin>
	<link rel="preload" href="<?php echo bloginfo('template_directory'); ?>/assets/fonts/HelveticaNeue-Bold.woff" as="font" crossorigin>
	 */?>
 <?php /* to do - add icons
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo bloginfo('template_directory'); ?>/assets/icon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo bloginfo('template_directory'); ?>/assets/icon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo bloginfo('template_directory'); ?>/assets/icon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo bloginfo('template_directory'); ?>/assets/icon/site.webmanifest">
	<link rel="mask-icon" href="<?php echo bloginfo('template_directory'); ?>/assets/icon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	*/?>
	<meta property="og:title" content="<?php the_title(); ?>"/>
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<meta name="description" content="<?php echo get_bloginfo( 'description' ); ?>"/>
	<meta name="author" content="svs.design"/>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
 
</head>

<script>
/* used for determining if we're local or live */
  theme_directory = "<?php echo get_template_directory_uri() ?>";
</script>

<body <?php body_class(''); // 'dev-on' - whilst working site leave dev-on by default ?>>

	<?php include( 'navigation.php' );?>

	<?php //query to return all the radio items
	$radioquery = array(
		'post_type' => 'radio',
		'post_status' => 'publish',
		'numberposts' => -1,
		'posts_per_page' => 999999,

		);

	    query_posts($radioquery);  ?>
			
			<?php if ( have_posts() ) :
 				$number = 0;
				?>

				<div class="radio-container">
 
					<div class="sc-player">
							
					<?php // Start the Loop.
					while ( have_posts() ) : the_post();
					$soundcloudlink = get_field('soundcloud_link');
					if($soundcloudlink):?>
					
					   	<a class="<?php the_permalink();?>" data-trackno="<?php echo $number?>" data-websitelink="<?php the_permalink();?>" data-tracklink="<?php echo $soundcloudlink;?>" href="<?php echo $soundcloudlink;?>"></a>
			 
					<?php endif;	                  
					 // End the loop. 
					$number ++;
					endwhile; ?>						

					</div><!--.sc-player -->

				</div><!-- .radio-container -->

			<?php else: // else no items ?>						
			<?php endif; // endif have post ?>

			<?php if ( have_posts() ) :
			//To do - sort these querries out - issue in term of querriing to much?
 				$number = 0;
				?>

				<!--to do - once a track has stopped playing - I should prompt the site to load the next permalink aswell as the next sc url? -->
				<div class="data-container">
					
					<?php // Start the Loop.
					while ( have_posts() ) : the_post();
					$soundcloudlink = get_field('soundcloud_link');
					if($soundcloudlink):?>
					
					   	<div id="data-item-<?php echo $number?>" data-websitelink="<?php the_permalink();?>" data-tracklink="<?php echo $soundcloudlink;?>" href="<?php echo $soundcloudlink;?>"></div>
			 
					<?php endif;	 // if sc loink                  
					$number ++;
					endwhile; // End the loop. ?>						

				</div><!-- .radio-container -->

			<?php else: // else no items ?>						
			<?php endif; // endif have post ?>


		<?php wp_reset_query(); ?>								
		
	<div id="ajax-wrapper">

	  <div class="ajax-container">

 