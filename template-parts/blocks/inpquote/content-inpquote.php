<?php

/**
 * Quote Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'quote-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'quote-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$text = get_field('quote') ?: 'Your quote here...';
$author = get_field('author') ?: 'Author name';
//$role = get_field('role') ?: 'Author role';
$image = get_field('image') ?:'insert image';
//$background_color = get_field('background_color');
$line_color = get_field('line_color');
$text_color = get_field('text_color');

// maybe I can use the additioan ccs field to control specific block's z-index aswell?


?>
 
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> inp-block block-z-index-1">

    <blockquote class="quote-blockquote grid">
        
        <div class="quote-text-wrap outer-grid-item inner outer-grid-item-xs-6">
            
            <div class="grid align-position">

                <div class="grid-item grid-item-xs-4 grid-item-md-2 quote-inner-text-wrap">

                    <span class="quote-text"><?php echo $text; ?></span>
                    <span class="quote-author"><?php echo $author; ?></span>
                  <!--  <span class="quote-role"><?php// echo $role; ?></span> -->
                    
                </div>
   
            </div>

        </div><!-- .quote-text-wrap -->
        
        <div class="quote-image size-item-xs-6" style="background-image:url(<?php echo $image;?>);">
        </div>

    </blockquote>
   
</div> <!-- inp-block -->      
<style type="text/css">
    #<?php echo $id; ?> {
        background: <?php echo $background_color; ?>;
        color: <?php echo $text_color; ?>;
    }

    #<?php echo $id; ?> .quote-inner-text-wrap{
    border-color:<?php echo $line_color; ?>;
    }

</style>

