//https://www.advancedcustomfields.com/resources/acf_register_block_type/
(function($){

    /**
     * initializeBlock
     *
     * Adds custom JavaScript to the block HTML.
     *
     * @date    15/4/19
     * @since   1.0.0
     *
     * @param   object $block The block jQuery element.
     * @param   object attributes The block attributes (only available when editing).
     * @return  void
     */

    var initializeBlock = function( $block ) {
            
        //$block.find('img').doSomething();
        console.log('initializeBlock = function( $block ) - gallery block');
 
        var $thiscontainer = $block.find(".gallery-carousel");      
        /*
        $thiscontainer.flickity({
            imagesLoaded: true, 
            percentPosition: false, 
            freeScroll: true, 
            wrapAround: true 
         });
        */

         $thiscontainer.flickity({
            imagesLoaded: true, 
            // setGallerySize: true, // I currently set the height in js - 40vh; review this - i.e ensure the css I use targets admin aswll
            setGallerySize: false, //if you prefer to size the carousel with CSS, rather than using the size of cells.
       // default cellAlign: 'center'
            percentPosition: false, 
            freeScroll: true, 
            wrapAround: true, 
            arrowShape: { 
              x0: 15,
              x1: 65, y1: 50,
              x2: 75, y2: 40,
              x3: 35
            }
//            arrowShape: '82.9312793 24.4501626 86.9653917 27.5504528 49.7576146 75.9653917 12.5498374 27.5504528 16.5839498 24.4501626 49.7576146 67.615895',

         });

    }//var initializeBlock = function( $block ) 

    // Initialize each block on page load (front end).
    $(document).ready(function(){

      //console.log("documentready")
        // if I only want to run the scripts on the admins side:
        if ($("body").hasClass("wp-admin")) {
            //console.log("is admin")

         /* add code here 
           $(".record-circle-container").each(function() {

                initializeBlock( $(this) );
            });
*/
         }//end if I only want to run the scripts on the admins side:

    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=inpgallery', initializeBlock );
    }

})(jQuery);