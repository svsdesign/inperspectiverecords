jQuery(document).ready(function($) {

      scrollOptions = {
        duration: 800,
        easing:'swing'
      };
    

    /// consider gong back to prevous solutions? what reason not run th html5ajax - ??

 
  // RUN BARBA

  Barba.Pjax.Dom.wrapperId = 'ajax-wrapper';
  Barba.Pjax.Dom.containerClass = 'ajax-container';
  Barba.Pjax.start();

  Barba.Dispatcher.on('newPageReady', function(currentStatus, oldStatus, container, newPageRawHTML) {
  var response = newPageRawHTML.replace(/(<\/?)body( .+?)?>/gi, '$1notbody$2>', newPageRawHTML)
  var bodyClasses = $(response).filter('notbody').attr('class')
  $('body').attr('class', bodyClasses);

  console.log("hello newPageReady");
  

  var activeradio = false;
  var pausedradio = false;

  /*$(container).find('script').each(function (i, script) {
     
  console.log("hello each script");

        var $script = $(script);
        $.ajax({
            url: $script.attr('src'),
            cache: true,
            dataType: 'script',
            success: function () {
                eval($script.attr('onload'));
            }
        });random(300)
    });
*/

/*   $.getScript('./wp-content/themes/inperspectiverecords/assets/js/inp-base.js', function()
        {
          // script is now loaded and executed.
          // put your dependent JS here.
        }); 
*/

 
  //  console.log("theme dir=" +theme_directory + "");
           $.getScript( ""+theme_directory +"/assets/js/inp-base.js", function( data, textStatus, jqxhr ) {
      //       console.log( data ); // Data returned
       //       console.log( textStatus ); // Success
        //        console.log( jqxhr.status ); // 200
      

             console.log( "inp-base.js Load was performed." );
          });



 // Inform Google Analytics of the change
          if ( typeof window.ga !== 'undefined' ) {
            // Universal Analytics
            window.ga('send', 'pageview', relativeUrl);
          } else if ( typeof window._gaq !== 'undefined' ) {
            // Legacy analytics
            window._gaq.push(['_trackPageview', relativeUrl]);
          }

                  
  
          // Inform Google Analytics of the change
          if ( typeof window._gaq !== 'undefined' ) {
            window._gaq.push(['_trackPageview', relativeUrl]);
          }

          // Inform ReInvigorate of a state change
          if ( typeof window.reinvigorate !== 'undefined' && typeof window.reinvigorate.ajax_track !== 'undefined' ) {
            reinvigorate.ajax_track(url);
            // ^ we use the full url here as that is what reinvigorate supports
          }



})
 
/*

Barba.Dispatcher.on('newPageReady', function (currentStatus, oldStatus, container) {
  
  console.log("hello page readyy");

    $(container).find('script').each(function (i, script) {
        var $script = $(script);
        $.ajax({
            url: $script.attr('src'),
            cache: true,
            dataType: 'script',
            success: function () {
                eval($script.attr('onload'));
            }
        });
    });
});

*/




  var FadeTransition = Barba.BaseTransition.extend({
    start: function() {
      /**
       * This function is automatically called as soon the Transition starts
       * this.newContainerLoading is a Promise for the loading of the new container
       * (Barba.js also comes with an handy Promise polyfill!)
       */

      // As soon the loading is finished and the old page is faded out, let's fade the new page
      Promise
        .all([this.newContainerLoading, this.fadeOut()])
        .then(this.fadeIn.bind(this));
    },

    fadeOut: function() {
      /**
       * this.oldContainer is the HTMLElement of the old Container
       */
       if($('body').hasClass('sc-player-playing')){

        console.log("player is playing - apply class sc-player-playing")
        activeradio = true;

       } else {
        console.log("player is not playing")
        activeradio = false
       };// if($('body').hasClass('sc-player-playing')

       if($('body').hasClass('sc-player-paused')){

        console.log("player is paused - apply class sc-player-paused")
        pausedradio = true;

       } else {
        console.log("player is paused")
        pausedradio = false
       };// if($('body').hasClass('sc-player-paused')){


      return $(this.oldContainer).animate({ opacity: 0 }).promise();
    },

    fadeIn: function() {
      /**
       * this.newContainer is the HTMLElement of the new Container
       * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
       * Please note, newContainer is available just after newContainerLoading is resolved!
       */

      var _this = this;
      var $el = $(this.newContainer);

      $(this.oldContainer).hide();

       if (activeradio == true) {
        console.log("player is playing - apply class sc-player-playing")
        $('body').addClass('sc-player-playing')
       }/// if radio was active


      if (pausedradio == true) {
          console.log("player is paused - apply class sc-player-paused")
          $('body').addClass('sc-player-paused')
       }/// if radio was paused


      $el.css({
        visibility : 'visible',
        opacity : 0
      });

      $('html, body').animate({
        scrollTop: $("body").offset().top }, 10); // scroll top before opacity change

      $el.animate({ opacity: 1 }, 400, function() {
        /**
         * Do not forget to call .done() as soon your transition is finished!
         * .done() will automatically remove from the DOM the old Container
         */
  
        _this.done();

        //if ( $('body').ScrollTo||false ) { 
       //     $('body').ScrollTo(scrollOptions);  
            //console.log("scrolltop?");

           
         // } 




          




      /***/

        // jQuery
      /*  $.getScript('./wp-content/themes/inperspectiverecords/assets/js/inp-base.js', function()
        {
          // script is now loaded and executed.
          // put your dependent JS here.
        }); 
 */
      //  app.init(); // initiate my js app - after new content comes in - not sure this is the correct thing to do.

      });
    }
  });

  /**
   * Next step, you have to tell Barba to use the new Transition
   */

  Barba.Pjax.getTransition = function() {
    /**
     * Here you can use your own logic!
     * For example you can use different Transition based on the current page or link...
     */

    return FadeTransition;
  };



}); ///  ENDS  read.QUERY

