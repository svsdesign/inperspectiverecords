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




<?php 
 // query_posts("page_id=5"); // local
  $homepage = new WP_Query("page_id=5");

  while ( $homepage->have_posts() ) : $homepage->the_post();
  
$excludedposts = array();

// check if the repeater field has rows of data
if( have_rows('featured_posts') ):

// loop through the rows of data
    while ( have_rows('featured_posts') ) : the_row();

    // check for some conditon and register bus type in array
   // if( the_sub_field('band_food') == 'hamburger' ):
       $excludedposts[] = get_sub_field('select_post');
       $thispostid = get_sub_field('select_post');
       $thisposttype = get_post_type( $thispostid );
       $thistemplatename = 'content-'. $thisposttype .'.php';
       $homefeatured = true;
    //endif;

       // using the ID - I know need to find out what post type they reside in
       //printf( __( 'The post type is: %s', 'textdomain' ), get_post_type( $thispostid ) );
/* this too much code - keep it simpler:
        if ($thisposttype == 'events'){


        } elseif ($thisposttype == 'radio'){


        } elseif ($thisposttype == 'radio'){

        } */

      include(locate_template($thistemplatename));

     //   get_template_part( 'content', $thisposttype ); 

    endwhile;

endif;

 
 
  endwhile; 
  wp_reset_query(); 
//print $excludedposts[];
    $excludedposts = implode(',', $excludedposts);

echo $excludedposts;
  ?>
<?php /*
// using elvis operator to ensure it returns an array if 'fixed_posts' has value

$query = new WP_Query([
  'post_type' => 'post', 
  'post__not_in' => $excludedposts // ensure exclusion across cpt's: event, radio, artists
]);
*/

?>




<?php get_footer();?>
