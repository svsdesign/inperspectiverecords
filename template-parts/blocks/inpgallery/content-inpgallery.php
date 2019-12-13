<?php

/**
 * Gallery Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$width = get_field('width');

// Load values and assing defaults.
//$image = get_field('image');
//$images = get_field('image-gallery')

// Create id attribute allowing for custom "anchor" value.
$id = 'gallery-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'gallery-block';
$BlockClassName = '';

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align-' . $block['align'];
}

if($width) {

    $BlockClassName .= '' . $width; // class names for width atm


} else {

   // $className .= ' width' . $block['width'];
   
}
 
$images = get_field('gallery');

if( $images ): ?>
  
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> inp-block block-z-index-2"> 

        <div class="outer-grid-item inner outer-grid-item-xs-8">            

            <div class="grid align-position gallery-wrap gallery-carousel">

<!--            <div class="grid align-position gallery-wrap gallery-carousel" data-flickity='{ "imagesLoaded": true, "percentPosition": false, "freeScroll": true, "wrapAround": true }'> -->

                 <?php foreach( $images as $image ): ?>
                   
                     <img src="<?php echo $image?>" alt="image" />

                <?php endforeach; ?>
 
            </div> 

        </div> 
        
    </div> <!-- inp-block -->

<?php endif; ?>
