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

      /*  var $thiscontainer = $block.find(".record-circle-container"),
          //  $thiscontainer = $(this),
            $thiscircle = $block.find(".record-circle");
            $thiscontainer.removeClass("active","rotating","rotated");// incase its active still - seems to be some buggy behavior atm
            $thiscontainer.css("pointer-events","initial");// allow pointer events now that the js is ready
            //$thiscontainer.css("background","red");
    //    setTimeout(function(){
          circlehover();
    //    }, 1000);

        function circlehover(){

                $thiscircle.hover(function() {
            
            console.log("thiscircle.hover function");

              if($thiscircle.hasClass("rotating")){

                $thiscircle.removeClass("rotating"); 
                $thiscircle.removeClass("rotate");
                $thiscontainer.removeClass("active");

              } else {

                 $thiscircle.addClass("rotating");
                 $thiscircle.addClass("rotate");
                 $thiscontainer.addClass("active");

              } // if

            }); // hover

           }//        function circlehover(){

            */

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