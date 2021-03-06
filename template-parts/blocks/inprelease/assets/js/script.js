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
              
 
        var $thiscontainer = $block.find(".record-circle-container, .record-square-container"),
            $thiscircle = $block.find(".record-circle"),
            $thissquare = $block.find(".flip-card");// was: .record-square
          
            $thiscontainer.removeClass("active","flipping","flipped");// incase its active still - seems to be some buggy behavior atm
            $thissquare.removeClass("flipping");// in an effort to reset?
            $thiscontainer.removeClass("active","rotating","rotated");// incase its active still - seems to be some buggy behavior atm
            // $thiscontainer.css("pointer-events","initial");// allow pointer events now that the js is ready
            $thiscontainer.css("pointer-events","initial");// allow pointer events now that the js is ready


          squarehover();
          circlehover();
 

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

        function squarehover(){

           
        $thissquare.hover(function() {
          console.log("this square hover")


      //$thiscircle.mouseover(function() {
          if($thissquare.hasClass("flipping")){
          console.log("has class flipping")

        
          $thissquare.removeClass("flipping"); 
          $thissquare.removeClass("flip");
          $thiscontainer.removeClass("active");

        } else {
        console.log("DOES NOT have class flipping")

           $thissquare.addClass("flipping");
           $thissquare.addClass("flip");
           $thiscontainer.addClass("active");

        } // if

       }); // hover


 
         }//        function circlehover(){


    }//var initializeBlock = function( $block ) 

    // Initialize each block on page load (front end).
    $(document).ready(function(){

      //console.log("documentready")
        // if I only want to run the scripts on the admins side:
        if ($("body").hasClass("wp-admin")) {
            //console.log("is admin")

            $(".record-circle-container, .record-square-container").each(function() {

                initializeBlock( $(this) );
            });

         }//end if I only want to run the scripts on the admins side:

    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=inprelease', initializeBlock );
    }

})(jQuery);