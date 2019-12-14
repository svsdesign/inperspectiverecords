<?php

/**
 * Event Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'event-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'event-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


$eventid = get_field('event'); //post object - IDS
$upcomingeventid = $eventid;          
$eventstart = get_field('event_start_date', $eventid); // date and time picker
$eventend = get_field('event_end_date', $eventid); // date and time picker
$posterart =  get_field('poster_art', $eventid); // image
$bannerart =  get_field('banner_art', $eventid); // image - banner
$venue =  get_field('venue', $eventid);  // text
$venuelink =  get_field('venue_url', $eventid);  // text
$name =  get_field('event_name', $eventid);          
$fblink =  get_field('facebook_link', $eventid); //text
$ralink =  get_field('resident_advisor_link', $eventid); //text
$isupcomingnextevent = get_post_meta($upcomingeventid, 'is-next-event' );  // if 'true' in array 
 //if no release id selected it will give the id of the current post
//echo get_permalink( $releaseid); 
// see DEc 2019 post - seba relase one with and one withouth the rlease - what to do? just provide the seba id, which is what the latest?
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> inp-block block-z-index-2 grid">              
   
      <?php if($bannerart): ?>

        <div class="event-item event-image-item outer-grid-item inner-padded outer-grid-item-sm-6 <?php if (in_array("true", $isupcomingnextevent)): ?>next-event<?php endif; //$isupcomingnextevent ?>" style="background-size:cover; background-image: url('<?php echo $bannerart;?>');">
      
        <?php else:?>

        <div class="event-item outer-grid-item inner-padded outer-grid-item-sm-6 <?php if (in_array("true", $isupcomingnextevent)): ?>next-event<?php endif; //$isupcomingnextevent ?>">

      <?php endif; //$posterart ?>

        <div class="grid">
    
          <?php if($name): ?>

            <div class="event-name grid-item grid-item-xs-6 grid-item-md-3">
                  
              <?php echo $name; ?>
                    
            </div><!-- .event-name -->
        
          <?php endif; //$name ?>

          <div class="date grid-item grid-item-xs-6 grid-item-md-3">
                
            <?php $startdate = get_field('event_start_date', $eventid); echo date_i18n('dS F Y', $startdate);  ?>
            <?php// $starttime = get_field('event_start_date'); echo date_i18n('h:i', $starttime);  ?>
            <?php //$endtime = get_field('event_end_date'); echo date_i18n('h:i', $endtime);  ?>

          </div><!-- .date -->

          <div class="event-summary grid-item grid-item-xs-6 grid-item-md-3">
              
            <!-- review this <div class="event-summary-bg"> 
            </div>  -->


            <?php if($venue): ?>

              <div class="summary-item venue">
                
                <a class="scale-link" target="_blank" href="<?php echo $venuelink;?>">

                <span><?php echo $venue ;?></span>   
                <div class="svg-icon inline-icon right white-icon">
                <?php get_template_part('/assets/svg/inline-inp_location-marker.svg'); ?>
                </div><!-- svg-icon inline-icon --> 
              
                </a> 

              </div><!-- .venue -->

            <?php endif; //$venue ?>   

            <?php if($ralink): ?>

              <div class="summary-item price">
                
                <a class="scale-link" target="_blank" href="<?php echo $ralink;?>">
                  
                  <span class="">Buy Tickets</span>
                  <div class="svg-icon inline-icon right white-icon">
                  <?php get_template_part('/assets/svg/inline-inp_arrow-right.svg'); ?>
                  </div><!-- svg-icon inline-icon --> 
                
                </a> 

              </div>  

            <?php endif; //$ralink ?>

            <?php if($fblink): ?>

              <div class="summary-item fb-details">
                  
                <a class="scale-link" href="<?php echo $fblink ;?>">
                
                  <span>Facebook Event</span>
                  <div class="svg-icon inline-icon right white-icon">
                  <?php get_template_part('/assets/svg/inline-inp_facebook-logo.svg'); ?>
                  </div><!-- svg-icon inline-icon --> 
        
                </a>
      
              </div><!-- .fb-details -->

            <?php endif; //$fblink ?>
        
            <div class="summary-item event-link">

              <a class="scale-link" href="<?php the_permalink($eventid);?>">
                
                <span class="">More Information</span>
                <div class="svg-icon inline-icon right white-icon">
                <?php get_template_part('/assets/svg/inline-inp_arrow-right.svg'); ?>
                </div><!-- svg-icon inline-icon --> 
                                        
              </a>

            </div><!--.event-link"-->
            
          </div> <!-- .event-summary -->

        </div><!--.grid -->

      <?php if($posterart): ?>

        </div><!--.event-item event-image-item -->
      
        <?php else:?>

        </div><!-- .event-item -->

      <?php endif; //$posterart ?>


</div><!-- .block -->
