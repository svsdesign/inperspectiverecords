<?php

/**
 * Spacer Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'spacer-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'spacer-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$spacer = get_field('spacer_settings'); // number

// maybe I can use the additioan ccs field to control specific block's z-index aswell?


?>
 
<div id="<?php echo esc_attr($id); ?>" data-spaces="<?php echo $spacer; ?>" class="<?php echo esc_attr($className); ?> inp-block block-z-index-2"> 
    
    <div class="grid">

        <div class="outer-grid-item inner outer-grid-item-xs-6">            

            <div class="grid align-position spacer-spacer-wrap">
         
                <div class="grid-item grid-item-xs-8 grid-item-md-4 spacer-inner-spacer-wrap">

                    
                     
                </div>

            </div> 

        </div> 

    </div> 
   
</div> <!-- inp-block -->     
