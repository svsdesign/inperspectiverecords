<?php

/**
 * image Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$width = get_field('width');

// Load values and assing defaults.
$image = get_field('image');

// Create id attribute allowing for custom "anchor" value.
$id = 'image-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'image-block';
$BlockClassName = '';

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align-' . $block['align'];
}

if($width) {

    $BlockClassName .= '' . $width; // class names for width atm
                                // I nnee dto craete a grid based option system on acf I rekcon? or similar

} else{

   // $className .= ' width' . $block['width'];
   
}



/* to do:

Bring this inline with the default image block in wordpress;
options include:
- alt text
- aligments
- linking to
- width options + editing capabiliites
- more?
*/


?>
 
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> inp-block block-z-index-2"> 


        <div class="outer-grid-item inner outer-grid-item-xs-8">            

            <div class="grid align-position image-image-wrap">
         
                <div class="grid-item <?php echo esc_attr($BlockClassName); ?> image-inner-image-wrap">

                    <img src="<?php echo $image; ?>"/>
                     
                </div>

            </div> 

        </div> 

    
</div> <!-- inp-block -->