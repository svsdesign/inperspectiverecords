<?php

/**
 * Release Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'release-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'release-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


// Load values and assing defaults.
//$sound = get_field('sound') ?: 'sc track id';

//$author = get_field('author') ?: 'Author name';
//$role = get_field('role') ?: 'Author role';
//$image = get_field('image') ?:'insert image';
//$background_color = get_field('background_color');
//$line_color = get_field('line_color');
//$text_color = get_field('text_color');
$releaseblockid = get_field('release'); //post object - IDS
//$soundcloudlink = get_field('soundcloud_link',$soundblockid);
$thisnumber = 0; // this number to be changed based on number of blocks - or does it not matter?
$releaseid = $releaseblockid;//->ID;
$phptemplate = get_field('release_php_template', $releaseid);
$phptemplatestring = 'releases/'.$phptemplate.'.php';
$releasetitle = get_field('release_title', $releaseid); // 
$releasecode = get_field('release_code', $releaseid); // 
$releaseartists = get_field('releases_artists', $releaseid); // relationship = bi-directional - IDS
$releaseproductcover = get_field('release_product_image_front', $releaseid); // relationship = bi-directional - IDS
$releaselabel = get_field('release_vinyl_label_image', $releaseid); // relationship = bi-directional - IDS
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> inp-block block-z-index-2 grid">
         
      <?php if ($phptemplate):// has template?>
            
          <a href="<?php echo get_permalink( $artistsrelease->ID ); ?>">

          <?php include ('releases/'.$phptemplate.'.php');?>

          </a>


      <?php else: //does not have template: ?>

          <a href="<?php echo get_permalink( $artistsrelease->ID ); ?>">

            <div class="record-circle-container">
               
               <div class="sleave-square">
                    
                    <?php if ($releaseproductcover):?>
                    
                    <img class="record-sleave" src="<?php echo $releaseproductcover;?>">

                <?php else: // if not image use placholder - make the placeholder?>
                    
                    <img class="record-sleave" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/seba_cover_600px.jpg"/>

                    <?php endif; // if $releaseproductcover?>

                </div>  
                
                <div class="release-details">

                  <div class="inner-container">  

                    <div class="release-code">
                 
                    <?php echo $releasecode;?>

                    </div>

                    <?php if ($releasetitle):?>

                      <div class="release-title">
                    <?php echo $releasetitle; ?>
                      </div>
                   
                    <?php endif; // if $releasetitle?>

                    <?php if ($releaseartists):?>
                   
                   <div class="release-artists">

                    <?php foreach($releaseartists as $releaseartist):?>
                               
                       <div class="release-artist">

                        <?php echo get_the_title( $releaseartist->ID );  ?>
 
                          </div>

                        <?php endforeach; // if releaseartists?>
                        
                     </div>

                    <?php endif; // if releaseartists?>
        
                  </div><!-- .inner-container -->

                </div><!-- .release-details -->
             
                <div class="record-circle rotated">
                
                  <div class="inner-container"> 
                  

                  <?php if ($releaselabel):?>
                    
                    <img class="record-label" src="<?php echo $releaselabel;?>">

                <?php else: // if not image use placholder - make the placeholder?>
                    
                      <img class="record-label" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_label_seba_side_a_600.png"/>

                    <?php endif; // if $releaseproductcover?>
                  
                    <img class="record-item" src="http://localhost:8888/inp-wp/wp-content/uploads/2019/01/web_records_blank_black.png"/>
                    
                  </div><!-- .inner-container-->              
                  
                </div><!-- .record-circle-->

            </div> <!-- .record-circle-container-->                

          </a>

      <?php endif;?>

</div><!-- .block -->
<?php//
//    wp_enqueue_script('enquire', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inprelease/assets/js/script.js', array('jquery'), null, true );
?>
<script>


</script>
