/**
 *
 * Inperspective Records
 * 2018
 * Author: Simon van Stipriaan
 * http://svs.design 
 * 
 * inp-base.js - handles the serving up of scripts for the entire website
 */

//console.log("inp-base.js loaded")
/* I need to think properly how to structure my scripts

  - Ensure I'm not looading script libraries that I don't need - how does this work with wordpreses enqueu + REST API < do my research first


  - Ensure I'm not looading scripts over and over again
  - some scripts should only load once:
    - dev tools; grids (but update via js)
    - navigations (but update via js - during browsing experience)
    - detect touch (this won't change after initial site load)
    - "start" - initial opacity / site loadng script - images loaded
  
    Other scripts
    - page /post specific

  - Only rune the barba script once!
  

*/
// not sure wwe need all the radio variable in here?
var radioscriptloaded, // set as undefined initially;//
    scsjsonobject, // new track
    activescsjsonobject, // active track
    newitemurl,
    itemurl,
    sound,
    stickyradioplayer = false; // initially false - change this variable depending on where you are on the site

jQuery(document).ready(function($) {


// RUN SITE
var app = (function() {
  var app = {
    _setEnquireMsgs: function() {
      // Media queries breakpoints
      // MQ integers
      var screenBase = 1;
      var screenoutBase = 319;
      var screenXXS = 320;
      var screenoutXXS = 639;
      var screenXS = 640;
      var screenoutXS = 1279;
      var screenSM = 1280;
      var screenoutSM = 1439;
      var screenMD = 1440; // last scss breakpoint currently
      var screenoutMD = 2879;
      var screenLG = 2880;
      var screenoutLG = 9999; // extra large number so the last media querry doesn't fall outside any screensize as it increases from 1200

      // Define media queries using MQ variables
/*
TO DO:
 update thise - make it simple - figure out first what kind of js breakpoints we acrually need
*/

      var mQueryBase = 'screen and (min-width:' + screenBase + 'px) and (max-width:' + screenoutBase + 'px)';       // query that acts as starting point: 1 and goes upto XS: 480
      var mQueryXXS = 'screen and (min-width:' + screenXXS + 'px) and (max-width:' + screenoutXXS + 'px)';           // query that acts going into XS: 480 and goes upto SM: 768
      var mQueryXS = 'screen and (min-width:' + screenXS + 'px) and (max-width:' + screenoutXS + 'px)';           // query that acts going into XS: 480 and goes upto SM: 768
      var mQueryUptoSM = 'screen and (max-width:' + screenSM + 'px)';       //query that acts going back down into XS: - 768
      var mQuerySM = 'screen and (min-width:' + screenSM + 'px) and (max-width:' + screenoutSM + 'px)';           // query that acts going into SM: 768 and goes upto MD: 992
      var mQuerySMPLUS = 'screen and (min-width:' + screenSM + 'px)';           // query that acts going into SM: 768 and goes upto MD: 992
      var mQueryMD = 'screen and (min-width:' + screenMD + 'px) and (max-width:' + screenoutMD + 'px)';           // query that acts going into MD: 992 and goes upto LG: 1200
      var mQueryLG = 'screen and (min-width:' + screenLG + 'px)';           // query that acts going into LG: 1200
   
    //START global Variables
    
    
    // END global Variables

 
    /* loading priorities - as follows
    - site is navigated to.
    - Nothing is visible
    - HTML document loads;
    - Typography loads;
    - The site become visible
    - placeholder icons (plus symbol) are there when the site becomes visible
    - as soon as the place holder images (small thumbs) are loaded, they replace the symbol
    - Once the full gifs have loaded, they replace the small place holder images.
    */


    // START global functions

      function detecttouch(){

        //https://medium.com/@david.gilbertson/the-only-way-to-detect-touch-with-javascript-7791a3346685
        // test this on IE - read the comments in the article RE issues
        //https://gist.github.com/adbario/4e33b07d618d499cd81eb691c746b47e#file-jquery-touch-detect-js
        //https://patrickhlauke.github.io/touch/tests/touch-feature-detect.html
        //https://stackoverflow.com/questions/21054126/how-to-detect-if-a-device-has-mouse-support
        //https://stackoverflow.com/questions/4817029/whats-the-best-way-to-detect-a-touch-screen-device-using-javascript
        //http://www.stucox.com/blog/you-cant-detect-a-touchscreen/

      /*  if ($(window).width() < screenXXS) { // set initial "size" state; change on resize (below)
        // if less than "one-col" - use touch version regardless
    //      $("body").removeClass('more-col').addClass('one-col');     
                  //    console.log("addClass('one-col')");

        }
        else {
      //    $("body").removeClass('one-col').addClass('more-col');  
        }*/

        if ("ontouchstart" in window)
        {

          //console.log("user can touch");
          $("body").removeClass('is-not-touch');      
          $("body").addClass('is-touch');      
          // run("touch");
          
           //https://stackoverflow.com/questions/23885255/how-to-remove-ignore-hover-css-style-on-touch-devices
          try { // prevent exception on browsers not supporting DOM styleSheets properly
                for (var si in document.styleSheets) {
                    var styleSheet = document.styleSheets[si];
                    if (!styleSheet.rules) continue;

                    for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
                        if (!styleSheet.rules[ri].selectorText) continue;

                        if (styleSheet.rules[ri].selectorText.match(':hover')) {
                            styleSheet.deleteRule(ri);
                        }
                    }
                }
            } catch (ex) {}
        
        }
        else
        {
          //console.log("user can use their mouse");
          $("body").removeClass('is-touch');      
          $("body").addClass('is-not-touch');      
         //  run("mouse");
         }// if ("ontouchstart" in window)

      }; //detect
      detecttouch(); // run functions straigh away


      function eventsview(){

         var $toggle = $(".release-view"), 
              $classtarget = $('body'); 

              $toggle.click(function(){
                   
                //   console.log("c;ciklck")                       
                  if ($classtarget.hasClass('release-list-view')){
                   

                    var $activeitem = $(".height-item.active");
 
                    $classtarget.removeClass('release-list-view');
                   $('html, body').animate({ scrollTop: $activeitem.offset().top+1});


                  } else{

                    var $activeitem = $(".height-item.active");

                   // this returns false because initially item doesn't have class untill scrolling commennces
                    
                    $classtarget.addClass('release-list-view');
                     $('html, body').animate({ scrollTop: $activeitem.offset().top});
   //                                          $(".height-item").removeClass("active").filter("[id='"+id+"']").addClass("active");



                  }; // if $('body').hasClass('dev-on')

              }); // click      

      } /* function eventsview() */

 
      function opacity(){

        //  $("body").addClass('pre-loaded');


          $("body").imagesLoaded(function(){ // consider a lazloadng options?
  

            //console.log("Images have loaded")
                  
                 function waitloading(){

                 $("body").addClass('loaded')

                 }; //waitloading()
                 setTimeout(waitloading, 200);

           }); //imagesloaded

      }; //opacity
     
  

    function orientation(){
    
    //console.log("hell-orientation")
        var winwidth = $(window).width();
        var winheight = $(window).height();
         var isHorizontal;



        if (winwidth > winheight ) {
            /* horizontal orientation */
            $("body").addClass('horizontal');

            $("body").removeClass('vertical');
        //    var isHorizontal = true;
        } else{
              /* vertical orientation */

            $("body").removeClass('horizontal');
            $("body").addClass('vertical');
         //    var isHorizontal = false;


        }//else

    } // function orientation
    orientation();

      
    function navigation(){

        var svg = document.getElementById("itoggle");
        var s = Snap(svg);

        var idot = Snap.select('#idot');
        var idotpath = Snap.select('#idot-path');

        var minus = Snap.select('#minus');

        var idotPoints = idot.node.getAttribute('d');
        var minusPoints = minus.node.getAttribute('d');
        var idotpathPoints = idotpath.node.getAttribute('d'); // this added


        var toMinus = function(){
          idot.animate({ d: minusPoints }, 100, mina.easin);  
          //console.log("toMinus")
        }

        var toIdot = function(){
          idot.animate({ d: idotpathPoints }, 100, mina.easin); 
          //console.log("toIdot shoul animate")

        } // toIdot


        var body = document.body;
        var nav = document.getElementById( 'head-nav' ), button, menu;
        if ( ! nav )
          return;
       button = nav.getElementsByClassName( 'navigation-toggle')[0];
       bgclose = nav.getElementsByClassName( 'inp-bg-close')[0]; 
 

      //  button = nav.querySelectorAll(".navigation-toggle, .inp-bg-close")
        menu   = nav.getElementsByTagName( 'ul' )[0];
        

        if ( ! button )
          return;

        // Hide button if menu is missing or empty.
        if ( ! menu || ! menu.childNodes.length ) {
          button.style.display = 'none';
          return;
        }

        
        bgclose.onclick = function toggler() {
          if ( -1 == menu.className.indexOf( 'navigation-item' ) )
            menu.className = 'navigation-item';

          if ( -1 != button.className.indexOf( ' toggled-on' ) ) {
              body.className = body.className.replace( ' toggled-on', '' );
              button.className = button.className.replace( ' toggled-on', '' );
              menu.className = menu.className.replace( ' toggled-on', '' );

              toIdot();          
            
          } else {

              body.className += ' toggled-on';
              button.className += ' toggled-on';
              menu.className += ' toggled-on';

              toMinus();
                                 
          } // if

        }; // we're essetnially repeating two functions - not very neat

        button.onclick = function toggler() {
          if ( -1 == menu.className.indexOf( 'navigation-item' ) )
            menu.className = 'navigation-item';

          if ( -1 != button.className.indexOf( ' toggled-on' ) ) {
              body.className = body.className.replace( ' toggled-on', '' );
              button.className = button.className.replace( ' toggled-on', '' );
              menu.className = menu.className.replace( ' toggled-on', '' );

              toIdot();          
            
          } else {

              body.className += ' toggled-on';
              button.className += ' toggled-on';
              menu.className += ' toggled-on';

              toMinus();
                                 
          } // if

        };


        if  ($('.navigation-toggle').hasClass('toggled-on')){
          //  console.log('if navigation was previously on - turn it off');
          //  $('body').addClass('toggled-on'); // because this was previously on
         
               body.className = body.className.replace( ' toggled-on', '' );
               button.className = button.className.replace( ' toggled-on', '' );
               menu.className = menu.className.replace( ' toggled-on', '' );
        
                idot.animate({ d: idotpathPoints }, 100, mina.easin); 
        //        console.log("toIdot shoul animate")

          } //if has class

    } /* navigation() */ 
 
    navigation();


    function recordcircle(){

      console.log("each recordcircle");

        $(".record-circle-container").each(function() {
        //  console.log("eachrecord container")

          var $thiscontainer = $(this),
              $thiscircle = $(this).find(".record-circle");
              $thiscontainer.removeClass("active","rotating","rotated");// incase its active still - seems to be some buggy behavior atm
              $thiscircle.removeClass("rotating");// in an effort to reset?

              $thiscontainer.css("pointer-events","initial");// allow pointer events now that the js is ready

              //console.log('just remove classes');

            $thiscircle.hover(function() {
          //$thiscircle.mouseover(function() {
              if($thiscircle.hasClass("rotating")){
            console.log("has class rotatting")

             /* $thiscircle.removeClass("rotating"); 
              $thiscircle.toggleClass("rotate");
              $thiscontainer.toggleClass("active");
*/
              $thiscircle.removeClass("rotating"); 
              $thiscircle.removeClass("rotate");
              $thiscontainer.removeClass("active");

            } else {
            console.log("DOES NOT have class rotatting")

               $thiscircle.addClass("rotating");
               $thiscircle.addClass("rotate");
               $thiscontainer.addClass("active");

            } // if

          }); // hover

        }); // each $(".record-circle")

    } // function recordscircle


    function gallery($block){
      //https://flickity.metafizzy.co/options.html
    console.log("gallery function");

      var $thisgallery = $block.find(".gallery-carousel");      

       $thisgallery.flickity({
            imagesLoaded: true, 
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

    } // function gallery($block)

/*


<svg width="52px" height="75px" viewBox="0 0 52 75" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 51.3 (57544) - http://www.bohemiancoding.com/sketch -->
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Back-Arrow" transform="translate(-24.000000, -13.000000)" fill="#FFFFFF" fill-rule="nonzero">
            <polygon id="Path-2" transform="translate(49.757615, 50.207777) rotate(-270.000000) translate(-49.757615, -50.207777) " points="82.9312793 24.4501626 86.9653917 27.5504528 49.7576146 75.9653917 12.5498374 27.5504528 16.5839498 24.4501626 49.7576146 67.615895"></polygon>
        </g>
    </g>
</svg>
*/

/* - moved to radio script
    function initheadroom(){

        if ($(".sc-player").length){
        

        console.log(".sc-player exists")

             $(".sc-player").headroom({
                "offset": 205,
                "tolerance": 5,
                "classes": {
                  "initial": "animated",
                  "pinned": "slideDown",
                  "unpinned": "slideUp"
                }
              });

        } else {
        console.log(".radio container doesn't exist");
        }

    } // function initheadroom()



    function destroyheadroom(){
      // to destroy
      $(".sc-player").headroom("destroy");

    }// destroyheadroom()

*/

// END global functions

// add script for reasize of 
 
       
    function start(){


      //console.log("function start()")
 
    //  setTimeout(typesystem, 2000);  // start type: system
       
    opacity(); // turn on visibility

    };
    setTimeout(start,0); //added a time outfunction; because of fonts need loading first?
                   

      //
      //
      //
      // 'selector' media query

      $(function () // on document.ready()
            {


               // START DEV GRID - TOGGLE
                  if ($('body').length > 0) 
                  {
          
                  var $toggle = $(".dev-toggle"), 
                      $classtarget = $('body'); 

                      $toggle.click(function(){
                                                  
                          if ($classtarget.hasClass('dev-on')){
                              
                            $classtarget.removeClass('dev-on');

                          } else{

                            $classtarget.addClass('dev-on');

                          }; // if $('body').hasClass('dev-on')


                      }); // click      


                      var rtimedev;
                      var timeoutdev = false;
                      var deltadev = 200;
                      $(window).resize(function() {
                          rtimedev = new Date();
                          if (timeoutdev === false) {
                              timeoutdev = true;
                              setTimeout(resizeenddev, deltadev);
                          }
                      });
                    
                      function resizeenddev() {
                        
                          if (new Date() - rtimedev < deltadev) {
                              setTimeout(resizeenddev, deltadev);
                          } else {
                              timeoutdev = false;
                            var windowheight = $(window).height();
                             //console.log("this working dev?")
                              orientation(); //vertical or horizontal

                          }   //else    

                       };//resizeend fucntion
                  
                   /* function start(){
                    } setTimeout(start, 1); //added a time outfunction; because of fonts need loading first
                    */






                 /*
                 body
                 */

                };  



                //END DEV GRID - TOGGLE


      if ($('.radio-container').length > 0) 
      {

      // console.log(".radio-container")

          if ($('body').hasClass("_single-radio") || $('body').hasClass("_post-type-archive-radio")){  // if single radio & archive aswell 
            
            // review this do we need different rules for single and archive? - atm just addng sticky radio player to everything
        

              $(window).scroll(function(){ // attach docment scroll, for "sticky player"
         

                /* so what we want is as follows:
                when player at top of screen - apply class
                */

                var controls = $('.sc-controls').height(),
                sceneheight = $('.radio-container').height(),
                calcheight = (sceneheight/2) - (0.5 *controls);

                if ($(window).scrollTop() > calcheight){


                 // console.log("hello - should be at top of controls");
                  $('body').addClass("sticky-radio-player");
      
                 //         stickyradioplayer == false;

                }else{

                  //console.log("radio player not controls");
                  $('body').removeClass("sticky-radio-player");
              //   stickyradioplayer == false;

                }


              }); // scroll function


          } else {// if not single radio - apply sticky radio player class regardless

            // What about the news post blcocks - currently the top player dissapears?

              //     console.log("body does NOT have single radio class=");

           $('body').addClass("sticky-radio-player");


          } // if single radio

         
       /*
       .radio-container
       */

      };  

      /* end - animation of radio nav */



            if ($('body.single-artists, body.single-news').length > 0) 
            {
                        
            // console.log("if ($('body.single-artist').length > 0)");


                 if ($('#artist-releases, .release-block').length > 0) 
                  {
            
                   //  console.log('recordcircle');
                 //setTimeout(function(){

                  // takes to long to reach the js - so do we just ensure the items have no pointer events initially?

                             recordcircle();// this needs to trigger other stuff like resiae as well I guess?
                //}, 2000);

                };  /*  #artist-releases  */
                  
                if ($('.gallery-block').length > 0) 
                {
                  console.log("if gallery-block");

                  var $thisblock = $(this);  
                  console.log($thisblock);

                  gallery($thisblock);// run js if gallery item exist

                };// .gallery-block
             

             /*
             body.single-artists,  body.single-news
             */

            };  








           if ($('body.post-type-archive-releases').length > 0) 
            {
                     
 
            eventsview();// this needs to trigger other stuff like resiae as well I guess?



                 // console.log('body.post-type-archive-releases');

           
           function activecarousel(){
                  

                  /*
                   deconstruct this code 

                   +

                  - apply resizing to the widht and heights on re re-size
                  - rename items so its look like I havent robbed it
                  - set values based on the amount of post available
                  - lazy load on items?


                  - have a flip options - to reveal the back, either on click or/and hover

                  */

                  var lastId,

                  carousel = document.querySelector('.carousel'),
                  cells = carousel.querySelectorAll('.carousel__cell'),
                  //console.log( "cells" + cells+"" );
                  cellItems = $(".carousel").find(".carousel__cell"),
                  cellCount, // cellCount set from cells-range input value
                  selectedIndex = 0,
                  cellWidth = carousel.offsetWidth, // this should be a responsive value
                  cellHeight = carousel.offsetHeight; // this should be a responsive value

                //  orientation(); // run orientation - what class  (not sure if this has to be called here?)

                  if ($('body').hasClass('horizontal')){
                   var isHorizontal = true; 
                   //console.log('IsHorizontal')
                     }else{
                   var isHorizontal = false;
                   //console.log('NOT IsHorizontal')
                  }; 

                 //  isHorizontal = true, // should be based on the class; vert of horizontal oreination
                  var rotateFn = isHorizontal ? 'rotateY' : 'rotateX',
                  radius, 
                  theta,
                  angle,
                  $sceneheight = $(".scene-height"),
                  $heightitem = $(".height-item"),
                  sceneheight = $sceneheight.outerHeight(), // if have 100vh per item - This includes a negative offset
                 // sceneheigtItems = $sceneheight.length;
                  sceneheigtItems = $heightitem.length, // total itemss
                  itemheight = $heightitem.outerHeight(),
                  totalangle = 360,
                  anglesegment = totalangle / sceneheigtItems,
                  heightItems = $sceneheight.find(".height-item");
                  //console.log("selectedIndex" + selectedIndex + ""),

                  scrollItems = cellItems.map(function(){
                      var identity = $(this).attr("id"); //release-$$$
                      var item = $('.height-item').filter("[data-active-item='"+identity+"']");
                      //console.log(item);

                      if (item.length) { return item; 
                      }

                  }); //scrollItems function

                //  console.log("sceneheigtItems" + sceneheigtItems + "");


             /*   function rotateCarousel() {
                  console.log("set rules?");
 
                  //    var angle = theta * selectedIndex * -1;
                  //  carousel.style.transform = 'translateZ(' + -radius + 'px) ' + 
                   // rotateFn + '(' + angle + 'deg)';
                
                }; 
*/
               // rotateCarousel(); //as part of prevous fucntions
  
                carousel.style.transform = 'translateZ(-720px)' + rotateFn + '(0deg)';// initial valuse
                // change opacity here



               //  carousel.style.transform = 'translateZ(' + -radius + 'px) ' + rotateFn + '(' + angle + 'deg)';
            //  console.log("Now"),

               setTimeout(function() {

               var y = $(window).scrollTop();  //your current y position on the page
               $(window).scrollTop(y+1); // this ensure the carousell aligns up with the current page position

               $(".scene").addClass("loaded");
             //  console.log("class added")
               }, 750);
               
              $(window).scroll(function(){ // attach docment scroll to rotating carousel 
           

/* so what we want is as follows:

10 items // x items
each 100vh scrolling space 


360 degrees = full rotation during the scrolling of 1000vh 

*/     


/* i ndeed to have two scroll rations

so when once is active the position changes - like a paralex thing

*/

                  var halfheight = ($('.height-item').height()/2),
                  sceneheight = $('.scene-height').height(),

                  calcheight = sceneheight - (2* halfheight);

                  if ($(window).scrollTop() > calcheight){

 

                    // last active
                     $('.height-item:last-child').addClass('last-end')

                    } else{
                     // not last active
                      $('.height-item:last-child').removeClass('last-end')
                    }

                       // selectedIndex--;

                      //var hT = $('#scroll-to').offset().top,
                      // hH = $('#scroll-to').outerHeight(),
                     //  wH = $(window).height(), 
                       fromTop = $(this).scrollTop()
                       halffromBottomitem = $(".height-item:last-child").scrollTop()
                     
                       //console.log("fromTop here" + fromTop +"" );
                      //  $('.scene-height')
                       // wS = $(this).scrollTop() / sceneheight / ;

                       //angle / fromTop / scen
                       ratio = sceneheight / totalangle; //ratio per degree
                        
                        //console.log("ratio" + ratio + "");

                        wS = fromTop / ratio;
                        
                        // console.log("wS" + wS + "");
                         // var radius = wS;
                          // ( sceneheight / totalangle )

                                           //   var angle = theta * selectedIndex * -1;
                  // var angle = -anglesegment * wS;


                        var angle = - wS;////+ anglesegment);

                       //                                 console.log("angle" + angle + "");
                     //  console.log("(totalangle - anglesegment)" + (totalangle - anglesegment) + "");

                        if ( angle > ((totalangle - anglesegment)*-1) ) { // only roate as far as the total angle - one segment -- currently a negative value
                        
                        carousel.style.transform = 'translateZ(' + -radius + 'px) ' + rotateFn + '(' + angle + 'deg)';
                       //$(".description-wrap").css("margin-top",-wS);

                        }
                             
                    //if( $(this).scrollTop() >= $('#target_element').position().top ){
                    //    do_something();
                   // }
/*
   $(".height-item").each(function(i) {
        if ($(this).position().top < fromTop) {
            var thisid = $(this).attr("id");
          //  console.log("thisid"+thisid+"");
            $(".height-item").removeClass('active');
            $(".carousel__cell").removeClass('active');
            $(".scene").find($("#release-"+thisid+"")).addClass('active')
            $(this).addClass('active');
              console.log("lastId= "+lastId+"");

               if (lastId !== thisid) {
                  lastId = thisid;
          console.log("still same id?");
                }




        }
    });

*/
                       // Get id of current scroll item
                  var cur = scrollItems.map(function(){
                     if ($(this).offset().top < (fromTop + (itemheight/2)))
                       return this;
                      // console.log('this one '+this+'fromTop' +fromTop+'');


                   });

                   // Get the id of the current element
                   cur = cur[cur.length-1];
                   // console.log('cur'+cur+'');
                   var id = cur && cur.length ? cur[0].id : "";
                   //   console.log('current id ='+id+'');
                   
                   if (lastId !== id) {
                       lastId = id;

                      // this logs the id of the active item
                     // console.log('id ='+id+'');
                     // Remove + Set active class - on items

                      $(".height-item").removeClass("active").filter("[id='"+id+"']").addClass("active");
                      thisattr = $(".height-item").filter("[id='"+id+"']").attr("data-active-item");
                      $(".carousel__cell").removeClass("active").filter("[id='"+thisattr+"']").addClass("active");
                      $(".height-item").removeClass("prev-active");
                      $(".height-item.active").prevAll().addClass("prev-active");

                 
                    }; // if 


                }); // scroll function


/*
                  var prevButton = document.querySelector('.previous-button');
                  prevButton.addEventListener( 'click', function() {
                    selectedIndex--;
                    console.log("selectedIndex" + selectedIndex + "");

                  if (!$(".carousel__cell").hasClass("active")) {
                   

                    $(".carousel").find(".carousel__cell:last-child").addClass('active');// if it doesn't have class anywhere yet- add one to first item

                   
                     } else{ // else we start changing classes base on the currently active one

                     var $thisitem = $( ".carousel__cell.active" );
                         $nextactivechild = $thisitem.prev();
                    
                          if($thisitem.is(':first-child')){
                            console.log('helo firstve');
                            $(".carousel").find(".carousel__cell:last-child").addClass('active');// if it doesn't have class anywhere yet- add one to first item

                          }else{
                            
                            $nextactivechild.addClass('active');
                          
                          }// last item?

                         $thisitem.removeClass('active')// remove existing class

                   
                    console.log('has Active');
                    //.addClass("active")

                    } // cell active

                    rotateCarousel();
                  });

*/
/*
                  var nextButton = document.querySelector('.next-button');
                  nextButton.addEventListener( 'click', function() {
                    selectedIndex++;
                    console.log("selectedIndex" + selectedIndex + "");

                  if (!$(".carousel__cell").hasClass("active")) {
                   

                    $(".carousel").find(".carousel__cell:first-child").next().addClass('active');// if it doesn't have class anywhere yet- add one to first item

                   
                     } else{ // else we start changing classes base on the currently active one

                     var $thisitem = $( ".carousel__cell.active" );
                         $nextactivechild = $thisitem.next();
                    
                          if($thisitem.is(':last-child')){
                            console.log('helo firstve');
                            $(".carousel").find(".carousel__cell:first-child").addClass('active');// if it doesn't have class anywhere yet- add one to first item

                          }else{
                            
                            $nextactivechild.addClass('active');
                          
                          }// last item?

                         $thisitem.removeClass('active')// remove existing class

                   
                    //console.log('has Active');
                    //.addClass("active")

                    } // cell active

                    rotateCarousel();
                  });
*/
               //   var cellsRange = document.querySelector('.cells-range');
               //   cellsRange.addEventListener( 'change', changeCarousel );
               //   cellsRange.addEventListener( 'input', changeCarousel );

//window.addEventListener("resize", onOrientationChange); // I shoudl place this functiun elsewhber? -


                  function changeCarousel() { // this function  resizes everythinging
                  
                   console.log("changeCarousel function");

                     /* new var for resize*/
                    carousel = document.querySelector('.carousel'),

                    cellWidth = carousel.offsetWidth, // this should be a responsive value
                    cellHeight = carousel.offsetHeight; // this should be a responsive value
                     /* new var for resize*/

                    cellCount = sceneheigtItems; //total items vas input//cellsRange.value; // this value should be from number of posts
                    theta = 360 / cellCount;
                    var cellSize = isHorizontal ? cellWidth : cellHeight;
                    radius = Math.round( ( cellSize / 2) / Math.tan( Math.PI / cellCount ) );
                    for ( var i=0; i < cells.length; i++ ) {
                      var cell = cells[i];
                      if ( i < cellCount ) {
                        // visible cell
                        cell.style.opacity = 1;
                        var cellAngle = theta * i;
                        cell.style.transform = rotateFn + '(' + cellAngle + 'deg) translateZ(' + radius + 'px)';
                      } else {
                        // hidden cell
                        cell.style.opacity = 0;
                        cell.style.transform = 'none';
                      }
                    }

                   // rotateCarousel();
                  }

               /*   var orientationRadios = document.querySelectorAll('input[name="orientation"]');
                  ( function() {
                    for ( var i=0; i < orientationRadios.length; i++ ) {
                      var radio = orientationRadios[i];
                      radio.addEventListener( 'change', onOrientationChange );
                    }
                  })();*/

                  function onOrientationChange() {
                  //  var checkedRadio = document.querySelector('input[name="orientation"]:checked');
                    
                       if ($('body').hasClass('horizontal')){
                         var isHorizontal = true; 
                        // console.log('IsHorizontal')
                           }else{
                         var isHorizontal = false;
                        // console.log('NOT IsHorizontal')

                        }; 

                    //  isHorizontal = checkedRadio.value == 'horizontal';

                        //console.log("isHorizontal = "+isHorizontal+"");
                        rotateFn = isHorizontal ? 'rotateY' : 'rotateX';
                        changeCarousel();

                  } // onOrientationChange
                  
                /*  function screenOrientationChange() {
                    var checkedRadio = document.querySelector('input[name="orientation"]:checked');
                    isHorizontal = checkedRadio.value == 'horizontal';
                    rotateFn = isHorizontal ? 'rotateY' : 'rotateX';
                    changeCarousel();
                  }
*/
                  // set initials
                  onOrientationChange();



// change on resize
                      var rtime;
                      var timeout = false;
                      var delta = 200;
                      $(window).resize(function() {
                          rtime = new Date();
                          if (timeout === false) {
                              timeout = true;
                              setTimeout(resizeend, delta);
                           //console.log("herleo")

                          }


                      });
                    
                      function resizeend() {
                                                  //  console.log("resize iniit");

                          if (new Date() - rtime < delta) {
                              setTimeout(resizeend, delta);
                          } else {
                              timeout = false;
                            var windowheight = $(window).height();
                         // changeCarousel();
                          
                             onOrientationChange();

//                          console.log("resize iniit");
                            //  orientation(); //vertical or horizontal

                          }   //else    

                       };//resizeend fucntion

// //end resize








        }; // activecarousel
         activecarousel();
      // $(window).scrollBy(1,0);


                                          






                 /*
                 body.post-type-archive-releases
                 */

                };  
                     
 
                if ($('body.post-type-archive-artists').length > 0)  
                {
          

                  var $container = $('.container');
                    
                    $('.list-item').hover(function(){
                    
                     var listitemid = $(this).attr('data-imgid');

                    $(this).toggleClass('active')      
                    $('.image-item[data-image="'+listitemid+'"]').toggleClass('active');
                          
                        //  $(".image-item[data-img=listitemid]").toggleClass('active');
                        }); // hover
                    
                    
                    $('.list-item').click(function(){
                      
                      
                        var listitemid = $(this).attr('data-imgid'),
                            listitemcontent = $(this).text();
                        console.log(listitemcontent)
                        
                        $container.addClass('activated');
                        $(this).addClass('activated')
                        
                        $('.image-item[data-image="'+listitemid+'"]').toggleClass('activated');
                        $('.page-title').animate({
                        opacity: 0
                      }, 800, function() {
                        // Animation complete - fade back in
                        $('.page-title').text(listitemcontent).animate({
                        opacity: 1
                        }, 400, function() {
                            // Animation complete.
                        });      

                      });      
                      
                   });      
  
                   /*
                   body.post-type-archive-artists
                   */

                  };


               
                     

      }); // END  Media queries function class - selectors
 
 

      //
      //
      //
      // 'screenBase' media query 1 - 319

      enquire.register(mQueryBase, function() {
      
            $(function () // on document.ready()
            {
                if ($('body').length > 0)
                {

               // console.log("base 1 - 319 ")
     
                }
            });
 
            /* body */

      });  // END screenBase

  
    // END queries

    },

    init: function() {
      this._setEnquireMsgs();
    }
  };

  return app;

}());


app.init(); // initial initiation

}); ///  ENDS  read.QUERY



       

