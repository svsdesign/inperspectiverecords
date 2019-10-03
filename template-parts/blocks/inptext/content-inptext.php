<?php

/**
 * Text Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'text-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$text = get_field('text') ?: 'Your text here...';
//$author = get_field('author') ?: 'Author name';
//$role = get_field('role') ?: 'Author role';
//$image = get_field('image') ?:'insert image';
//$background_color = get_field('background_color');
//$line_color = get_field('line_color');
$text_color = get_field('text_color');

// maybe I can use the additioan ccs field to control specific block's z-index aswell?


?>
 
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> inp-block block-z-index-2">  <div class="grid">

        <div class="outer-grid-item inner outer-grid-item-xs-6">            

            <div class="grid align-position text-text-wrap">
         
                <div class="grid-item grid-item-xs-8 grid-item-md-4 text-inner-text-wrap">

                    <?php echo $text; ?>
                     
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

