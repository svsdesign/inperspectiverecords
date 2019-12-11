<?php

/**
 * Sound Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'sound-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'sound-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align-' . $block['align'];
}

// Load values and assing defaults.
//$sound = get_field('sound') ?: 'sc track id';

//$author = get_field('author') ?: 'Author name';
//$role = get_field('role') ?: 'Author role';
//$image = get_field('image') ?:'insert image';
//$background_color = get_field('background_color');
//$line_color = get_field('line_color');
$text_color = get_field('text_color');
$soundblockid = get_field('sound'); //post object - IDS
$soundcloudlink = get_field('soundcloud_link', $soundblockid);
$postlink = get_permalink( $soundblockid);
$showid = $soundblockid;// id of the post
// figure out if this item is public & display link accordingly
$publicid = get_field('is_item_public', $soundblockid);
$thisnumber = 0; // this number to be changed based on number of blocks - or does it not matter?
?>
 <div class="<?php echo esc_attr($className); ?> inp-block block-z-index-2">
    
    <li data-trackid="<?php echo $showid?>" data-tracklink="<?php echo $soundcloudlink;?>" id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> grid"> 

        <div class="outer-grid-item inner outer-grid-item-xs-6">            

            <div class="align-position sound-sound-wrap">
         
                <div class="sound-inner-sound-wrap">
                        
                    <div class="radio-item grid" id="<?php echo $thisnumber?>" data-tracklink="<?php echo $soundcloudlink;?>">
                
                        <div class="play-icon-wrap">

                            <div class="play-toggle small"> 
                            
                                <svg id="playertoggle_<?php echo $showid?>" class="playertoggle-inline"  width="100%" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"> 
                                    <path id="play_<?php echo $showid?>" class="play-inline" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> 
                                    <path id="play-left_<?php echo $showid?>" class="play-left-inline" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> 
                                    <path id="play-right_<?php echo $showid?>" d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> 
                                    <path opacity="0" id="pause_<?php echo $showid?>" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> 
                                    <path opacity="0" id="pause-left_<?php echo $showid?>" d="M447,1000 0,1000 0,0 447,0 447,500.084 z" fill-rule="nonzero"/> 
                                    <path opacity="0" id="pause-right_<?php echo $showid?>" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> 
                                    <path style="display:none;" id="play-path_<?php echo $showid?>" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> 
                                    <path style="display:none;" id="play-path-left_<?php echo $showid?>" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/>
                                    <path style="display:none;" id="play-path-right_<?php echo $showid?>" d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> 
                                </svg> 
                            
                            </div>
        
                        </div>

                        <div class="details-wrap grid-item grid-item-xs-4 grid-item-md-3">

                            <div class="show-title">
                            <?php echo get_the_title($soundblockid); ?>
                            </div>

                            <div class="show-start">
                            <?php $showstart = get_field('show_start_date', $soundblockid); echo date_i18n('dS F Y', $showstart);  ?>
                            </div>
                            <?php if ($publicid == "1"):?>

                                <a href="<?php echo $postlink;?>" class="radio-view-item">
                                View Show <?php echo $public;?>
                                </a>
        
                            <?php endif;?>

                        </div><!-- .details-wrap -->  

                    </div><!-- .radio-item.grid -->  

                </div><!-- .sound-inner-sound-wrap-->  

            </div><!-- class="radio-item -->  

        </div> 

    </li>
   
</div> <!-- inp-block -->     

<style type="text/css">
    #<?php echo $id; ?>,
    #<?php echo $id; ?> .details-wrap,
    #<?php echo $id; ?> a {
    color: <?php echo $text_color; ?>;
    }
    #<?php echo $id; ?> .play-toggle.small{
    border-color: <?php echo $text_color; ?>;
    }

    #<?php echo $id; ?> path{
    fill:<?php echo $text_color; ?>;
    }

    #<?php echo $id; ?> .play-toggle.small:hover{
    border-color: <?php echo $text_color; ?>;
    }

    #<?php echo $id; ?> .play-toggle.small:hover path {
    fill: <?php echo $text_color; ?>;
    }
 
</style>

