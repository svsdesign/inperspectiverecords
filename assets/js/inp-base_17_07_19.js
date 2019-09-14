/**
 *
 * Inperspective Records
 * 2018
 * Author: Simon van Stipriaan
 * http://svs.design 
 * 
 * inp-base.js - handles the serving up of scripts for the entire website
 */


/* I need to thinkg properly how to structure my scripts

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
var radioscriptloaded, // set as undefined initially;//
    scsjsonobject, // new track
    activescsjsonobject, // active track
    newitemurl,
    itemurl,
    sound;

var stickyradioplayer = false; // initially false - change this variable depending on where you are on the site

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
                   
                   console.log("c;ciklck")                       
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

      //console.log("nav function")
      
          /**
           * navigation.js
           *
           * Handles toggling the navigation menu for small screens.
           
          TO DO - tidy this file up - remove vars that aren't needed



           */

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
        console.log("toMinus")
      }

      var toIdot = function(){
        idot.animate({ d: idotpathPoints }, 100, mina.easin); 
              console.log("toIdot shoul animate")

      }


     // toIdot();




 
          //  var trigger_home = document.getElementById("trigger_home");
          // var trigger_menu = document.getElementById("trigger_menu");
              
          //    var toptriggerLine = document.getElementById("top_line");
          //    var trigger_top_Line = document.getElementById("trigger_top_line");


          //    var middletriggerLine = document.getElementById("middle_line");
          //    var bottomtriggerLine = document.getElementById("bottom_line");
          //   var arrowmask = document.getElementById("arrowmask");

           
            var body = document.body;
            var nav = document.getElementById( 'head-nav' ), button, menu;
            if ( ! nav )
              return;
            button = nav.getElementsByClassName( 'navigation-toggle' )[0];
            menu   = nav.getElementsByTagName( 'ul' )[0];
            


            
            
            if ( ! button )
              return;

            // Hide button if menu is missing or empty.
            if ( ! menu || ! menu.childNodes.length ) {
              button.style.display = 'none';
              return;
            }

            button.onclick = function toggler() {
              if ( -1 == menu.className.indexOf( 'navigation-item' ) )
                menu.className = 'navigation-item';

              if ( -1 != button.className.indexOf( ' toggled-on' ) ) {
                body.className = body.className.replace( ' toggled-on', '' );
                button.className = button.className.replace( ' toggled-on', '' );
                menu.className = menu.className.replace( ' toggled-on', '' );

                toIdot();
              
            //    trigger_menu.beginElement();
            //    trigger_home.beginElement();

                //trigger_top_Line.beginElement();

             //   $('.home-icon').removeClass('on');
            //  $('#main').removeClass('on');
             //   $('#headfix').removeClass('on');

            //   $('.head-holder').css({ "background-color": "red" }); // fix for mobiles; hover state

              //      arrowmask.setAttribute("d", "M2.436,11.605L10,4.04l7.557,7.558l0,0c0.002,0.001,0.003,0.003,0.003,0.004 c0.559,0.558,1.464,0.558,2.021,0c0.559-0.559,0.559-1.464,0-2.021c-0.002-0.001-0.004-0.003-0.005-0.003h0.001l-9.573-9.575L10,0 L9.995,0.003L0.415,9.585l0,0c-0.554,0.557-0.552,1.459,0.003,2.016C0.975,12.157,1.877,12.159,2.436,11.605z");
              //  arrowmask.beginElement()

              //  setheightattr();
              //  totalhome();

              //        toptriggerLine.setAttribute("d", "M50,3.571C50,1.604,48.408,0.008,46.442,0l0,0H3.586l0,0C3.58,0,3.576,0,3.571,0C1.599,0,0,1.599,0,3.571 s1.599,3.571,3.571,3.571c0.005,0,0.009,0,0.015,0l0,0h42.856l0,0C48.408,7.135,50,5.539,50,3.571z");

              //        middletriggerLine.setAttribute("d", "M50,25c0-1.968-1.592-3.563-3.558-3.571l0,0H3.586l0,0c-0.006,0-0.01,0-0.015,0C1.599,21.429,0,23.027,0,25 s1.599,3.571,3.571,3.571c0.005,0,0.009,0,0.015,0l0,0h42.856l0,0C48.408,28.563,50,26.968,50,25z");

             //         bottomtriggerLine.setAttribute("d", "M50,46.429c0-1.968-1.592-3.563-3.558-3.571l0,0H3.586l0,0c-0.006,0-0.01,0-0.015,0C1.599,42.857,0,44.456,0,46.429 C0,48.4,1.599,50,3.571,50c0.005,0,0.009,0,0.015,0l0,0h42.856l0,0C48.408,49.992,50,48.396,50,46.429z");
                  ////http://webbugtrack.blogspot.co.uk/2007/08/bug-242-setattribute-doesnt-always-work.html  
              
                
              } else {
                body.className += ' toggled-on';
                button.className += ' toggled-on';
                menu.className += ' toggled-on';

                toMinus();
                
            //    trigger_menu.beginElement();
              //  trigger_home.beginElement();

              //  trigger_top_Line.beginElement();

             /*   $('.home-icon').addClass('on');
                $('#main').addClass('on');
                $('#headfix').addClass('on');

                      arrowmask.setAttribute("d", "M17.564,11.374L10,18.939l-7.557-7.558l0,0C2.441,11.38,2.44,11.378,2.44,11.377 c-0.559-0.558-1.464-0.558-2.021,0c-0.559,0.558-0.559,1.462,0,2.021c0.002,0,0.004,0.002,0.005,0.002H0.423l9.572,9.574L10,22.979 l0.005-0.004l9.581-9.582l0,0c0.554-0.557,0.552-1.459-0.003-2.015C19.025,10.821,18.123,10.819,17.564,11.374z");
              //        arrowmask.beginElement()
*/
              //  setheightattr();
              //  totalhome();

              
            //    trigger_menu.setAttribute("from", "0 25 25");
               //       trigger_menu.setAttribute("to", "90 25 25");  

            //    trigger_home.setAttribute("from", "0 25 25");
              //        trigger_home.setAttribute("to", "90 25 25");


              //    toptriggerLine.setAttribute("d", "M1.046,48.954c1.392,1.392,3.646,1.395,5.041,0.009v0.001L48.944,6.106h-0.001c0.004-0.003,0.007-0.007,0.011-0.01 c1.395-1.395,1.395-3.656,0-5.051s-3.656-1.395-5.051,0c-0.004,0.003-0.007,0.007-0.01,0.011V1.056L1.036,43.913l0,0  C-0.349,45.309-0.346,47.562,1.046,48.954z");


              //    middletriggerLine.setAttribute("d", "M28.558,25c0-1.968-1.592-3.563-3.558-3.571l0,0l0,0l0,0c-0.006,0-0.01,0-0.015,0c-1.973,0-3.571,1.599-3.571,3.571 s1.599,3.571,3.571,3.571c0.005,0,0.009,0,0.015,0l0,0l0,0l0,0C26.966,28.563,28.558,26.968,28.558,25z");

              //    bottomtriggerLine.setAttribute("d", "M48.954,48.954c1.392-1.392,1.395-3.646,0.01-5.041l0,0L6.106,1.056v0.001C6.104,1.053,6.1,1.049,6.097,1.046 c-1.395-1.395-3.656-1.395-5.051,0s-1.395,3.656,0,5.051C1.049,6.1,1.053,6.104,1.057,6.106H1.056l42.857,42.857v-0.001 C45.309,50.349,47.562,50.346,48.954,48.954z");


             

                    
              }



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

          $(".record-circle-container").each(function() {
          //  console.log("eachrecord container")

            var $thiscontainer = $(this),
                $thiscircle = $(this).find(".record-circle");
            
            $thiscircle.hover(function() {
            
              if( $thiscircle.hasClass("rotating")){

                $thiscircle.removeClass("rotating"); 
                $thiscircle.toggleClass("rotate");
                $thiscontainer.toggleClass("active")

              } else {

                 $thiscircle.addClass("rotating");
                 $thiscircle.toggleClass("rotate");
                 $thiscontainer.toggleClass("active")


              } // if

            }); // hover

          }); // each $(".record-circle")

       } // function recordscircle

       /*
        function radioloader(){
           $.getScript( "http://localhost:8888/inp-wp/wp-content/themes/inperspectiverecords/assets/js/inp-radio_v3.js", function( data, textStatus, jqxhr ) {
                              //        console.log( data ); // Data returned
                              //        console.log( textStatus ); // Success
                              //        console.log( jqxhr.status ); // 200
                          
                                });
           console.log('radioloader < not used atm?')
        }
      */
      //radioloader();// load only once

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





               // START SELECTORS:




                if ($('body.home').length > 0) 
                {
          

                        

                 /*
                 body.home
                 */

                };  



  // not sure this is the place
  console.log("radioscriptloaded out side if stat"+radioscriptloaded+"" )
  console.log("Tidy this fucking mess up - probably half of this code not needed?" )

    if (typeof radioscriptloaded === 'undefined') { // if undefined we want to set up the radio      
 
        if ($('body.single-radio').length > 0) { //- but only if we have a radio

          radioscriptloaded = true;  // now defined
          newitemurl = $('#show-details').data("radio-link");
          console.log("new url item ="+newitemurl+"")
          console.log("existing url item ="+itemurl+"")


            if (typeof itemurl === 'undefined') { // if object not defined yet.
              
                      // if not defined yet, we need to find the scsjonobject
                      // and hecause we are on a single radio page, there should the first available data attribute
//                      itemurl = $('#radio-code').data("url");
                      itemurl = $('#show-details').data("radio-link");

                      console.log("itemurl ="+itemurl+"")

                        SC.initialize({
                          client_id: '853fdb79a14a9ed748ec9fe482e859dd' // who'is this client ID?
                      });


                      function reload_js(src) {                                

                         $('<script>').attr('src', src).appendTo('head'); // append the script for the first time?
                         //console.log("body.single-radio > this src = " + src + "");

                      } // function reload_js(src)

                      // run this only once? - but what if updating tracklist etc? Sure would have to ensure there are global.variabels in place?
                      reload_js('http://localhost:8888/inp-wp/wp-content/themes/inperspectiverecords/assets/js/inp-radio_v3.js'); 
                      // do I maybe reload - yet pass in unique id of the currently desirably radio show?

                      // permalink to a track
                      var track_url = itemurl//feedsclink;

                      var myCustomFunction = function (track) {

                       console.log("my custom funcion new track id" + track.id +"" ); // track.id gives you the ID of the song
                      //  console.log("track id" + track.id +"" ); // track.id gives you the ID of the song
                        var settrackid = track.id;
                       // $('body').data("scjson", settrackid); // set id to body data
                        $('body').attr("data-scjson", settrackid); // set id to body data

                       // @TODO
                      // Do something with the song ID
                        var link = "tracks/"+settrackid+"";

                          console.log("link" +link+"")

                  /*   function playIt(){
                        //console.log("playit")
                                 sound = SC.stream(link, function(sound){
                                  console.log("sound" + sound +"");
                                  sound.play();
                              });
                        }
                       //   playIt();
                      $(".radio-container").click(function() {
                        console.log('clicking')
                  //    playIt();

                                    sound = SC.stream(link, function(sound){
                                  console.log("sound" + sound +"");
                                  sound.play();
                              });

                      }); */



                      };

                      SC.resolve(track_url).then(myCustomFunction);

               // console.log('scsjsonobject'+scsjsonobject+"");

            } else if (newitemurl === itemurl) { //

               console.log('itemurl'+itemurl+"");
               console.log('itemurl'+newitemurl+"");
               console.log("this means the new page is the currently active item - not sure this is ever going to be the case ");
               // so i don't want to change the newitemurl or itemurl

          
            } else { // if alredy defined
               console.log("this means the new page is not the currently active item - not sure this is ever going to be tbe case?")
               itemurl = $('#show-details').data("radio-link");

            //    console.log(' radioscriptloaded should be true;  '+radioscriptloaded+"");
           //     console.log('active scsjsonobject'+activescsjsonobject+"");
            //    console.log('scsjsonobject'+scsjsonobject+"");

            }// if 



        // .single radio      
        } else if ($('body').length > 0) {

         console.log('if $body  - scsjsonobject'+scsjsonobject+" no reason to specify this if statment?");

        };  // if body or radio class


    } else { // if the radio script already defined:

      console.log("if the scrip already defined, why would I reload the inp-radio_v3 script?")

         if ($('body.single-radio').length > 0) { //- but only if we have a radio

        radioscriptloaded = true;  // now defined
        newitemurl = $('#show-details').data("radio-link");
        console.log("new url item ="+newitemurl+"")
        console.log("existing url item ="+itemurl+"")


            if (typeof itemurl === 'undefined') { // if object not defined yet.
              
              console.log("not sure this is possible - so remove?")
                      // if not defined yet, we need to find the scsjonobject
                      // and hecause we are on a single radio page, there should the first available data attribute
//                      itemurl = $('#radio-code').data("url");
                      itemurl = $('#show-details').data("radio-link");

                     // console.log("itemurl ="+itemurl+"")

                        SC.initialize({
                          client_id: '853fdb79a14a9ed748ec9fe482e859dd'
                      });

                      // permalink to a track
                      var track_url = itemurl//feedsclink;

                      var myCustomFunction = function (track) {

                        console.log("my custom funcion new track id" + track.id +"" ); // track.id gives you the ID of the song
                      //  console.log("track id" + track.id +"" ); // track.id gives you the ID of the song
                        var settrackid = track.id;
                       // $('body').data("scjson", settrackid); // set id to body data
                        $('body').attr("data-scjson", settrackid); // set id to body data

                      // @TODO
                      // Do something with the song ID
                      };

                      SC.resolve(track_url).then(myCustomFunction);

                 /*   IO don't want to reload the inp radio script

                   function reload_js(src) {                                

                         $('<script>').attr('src', src).appendTo('head'); // append the script for the first time?
                         //console.log("body.single-radio > this src = " + src + "");

                      } // function reload_js(src)

                      // run this only once? - but what if updating tracklist etc? Sure would have to ensure there are global.variabels in place?
                      reload_js('https://localhost:8888/inp-wp/wp-content/themes/inperspectiverecords/assets/js/inp-radio_v3.js'); 
                      // do I maybe reload - yet pass in unique id of the currently desirably radio show?
                    */

               // console.log('scsjsonobject'+scsjsonobject+"");

             } else if (newitemurl === itemurl) { //

               console.log('itemurl'+itemurl+"");
               console.log('itemurl'+newitemurl+"");
               console.log("this means the new page is the currently active item - so no need to loads or change anything?");
               // so i don't want to change the newitemurl or itemurl

          
            } else { // if the urls don't match; we need to load in the new item
               console.log("this means the new page is not the currently active item - so we should update the track? - but only if clicked?")
               itemurl = $('#show-details').data("radio-link");


                  //lets delete the existing script
                 /*   function removeandadd_js(src) {   

                       $('<script>').attr('src', src).remove();
                       console.log("script removed" +src +"");
                       $('<script>').attr('src', src).appendTo('head'); // append the script for the first time?

                      }
                    removeandadd_js('https://connect.soundcloud.com/sdk/sdk-3.3.0.js'); 
                    removeandadd_js('http://localhost:8888/inp-wp/wp-content/themes/inperspectiverecords/assets/js/inp-radio_v3.js'); 
*/
                      // SC.initialize({
                      //    client_id: '853fdb79a14a9ed748ec9fe482e859dd'
                      //});

                    
                     // $('.radio-container').append('<a href="https://soundcloud.com/matas/hobnotropic" class="sc-player"></a>');
 
         
                                     // permalink to a track
                    var track_url = itemurl//feedsclink;
                      console.log("track_url" + track_url +"" ); // track.id gives you the ID of the song

                    var myCustomFunction = function (track) {

                      console.log("track" + track +"" ); // track.id gives you the ID of the song

                      console.log("my custom funcion new track id" + track.id +"" ); // track.id gives you the ID of the song
                      //  console.log("track id" + track.id +"" ); // track.id gives you the ID of the song
                        var settrackid = track.id;
                      //  $('body').data("scjson", settrackid); // set id to body data
                        $('body').attr("data-scjson", settrackid); // set id to body data
                     //   player.pause();
                      //  player.play(settrackid)
                    //  $('.sc-player').pause();
 
 

//  $.scPlayer


/*SC.sound.pause();
SC.sound.stop();
SC.sound.pause();
SC.sound.playState;
*/
                    // @TODO
                    // Do something with the song ID

                   // SC.play(settrackid);



                    };

                   SC.resolve(track_url).then(myCustomFunction);
                  //   // SC.play(track_url).then(myCustomFunction);


//    $('.sc-player').pause();

                   function reload_js(src) {                                

                       $('<script>').attr('src', src).appendTo('head'); // append the script for the first time?
                       //console.log("body.single-radio > this src = " + src + "");

                    } // function reload_js(src)

                    // run this only once? - but what if updating tracklist etc? Sure would have to ensure there are global.variabels in place?
                  // reload_js('http://localhost:8888/inp-wp/wp-content/themes/inperspectiverecords/assets/js/inp-radio_v3.js'); 
         


                  /*    // stream track :itemurl
                      SC.stream(itemurl).then(function(player){
                        player.play().then(function(){
                          console.log('Playback started!');
                        }).catch(function(e){
                          console.error('Playback rejected. Try calling play() from a user interaction.', e);
                        });
                      });
*/

            //    console.log(' radioscriptloaded should be true;  '+radioscriptloaded+"");
           //     console.log('active scsjsonobject'+activescsjsonobject+"");
            //    console.log('scsjsonobject'+scsjsonobject+"");

            }// if 


         } else if ($('body').length > 0) {

                 console.log('if $body  - scsjsonobject'+scsjsonobject+"");

         };  // if body or radio class
              

    } //  if (typeof radioscriptloaded === 'undefined')
     


/* start - annimation of radio nav */




      if ($('.radio-container').length > 0) 
      {

        console.log("I need to make sure this only runs once? - I think at the momement, this will run again, once we navigate to another page and this script loads again.")

          if ($('body').hasClass("single-radio")){  // if single radio:


          console.log("body ahs single radio class=");

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

                   console.log("body does NOT have single radio class=");

           $('body').addClass("sticky-radio-player");


          } // if single radio

         
       /*
       .radio-container
       */

      };  

/* end - animation of radio nav */



                if ($('body.single-artists').length > 0) 
                {
                            

                           // console.log("if ($('body.single-artist').length > 0)");


                             if ($('#artist-releases').length > 0) 
                              {
                        
                           // console.log('recordcircle');

                                 recordcircle();// this needs to trigger other stuff like resiae as well I guess?

                              };  /*  #artist-releases  */
 
                        

                 /*
                 body.single-artists
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

               //  carousel.style.transform = 'translateZ(' + -radius + 'px) ' + rotateFn + '(' + angle + 'deg)';

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
                         console.log('IsHorizontal')
                           }else{
                         var isHorizontal = false;
                         console.log('NOT IsHorizontal')

                        }; 

                    //  isHorizontal = checkedRadio.value == 'horizontal';

                        console.log("isHorizontal = "+isHorizontal+"");
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

                console.log("base 1 - 319 ")
     
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


app.init(); // initial initiation?

}); ///  ENDS  read.QUERY



       

