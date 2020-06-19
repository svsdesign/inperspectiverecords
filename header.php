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

<!-- site icons -->	 		
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo bloginfo('template_directory'); ?>/assets/site-icons/front-end/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo bloginfo('template_directory'); ?>/assets/site-icons/front-end/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo bloginfo('template_directory'); ?>/assets/site-icons/front-end/favicon-16x16.png">
	<link rel="manifest" href="<?php echo bloginfo('template_directory'); ?>/assets/site-icons/front-end/site.webmanifest">
	<link rel="mask-icon" href="<?php echo bloginfo('template_directory'); ?>/assets/site-icons/front-end/safari-pinned-tab.svg" color="#000000">
	<link rel="shortcut icon" href="<?php echo bloginfo('template_directory'); ?>/assets/site-icons/front-end/favicon.ico">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-config" content="<?php echo bloginfo('template_directory'); ?>/assets/site-icons/front-end/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<!-- end site icons -->

	<meta property="og:title" content="<?php the_title(); ?>"/>
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<meta name="description" content="<?php echo get_bloginfo( 'description' ); ?>"/>
	<meta name="author" content="svs.design"/>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	
 <!-- Cookie Consent by https://www.FreePrivacyPolicy.com -->

 <!-- Cookie Consent by https://www.FreePrivacyPolicy.com - not sure this the best solution- try cookie concsent plugin that nick
<script type="text/javascript" src="//www.FreePrivacyPolicy.com/cookie-consent/releases/3.0.0/cookie-consent.js"></script>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
    cookieconsent.run({"notice_banner_type":"headline","consent_type":"express","palette":"dark","change_preferences_selector":"#changePreferences","language":"en","website_name":"svsdesign"});
});
</script>
-->
<!-- Unnamed script -->
<!-- example of how its add markup for "cookie using scripts scripts such as googl this just exmpale is theirs <script type="text/plain" cookie-consent="tracking" src="//www.FreePrivacyPolicy.com/cookie-consent/releases/3.0.0/cookie-consent.js"></script> -->

<!-- end of Unnamed script-->

<!-- <noscript>GDPR Cookie Consent by <a href="https://www.freeprivacypolicy.com/">FreePrivacyPolicy</a></noscript> -->
<!-- End Cookie Consent -->
<!-- caching issues on safari during dev:https://stackoverflow.com/questions/11754305/why-my-mobile-safari-cache-wont-clear -->
<!--
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="-1"> -->
<!-- eventually remove this I think? -->

<?php// header('Content-Type: application/json');?>

</head>

<script>
/* used for determining if we're local or live */
  theme_directory = "<?php echo get_template_directory_uri() ?>";
</script>

<body <?php body_class('not-admin'); // 'dev-on' - whilst working site leave dev-on by default ?>>

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
	
	<div id="ajax-wrapper" data-barba="wrapper">


 