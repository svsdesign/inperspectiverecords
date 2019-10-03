<?php

/**
 * Credit Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'credit-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'credit-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$title = get_field('credit_title') ?: 'Credit Title';
$details = get_field('credit_details') ?: 'Credit Text';
$text_color = get_field('text_color');
?>
 

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> inp-block block-z-index-2">

    <div class="grid">

        <div class="outer-grid-item inner outer-grid-item-xs-4">            

            <div class="grid align-position credit-text-wrap">
         
                <div class="grid-item grid-item-xs-4 grid-item-md-2 credit-inner-text-wrap">

                    <span class="credit-title"><?php echo $title; ?></span>
                    <span class="credit-details"><?php echo $details; ?></span>
                     
                </div>

            </div> 

        </div> 

    </div> 
   
</div> <!-- inp-block -->     

<style type="text/css">
    #<?php echo $id; ?> {
    color: <?php echo $text_color; ?>;
    }
</style>

