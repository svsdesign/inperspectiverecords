/**
 *
 * Inperspective Records
 * 2018
 * Author: Simon van Stipriaan
 * http://svs.design 
 * 
 * inp-radio.js - handles the SC player - code
 */


/*
*   SoundCloud Custom Player jQuery Plugin
*   Author: Matas Petrikas, matas@soundcloud.com
*   Copyright (c) 2009  SoundCloud Ltd.
*   Licensed under the MIT license:
*   https://www.opensource.org/licenses/mit-license.php
*
*   Usage:
*   <a href="https://soundcloud.com/matas/hobnotropic" class="sc-player">My new dub track</a>
*   The link will be automatically replaced by the HTML based player
*/

/*TO DO - resovel this JS error (see gdoc for error)
 https://stackoverflow.com/questions/24528211/chrome-refuses-to-execute-an-ajax-script-due-to-wrong-mime-type
*/

(function($) {


//var toPause,
  //  toPlay;

  //   function playtoggle() {

  //  console.log("playtoggle")

      var toggleicon ='<svg width="69px" height="50px" viewBox="0 0 69 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Sound-Note" transform="translate(-1.000000, 0.000000)" stroke="#FFFFFF"> <path d="M67.8594209,1 L31.4014689,1 C30.5867899,1 29.7418533,1.63982037 29.5199009,2.42362522 L27.6745188,9.06773125 L27.6756096,9.01641662 C26.4949463,13.3009035 25.3019524,17.580458 24.1084842,21.8605817 C23.9318234,22.4935728 23.755542,23.1254256 23.5801143,23.755334 L23.2757834,24.8479277 C23.1562232,25.2767985 23.036663,25.705527 22.9171501,26.1344452 L22.8996975,26.1970945 L22.899982,26.1970945 L20.4891905,34.8523356 C20.464624,34.9093887 20.3923472,34.9402154 20.3554974,34.8829726 C19.9681241,34.2815196 19.0170013,33.1182616 19.0170013,33.1182616 C16.4239053,29.8250671 12.8992733,29.3072257 9.10502616,30.1304413 C2.51835268,31.5595679 -0.325767662,39.433992 3.95501997,44.558246 C7.02109267,48.2324587 13.0485221,49.9548185 17.5911471,48.4124393 C20.5295498,47.4137959 22.5950821,45.4712859 23.4412043,42.4167377 C25.0867819,36.4729672 26.0951475,32.784432 27.213778,28.7042077 C27.2163389,28.7059625 27.2187102,28.7078121 27.2212712,28.7095668 L28.5523214,23.9122657 C28.7642195,23.1617537 29.5502534,22.5393386 30.3432114,22.4956595 L32.800907,22.4929562 L33.950459,22.4929562 L33.9500322,22.4917231 L58.4076175,22.4651173 C58.2856859,22.902667 58.1636596,23.3401218 58.041728,23.7777189 L54.9508043,34.8747205 C54.9262852,34.9317737 54.853961,34.9626478 54.8171112,34.905405 C54.4297379,34.3038571 53.4786151,33.140694 53.4786151,33.140694 C50.8855665,29.8474995 47.3608871,29.3296107 43.56664,30.1528737 C36.9800139,31.5819529 34.1358936,39.4563769 38.4166812,44.5806309 C41.4827065,48.2548436 47.5101833,49.9772034 52.0528083,48.4348242 C54.991211,47.4361809 57.0567433,45.4936709 57.9028655,42.4391226 C60.7073854,32.3090366 61.6610692,28.7303867 64.4641663,18.597218 L64.4613682,18.5771569 L68.9485051,2.42362522 C69.1660943,1.63982037 68.6735308,1 67.8594209,1" id="Fill-1"></path> </g> </g> </svg>';
      var toMaximise = function(){
          console.log("toMaximise function");

      }// toMaximise
        
      var toMinimise = function(){
          console.log("toMinimise function");

      }// toMinimise


      var toPause = function(){

        var svg = document.getElementById("playertoggle"); // assigne to var
        var s = Snap(svg);

        var play = Snap.select('#play'); // assigne to unique id
        var playpath = Snap.select('#play-path'); // assigne to unique id

        var pause = Snap.select('#pause'); // assigne to unique id

        var playPoints = play.node.getAttribute('d');
        var pausePoints = pause.node.getAttribute('d');
        var playpathPoints = playpath.node.getAttribute('d'); // this added

  //left
        var play_left = Snap.select('#play-left'); // assigne to unique id
        var playpath_left = Snap.select('#play-path-left'); // assigne to unique id

        var pause_left = Snap.select('#pause-left'); // assigne to unique id

        var playPoints_left = play_left.node.getAttribute('d');
        var pausePoints_left = pause_left.node.getAttribute('d');
        var playpathPoints_left = playpath_left.node.getAttribute('d'); // this added
  //right
      
        var play_right = Snap.select('#play-right'); // assigne to unique id
        var playpath_right = Snap.select('#play-path-right'); // assigne to unique id

        var pause_right = Snap.select('#pause-right'); // assigne to unique id

        var playPoints_right = play_right.node.getAttribute('d');
        var pausePoints_right = pause_right.node.getAttribute('d');
        var playpathPoints_right = playpath_right.node.getAttribute('d'); // this added


        play.animate({ d: pausePoints }, 100, mina.easin);  
        console.log("Pause should animate - how many times?")

        play_left.animate({ d: pausePoints_left }, 100, mina.easin);  
       // console.log("toPause")

        play_right.animate({ d: pausePoints_right }, 100, mina.easin);  
        //console.log("toPause")
      }

      var toPlay = function(){

        var svg = document.getElementById("playertoggle"); // assigne to var
        var s = Snap(svg);

        var play = Snap.select('#play'); // assigne to unique id
        var playpath = Snap.select('#play-path'); // assigne to unique id

        var pause = Snap.select('#pause'); // assigne to unique id

        var playPoints = play.node.getAttribute('d');
        var pausePoints = pause.node.getAttribute('d');
        var playpathPoints = playpath.node.getAttribute('d'); // this added

  //left
        var play_left = Snap.select('#play-left'); // assigne to unique id
        var playpath_left = Snap.select('#play-path-left'); // assigne to unique id

        var pause_left = Snap.select('#pause-left'); // assigne to unique id

        var playPoints_left = play_left.node.getAttribute('d');
        var pausePoints_left = pause_left.node.getAttribute('d');
        var playpathPoints_left = playpath_left.node.getAttribute('d'); // this added
  //right
      
        var play_right = Snap.select('#play-right'); // assigne to unique id
        var playpath_right = Snap.select('#play-path-right'); // assigne to unique id

        var pause_right = Snap.select('#pause-right'); // assigne to unique id

        var playPoints_right = play_right.node.getAttribute('d');
        var pausePoints_right = pause_right.node.getAttribute('d');
        var playpathPoints_right = playpath_right.node.getAttribute('d'); // this added
     

   

        play.animate({ d: playpathPoints }, 100, mina.easin); 
        

        play_left.animate({ d: playpathPoints_left }, 100, mina.easin);  
     //   console.log("toPause")

        play_right.animate({ d: playpathPoints_right }, 100, mina.easin);  
       // console.log("toPause")


      };




  var toInlinePause = function(activeurl){
      
       
      //  console.log("we have an activeurl ="+activeurl+"");
 

        var thisactiveurl = activeurl,

            $thisactiveobject = $("li[data-tracklink='" + thisactiveurl +"']"), //$(document).find("[data-tracklink='${thisactiveurl}']");
            thisid = $thisactiveobject.data('trackid');
          
            $thissvg = $('#playertoggle_'+thisid+'');


       // console.log("thisactiveurl" + thisactiveurl+"");

        //   console.log("This ID" +thisid+"");
 
         //   $thisactiveobject.addClass("hello-what");
          //  $thisactiveobject.css("background-color","red");

      // var svg = $thissvg;
       // console.log(' thisid ='+thisid+'');

//      I need to ensure that there is not active item on the page anymore that I don't do anything?
              
        // remnove active-paused if it exist from other items:
        $(".play-toggle").removeClass("active-pause");// ensure to remove this class on in 



        if(typeof thisid !== "undefined") {

         //console.log("this id is defined")

              var svg = document.getElementById('playertoggle_'+thisid+'');
              var s = new Snap(svg);

              var play = Snap.select('#play_'+thisid+''); // assigne to unique id
              var playpath = Snap.select('#play-path_'+thisid+''); // assigne to unique id

              console.log("play" + play +"");

              var pause = Snap.select('#pause_'+thisid+''); // assigne to unique id

              var playPoints = play.node.getAttribute('d');
              var pausePoints = pause.node.getAttribute('d');
              var playpathPoints = playpath.node.getAttribute('d'); // this added

        //left
              var play_left = Snap.select('#play-left_'+thisid+''); // assigne to unique id
              var playpath_left = Snap.select('#play-path-left_'+thisid+''); // assigne to unique id

              var pause_left = Snap.select('#pause-left_'+thisid+''); // assigne to unique id

              var playPoints_left = play_left.node.getAttribute('d');
              var pausePoints_left = pause_left.node.getAttribute('d');
              var playpathPoints_left = playpath_left.node.getAttribute('d'); // this added
        //right
            
              var play_right = Snap.select('#play-right_'+thisid+''); // assigne to unique id
              var playpath_right = Snap.select('#play-path-right_'+thisid+''); // assigne to unique id

              var pause_right = Snap.select('#pause-right_'+thisid+''); // assigne to unique id

              var playPoints_right = play_right.node.getAttribute('d');
              var pausePoints_right = pause_right.node.getAttribute('d');
              var playpathPoints_right = playpath_right.node.getAttribute('d'); // this added

              //end reset            
               Snap.selectAll('.play-inline').animate({ d: playpathPoints }, 100, mina.easin); 

                             // Snap.select('.play-inline').animate({ d: playpathPoints }, 100, mina.easin); 
               Snap.selectAll('.play-left-inline').animate({ d: playpathPoints_left }, 100, mina.easin); 
               Snap.selectAll('.play-right-inline').animate({ d: playpathPoints_right }, 100, mina.easin); 



              play.animate({ d: pausePoints }, 100, mina.easin);  
       
              play_left.animate({ d: pausePoints_left }, 100, mina.easin);  
             // console.log("toPause")

              play_right.animate({ d: pausePoints_right }, 100, mina.easin);  
              //console.log("toPause")

           }
           /* else {
          console.log(thisid);

          console.log("this id is NOT defined - review the use of this else statment all together - delete it?");
          // but have only just loaded the

            // the following "playpathPoint" paths are not defined - so I need to get them from the main toggle


              var svg = document.getElementById('playertoggle');
              var s = new Snap(svg);

              var play = Snap.select('#play'); // assigne to unique id
              var playpath = Snap.select('#play-path'); // assigne to unique id

              var pause = Snap.select('#pause'); // assigne to unique id

              var playPoints = play.node.getAttribute('d');
              var pausePoints = pause.node.getAttribute('d');
              var playpathPoints = playpath.node.getAttribute('d'); // this added

        //left
              var play_left = Snap.select('#play-left'); // assigne to unique id
              var playpath_left = Snap.select('#play-path-left'); // assigne to unique id

              var pause_left = Snap.select('#pause-left'); // assigne to unique id

              var playPoints_left = play_left.node.getAttribute('d');
              var pausePoints_left = pause_left.node.getAttribute('d');
              var playpathPoints_left = playpath_left.node.getAttribute('d'); // this added
        //right
            
              var play_right = Snap.select('#play-right'); // assigne to unique id
              var playpath_right = Snap.select('#play-path-right'); // assigne to unique id

              var pause_right = Snap.select('#pause-right'); // assigne to unique id

              var playPoints_right = play_right.node.getAttribute('d');
              var pausePoints_right = pause_right.node.getAttribute('d');
              var playpathPoints_right = playpath_right.node.getAttribute('d'); // this added

            

               Snap.selectAll('.play-inline').animate({ d: playpathPoints }, 100, mina.easin); 

                             // Snap.select('.play-inline').animate({ d: playpathPoints }, 100, mina.easin); 
               Snap.selectAll('.play-left-inline').animate({ d: playpathPoints_left }, 100, mina.easin); 
               Snap.selectAll('.play-right-inline').animate({ d: playpathPoints_right }, 100, mina.easin); 


              play.animate({ d: pausePoints }, 100, mina.easin);  
       
              play_left.animate({ d: pausePoints_left }, 100, mina.easin);  
             // console.log("toPause")

              play_right.animate({ d: pausePoints_right }, 100, mina.easin);  
              //console.log("toPause")

            
           }// 

           */


        
     

      };//toInlinePause


      var toInlinePlay = function(activeurl){


        var thisactiveurl = activeurl,
            $thisactiveobject = $("li[data-tracklink='" + thisactiveurl +"']"), //$(document).find("[data-tracklink='${thisactiveurl}']");
            thisid = $thisactiveobject.data('trackid');
           

            $thissvg = $('#playertoggle_'+thisid+'');

          //  console.log("ToInline Play" + thisid +"");

           // $thisactiveobject.addClass("hello-what");
          //  $thisactiveobject.css("background-color","transparent");

            // issue here is that we also need to clear other items that have been click prior to this;
            // restore them totheir initial pause state
    

        var svg = document.getElementById('playertoggle_'+thisid+'');
        var s = new Snap(svg);

              var play = Snap.select('#play_'+thisid+''); // assigne to unique id
        var playpath = Snap.select('#play-path_'+thisid+'');// assigne to unique id

        var pause = Snap.select('#pause_'+thisid+''); // assigne to unique id

        var playPoints = play.node.getAttribute('d');
        var pausePoints = pause.node.getAttribute('d');
        var playpathPoints = playpath.node.getAttribute('d'); // this added

  //left
        var play_left = Snap.select('#play-left_'+thisid+''); // assigne to unique id
        var playpath_left = Snap.select('#play-path-left_'+thisid+''); // assigne to unique id

        var pause_left = Snap.select('#pause-left_'+thisid+''); // assigne to unique id

        var playPoints_left = play_left.node.getAttribute('d');
        var pausePoints_left = pause_left.node.getAttribute('d');
        var playpathPoints_left = playpath_left.node.getAttribute('d'); // this added
  //right
      
        var play_right = Snap.select('#play-right_'+thisid+''); // assigne to unique id
        var playpath_right = Snap.select('#play-path-right_'+thisid+''); // assigne to unique id

        var pause_right = Snap.select('#pause-right_'+thisid+''); // assigne to unique id

        var playPoints_right = play_right.node.getAttribute('d');
        var pausePoints_right = pause_right.node.getAttribute('d');
        var playpathPoints_right = playpath_right.node.getAttribute('d'); // this added
  


        play.animate({ d: playpathPoints }, 100, mina.easin); 
        //      console.log("play should animate - how many times?");

        play_left.animate({ d: playpathPoints_left }, 100, mina.easin);  
     //   console.log("toPause")

        play_right.animate({ d: playpathPoints_right }, 100, mina.easin);  
       // console.log("toPause")
//
      // $thissvg.css("border","1px solid red");


          // remove existing classes, if they exist.
         $(".play-toggle").removeClass("active-pause");// ensure to remove this class on in 
         // add class to this object
         $thisactiveobject.find(".play-toggle").addClass("active-pause"); 


      };

 // }// playtoggle


  /* headroom */

    function initheadroom(){

        if ($(".sc-player").length){
      
        console.log(".sc-player exists")

            $(".sc-player").headroom({
                  // vertical offset in px before element is first unpinned
                "offset": 0, // This value maybe a variable; we need to cater for the arhive page
                "tolerance": 5,
                    // scroll tolerance in px before state changes

                // "tolerance" : {
                //    "up" : ,
                //   "down" : 100
                //    },
                "classes": {
                  "initial": "animated",
                  "pinned": "pinned",
                  "unpinned": "unpinned"
                }

            });

            $('.sc-player').hover(function(){
                 
               //console.log("sc-player hover")
               // ensure headroom pinned
                forceheadroompin();

            }); // hover 


             /*

var options = {

    offset : 0,
    // scroll tolerance in px before state changes
    tolerance : 0,
    // or you can specify tolerance individually for up/down scroll
    tolerance : {
        up : 5,
        down : 0
    },
    // css classes to apply
    classes : {
        // when element is initialised
        initial : "headroom",
        // when scrolling up
        pinned : "headroom--pinned",
        // when scrolling down
        unpinned : "headroom--unpinned",
        // when above offset
        top : "headroom--top",
        // when below offset
        notTop : "headroom--not-top",
        // when at bottom of scoll area
        bottom : "headroom--bottom",
        // when not at bottom of scroll area
        notBottom : "headroom--not-bottom",
        // when frozen method has been called
        frozen: "headroom--frozen"
    },
    // element to listen to scroll events on, defaults to `window`
    scroller : someElement,
    // callback when pinned, `this` is headroom object
    onPin : function() {},
    // callback when unpinned, `this` is headroom object
    onUnpin : function() {},
    // callback when above offset, `this` is headroom object
    onTop : function() {},
    // callback when below offset, `this` is headroom object
    onNotTop : function() {},
    // callback when at bottom of page, `this` is headroom object
    onBottom : function() {},
    // callback when moving away from bottom of page, `this` is headroom object
    onNotBottom : function() {}
};
// pass options as the second argument to the constructor
// supplied options are merged with defaults
var headroom = new Headroom(element, options);




                */

      

        } else {
        console.log(".radio container doesn't exist");
        }

    } // function initheadroom()



    function destroyheadroom(){
      // to destroy
      $(".sc-player").headroom("destroy");

    }// destroyheadroom()


    function forceheadroompin(){

       if ($(".sc-player").hasClass("unpinned")){
        
          $(".sc-player").removeClass("unpinned");
          $(".sc-player").addClass("pinned");

          //console.log("unpinned - now pinned");

       }

    }//forceheadroom

  /* end headroom */



  // Convert milliseconds into Hours (h), Minutes (m), and Seconds (s)
  var timecode = function(ms) {
    var hms = function(ms) {
          return {
            h: Math.floor(ms/(60*60*1000)),
            m: Math.floor((ms/60000) % 60),
            s: Math.floor((ms/1000) % 60)
          };
        }(ms),
        tc = []; // Timecode array to be joined with '.'

    if (hms.h > 0) {
      tc.push(hms.h);
    }

    tc.push((hms.m < 10 && hms.h > 0 ? "0" + hms.m : hms.m));
    tc.push((hms.s < 10  ? "0" + hms.s : hms.s));

    return tc.join('.');
  };
  // shuffle the array
  var shuffle = function(arr) {
    arr.sort(function() { return 1 - Math.floor(Math.random() * 3); } );
    return arr;
  };

  var debug = true,
      useSandBox = false,
      $doc = $(document),
      log = function(args) {
        try {
          if(debug && window.console && window.console.log){
            window.console.log.apply(window.console, arguments);
          }
        } catch (e) {
          // no console available
        }
      },
      domain = useSandBox ? 'sandbox-soundcloud.com' : 'soundcloud.com',
      secureDocument = (document.location.protocol === 'https:'),
      // convert a SoundCloud resource URL to an API URL
      scApiUrl = function(url, apiKey) {
        var resolver = ( secureDocument || (/^https/i).test(url) ? 'https' : 'http') + '://api.' + domain + '/resolve?url=',
            params = 'format=json&consumer_key=' + apiKey +'&callback=?';

//console.log(resolver);
//.then(console.log())
//https://stackoverflow.com/questions/40574159/refused-to-execute-script-strict-mime-type-checking-is-enabled

        // force the secure url in the secure environment
        if( secureDocument ) {
          url = url.replace(/^http:/, 'https:');


        }
        // console.log( (/api\./).test(url) );

          // check if it's already a resolved api url
         if ( (/api\./).test(url) ) {

          // console.log( url + '?' + params);
             return url + '?' + params;

         } else {

           //console.log(resolver + url + '&' + params);

            return resolver + url + '&' + params;

          }


      };

  // TODO Expose the audio engine, so it can be unit-tested
  var audioEngine = function() {
    var html5AudioAvailable = function() {
        var state = false;
        try{
          var a = new Audio();
          state = a.canPlayType && (/maybe|probably/).test(a.canPlayType('audio/mpeg'));
          // uncomment the following line, if you want to enable the html5 audio only on mobile devices
          // state = state && (/iPad|iphone|mobile|pre\//i).test(navigator.userAgent);
        }catch(e){
          // there's no audio support here sadly
        }

        return state;
    }(),
    callbacks = {
      onReady: function() {
        $doc.trigger('scPlayer:onAudioReady');
      },
      onPlay: function() {
        $doc.trigger('scPlayer:onMediaPlay');
      },
      onPause: function() {
        $doc.trigger('scPlayer:onMediaPause');
      },
      onEnd: function() {
        $doc.trigger('scPlayer:onMediaEnd');
      },
      onBuffer: function(percent) {
        $doc.trigger({type: 'scPlayer:onMediaBuffering', percent: percent});
        //console.log("onBuffer"+percent+"")
        //console.log("buffer" + percent+''); < review this use of value to determine the buffer animation - maybe add in other areas as well
       // $("body").addClass("sc-buffering");

        if (percent < 2){ //less that 2%  - still too much :( // less than 5% - which still too much on 2 hours set - need to device a better %based approach>?

        $("body").addClass("sc-buffering");
        }
       /* if (percent > 5){ // this means only working if at the beginng of buffer - uptill 5
          // what I probably want is to check current buffer percentage and compare with  play % status?

        
        }*/

        else if (percent > 2){ //less that 2%  - still too much :( // less than 5% - which still too much on 2 hours set - need to device a better %based approach>?

          $("body").removeClass("sc-buffering");
        }
      

      } //onlBuffer

    };//callbacks

    var html5Driver = function() {
      var player = new Audio(),
          onTimeUpdate = function(event){
            var obj = event.target,
                buffer = ((obj.buffered.length && obj.buffered.end(0)) / obj.duration) * 100;
            // ipad has no progress events implemented yet
            callbacks.onBuffer(buffer);
            // anounce if it's finished for the clients without 'ended' events implementation
            if (obj.currentTime === obj.duration) { callbacks.onEnd(); }
          },
          onProgress = function(event) {
            var obj = event.target,
                buffer = ((obj.buffered.length && obj.buffered.end(0)) / obj.duration) * 100;
            callbacks.onBuffer(buffer);
          };

      $('<div class="sc-player-engine-container"></div>').appendTo(".radio-container").append(player);

      // prepare the listeners
      player.addEventListener('play', callbacks.onPlay, false);
      player.addEventListener('pause', callbacks.onPause, false);
      // handled in the onTimeUpdate for now untill all the browsers support 'ended' event
      // player.addEventListener('ended', callbacks.onEnd, false);
      player.addEventListener('timeupdate', onTimeUpdate, false);
      player.addEventListener('progress', onProgress, false);


      return {
        load: function(track, apiKey) {
          player.pause();
          player.src = track.stream_url + (/\?/.test(track.stream_url) ? '&' : '?') + 'consumer_key=' + apiKey;
          player.load();
          //playtoggle();// run on load U gues?

          player.play();
        },
        play: function() {
          player.play();
        },
        pause: function() {
          player.pause();
        },
        stop: function(){
          if (player.currentTime) {
            player.currentTime = 0;
            player.pause();
          }
        },
        seek: function(relative){
          player.currentTime = player.duration * relative;
          player.play();
        },
        getDuration: function() {
          return player.duration * 1000;
        },
        getPosition: function() {
          return player.currentTime * 1000;
        },
        setVolume: function(val) {
          player.volume = val / 100;
        }
      };

    };





    var flashDriver = function() {
      var engineId = 'scPlayerEngine',
          player,
          flashHtml = function(url) {
            var swf = (secureDocument ? 'https' : 'http') + '://player.' + domain +'/player.swf?url=' + url +'&amp;enable_api=true&amp;player_type=engine&amp;object_id=' + engineId;
            if ($.browser.msie) {
              return '<object height="100%" width="100%" id="' + engineId + '" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" data="' + swf + '">'+
                '<param name="movie" value="' + swf + '" />'+
                '<param name="allowscriptaccess" value="always" />'+
                '</object>';
            } else {
              return '<object height="100%" width="100%" id="' + engineId + '">'+
                '<embed allowscriptaccess="always" height="100%" width="100%" src="' + swf + '" type="application/x-shockwave-flash" name="' + engineId + '" />'+
                '</object>';
            }
          };


      // listen to audio engine events
      // when the loaded track is ready to play
      soundcloud.addEventListener('onPlayerReady', function(flashId, data) {
        player = soundcloud.getPlayer(engineId);
        callbacks.onReady();
        console.log("player ready")
      });

      // when the loaded track finished playing
      soundcloud.addEventListener('onMediaEnd', callbacks.onEnd);

      // when the loaded track is still buffering
      soundcloud.addEventListener('onMediaBuffering', function(flashId, data) {
        callbacks.onBuffer(data.percent);
        console.log("onMediaBuffering" +data.percent+"");//
      });

      // when the loaded track started to play
      soundcloud.addEventListener('onMediaPlay', callbacks.onPlay);

      // when the loaded track is was paused
      soundcloud.addEventListener('onMediaPause', callbacks.onPause);

      return {
        load: function(track) {
          var url = track.uri;
          console.log("url on load??" + url +"")
          if(player){
            player.api_load(url);
          }else{
            // create a container for the flash engine (IE needs this to operate properly)
            $('<div class="sc-player-engine-container"></div>').appendTo(document.body).html(flashHtml(url));
          }
        },
        play: function() {
          player && player.api_play();
        },
        pause: function() {
          player && player.api_pause();
        },
        stop: function(){
          player && player.api_stop();
        },
        seek: function(relative){
          player && player.api_seekTo((player.api_getTrackDuration() * relative));
        },
        getDuration: function() {
          return player && player.api_getTrackDuration && player.api_getTrackDuration() * 1000;
        },
        getPosition: function() {
          return player && player.api_getTrackPosition && player.api_getTrackPosition() * 1000;
        },
        setVolume: function(val) {
          if(player && player.api_setVolume){
            player.api_setVolume(val);
          }
        }

      };
    };

    return html5AudioAvailable? html5Driver() : flashDriver();

  }();



  var apiKey,
      didAutoPlay = false,
      players = [],
      updates = {},
      currentUrl,
      loadTracksData = function($player, links, key) {
        var index = 0,
            playerObj = {node: $player, tracks: []},
            loadUrl = function(link) {
              var apiUrl = scApiUrl(link.url, apiKey);

              //console.log("apiIRL"+apiUrl+"");

              $.getJSON(apiUrl, function(data) {
                // log('data loaded', link.url, data);
                index += 1;
                if(data.tracks){
                  // log('data.tracks', data.tracks);
                  playerObj.tracks = playerObj.tracks.concat(data.tracks);
                }else if(data.duration){
                  // a secret link fix, till the SC API returns permalink with secret on secret response
                  data.permalink_url = link.url;
                  // if track, add to player
                  playerObj.tracks.push(data);
                }else if(data.creator){
                  // it's a group!
                  links.push({url:data.uri + '/tracks'});
                }else if(data.username){
                  // if user, get his tracks or favorites
                  if(/favorites/.test(link.url)){
                    links.push({url:data.uri + '/favorites'});
                  }else{
                    links.push({url:data.uri + '/tracks'});
                  }
                }else if($.isArray(data)){
                  playerObj.tracks = playerObj.tracks.concat(data);
                }
                if(links[index]){
                  // if there are more track to load, get them from the api
                  loadUrl(links[index]);
                }else{
                  // if loading finishes, anounce it to the GUI
                  playerObj.node.trigger({type:'onTrackDataLoaded', playerObj: playerObj, url: apiUrl});
                }
             })
           };
        // update current API key
        apiKey = key;

         //console.log("apiKey"+apiKey+"");
 
        // update the players queue
        players.push(playerObj);
        // load first tracks
        loadUrl(links[index]);
      },
      artworkImage = function(track, usePlaceholder) {
        if(usePlaceholder){
          return '<div class="sc-loading-artwork">Loading Artwork</div>';
        }else if (track.artwork_url) {
          return '<img src="' + track.artwork_url.replace('-large', '-t300x300') + '"/>';
        }else{
          return '<div class="sc-no-artwork">No Artwork</div>';
        }
      },
      updateTrackInfo = function($player, track) {

        // update the current track info in the player

         //console.log('updateTrackInfo', track);
        $('.sc-info', $player).each(function(index) {
          $('h3', this).html('<a href="' + track.permalink_url +'">' + track.title + '</a>');
          $('h4', this).html('by <a href="' + track.user.permalink_url +'">' + track.user.username + '</a>');
          $('p', this).html(track.description || 'no Description');
        });
        // update the artwork
        $('.sc-artwork-list li', $player).each(function(index) { // not sure we use this functiona - maybe comment it out if not.
          var $item = $(this),
              itemTrack = $item.data('sc-track');

          if (itemTrack === track) {
            // show track artwork
            $item
              .addClass('active')
              .find('.sc-loading-artwork')
                .each(function(index) {
                  // if the image isn't loaded yet, do it now
                  $(this).removeClass('sc-loading-artwork').html(artworkImage(track, false));
                });
          }else{
            // reset other artworks
            $item.removeClass('active');
          }
        });
        // update the track duration in the progress bar
        $('.sc-duration', $player).html(timecode(track.duration));
        // put the waveform into the progress bar
        $('.sc-waveform-container', $player).html('<img src="' + track.waveform_url +'" />');

        $player.trigger('onPlayerTrackSwitch.scPlayer', [track]);
      },
      play = function(track) {

       var url = track.permalink_url;
              if(currentUrl === url){
                // log('will play');
                audioEngine.play();
              }else{
                currentUrl = url;
                // log('will load', url);
                audioEngine.load(track, apiKey);
              }

/*
console.log("track" + track);

   // var url =     //   $('body').attr("data-active-scjson", track.id);
                   var url = $('#show-details').data("radio-link");
        console.log("url" + url);
 //        var url = track.permalink_url;
        if(currentUrl === url){
          log('will play');
          audioEngine.play();
        }else{
          currentUrl = url;
          log('will load', url);
          audioEngine.load(track, apiKey);
        }*/
      },
      getPlayerData = function(node) {
      
       // console.log("getPlayerData" + players[$(node).data('sc-player').id] +"");
        //console.log("getPlayerData" + players[$(node).data('sc-player').id] +"");

        return players[$(node).data('sc-player').id];
      },
      updatePlayStatus = function(player, status) {
        if(status){
          // reset all other players playing status
          $('div.sc-player.playing').removeClass('playing');
        }
        $(player)
          .toggleClass('playing', status)
          .trigger((status ? 'onPlayerPlay' : 'onPlayerPause'));
      },
      onPlay = function(player, id, activeurl) {


        var track = getPlayerData(player).tracks[id || 0],
            thisurl = activeurl;
         
        // console.log("thisurl" + thisurl+"");
        updateTrackInfo(player, track);
        // cache the references to most updated DOM nodes in the progress bar
        updates = {
          $buffer: $('.sc-buffer', player),
          $played: $('.sc-played', player),
          position:  $('.sc-position', player)[0]
        };
        updatePlayStatus(player, true);
        play(track);
        $('body').addClass("sc-player-playing");
        $('body').removeClass("sc-player-paused"); // if this existed remove it

        toPause();// Main toggle at the top animation
        toInlinePause(thisurl); // particular toggle in the page
       // console.log("onPlay")
       // console.log(player)
        //console.log("id = " + id +"")
       // console.log("onPlay out")

        //var newtrackid = $('body').attr("data-scjson"); // set id to body data
        //console.log("newtrackid" +newtrackid)

        //var activetrackid = $('body').attr("data-active-scjson"); // set id to body data
        //var newtrack = getPlayerData(player).tracks[newtrackid || 0];

      /*  var track = getPlayerData(player).tracks[id || 0];


       // console.log('track' +track +"");
        //console.log('newtrack' + newtrack +"");

        updateTrackInfo(player, track);
        // cache the references to most updated DOM nodes in the progress bar
        updates = {
          $buffer: $('.sc-buffer', player),
          $played: $('.sc-played', player),
          position:  $('.sc-position', player)[0]
        };
        updatePlayStatus(player, true);
        play(track);*/
         // animate play / pause icon

     /*what do I do here */
      /* if (track === activetrackid) {
    
        // play(track);
         console.log("track" + track)
      //  playtoggle();
       //  toPause();

         console.log("the track.id of the current playing tune" + track.id+"");
       ///  console.log("the track.id of the current playing tune" + track.id+"");

      //  $('body').attr("data-active-scjson", track.id);
       // $('body').attr("data-active-scjson", newtrackid);
 
       } else {      // if the track id is not the same - update it
       // play(newtrack);
      //  playtoggle();
      //  toPause();
         console.log("track" + track)

        console.log("the track.id not the same change it?");

       // $('body').attr("data-active-scjson", newtrackid);
       } 
       */   /*END what do I do here */
  
   /* 
            var scsjsonobject = $('body').data("scjson");
    var thisplayerid = $('body').data("scjson");
 
    console.log('scsjsonobject =' + scsjsonobject +'');
    remove this - not being used  if (track.id == scsjsonobject){
      console.log("runit fam");
      console.log("track.id" + track.id +"")
        } else {

          console.log(" don't runit fam");
                console.log("track.id" + track.id +"")


    }; 
    */

      },
      onPause = function(player, id, activeurl) {
        updatePlayStatus(player, false);
        audioEngine.pause();
     //   playtoggle();


        toPlay();// Main toggle at the top animation
        toInlinePlay(activeurl)
        $('body').removeClass("sc-player-playing");
        $('body').addClass("sc-player-paused");

      },
      onFinish = function() {
        var $player = updates.$played.closest('.sc-player'),
            $nextItem;
        // update the scrubber width
        updates.$played.css('width', '0%');
        // show the position in the track position counter
        updates.position.innerHTML = timecode(0);
        // reset the player state
        updatePlayStatus($player, false);
        // stop the audio
        audioEngine.stop();
        $player.trigger('onPlayerTrackFinish');
      },
      onSeek = function(player, relative) {
        audioEngine.seek(relative);
        $(player).trigger('onPlayerSeek');
      },
      onSkip = function(player) {
        var $player = $(player);
        // continue playing through all players
        log('track finished get the next one');
        $nextItem = $('.sc-trackslist li.active', $player).next('li');
        // try to find the next track in other player
        if(!$nextItem.length){
          $nextItem = $player.nextAll('div.sc-player:first').find('.sc-trackslist li.active');
        }
        $nextItem.click();
      },
      soundVolume = function() {
        var vol = 80,
            cooks = document.cookie.split(';'),
            volRx = new RegExp('scPlayer_volume=(\\d+)');
        for(var i in cooks){
          if(volRx.test(cooks[i])){
            vol = parseInt(cooks[i].match(volRx)[1], 10);
            break;
          }
        }
        return vol;
      }(),
      onVolume = function(volume) {
        var vol = Math.floor(volume);
        // save the volume in the cookie
        var date = new Date();
        date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
        soundVolume = vol;
        document.cookie = ['scPlayer_volume=', vol, '; expires=', date.toUTCString(), '; path="/"'].join('');
        // update the volume in the engine
        audioEngine.setVolume(soundVolume);
      },
      positionPoll;

    // listen to audio engine events
    $doc
      .bind('scPlayer:onAudioReady', function(event) {
        log('onPlayerReady: audio engine is ready');
        audioEngine.play();
        // set initial volume
        onVolume(soundVolume);
      })
      // when the loaded track started to play
      .bind('scPlayer:onMediaPlay', function(event) {
        clearInterval(positionPoll);
        positionPoll = setInterval(function() {
          var duration = audioEngine.getDuration(),
              position = audioEngine.getPosition(),
              relative = (position / duration);

          // update the scrubber width
          updates.$played.css('width', (100 * relative) + '%');
          // show the position in the track position counter
          updates.position.innerHTML = timecode(position);
          // announce the track position to the DOM
          $doc.trigger({
            type: 'onMediaTimeUpdate.scPlayer',
            duration: duration,
            position: position,
            relative: relative
          });
        }, 500);

        
      })
      // when the loaded track is was paused
      .bind('scPlayer:onMediaPause', function(event) {
        clearInterval(positionPoll);
        positionPoll = null;
      })
      // change the volume
      .bind('scPlayer:onVolumeChange', function(event) {
        onVolume(event.volume);
      })
      .bind('scPlayer:onMediaEnd', function(event) {
        onFinish();
      })
      .bind('scPlayer:onMediaBuffering', function(event) {
        updates.$buffer.css('width', event.percent + '%');
      });


  // Generate custom skinnable HTML/CSS/JavaScript based SoundCloud players from links to SoundCloud resources
  $.scPlayer = function(options, node) {
    var opts = $.extend({}, $.scPlayer.defaults, options),
        playerId = players.length,
        $source = node && $(node),
        sourceClasses = $source[0].className.replace('sc-player', ''),
        links = opts.links || $.map($('a', $source).add($source.filter('a')), function(val) { return {url: val.href, title: val.innerHTML}; }),
        $player = $('<div class="sc-player loading"></div>').data('sc-player', {id: playerId}),
        $artworks = $('<ol class="sc-artwork-list"></ol>').appendTo($player),
        $controls = $('<div class="sc-controls"></div>').appendTo($player),
        $info = $('<div class="sc-info"><h3></h3><h4></h4><p></p><a href="#" class="sc-info-close">X</a></div>').appendTo($player);
        // add the classes of the source node to the player itself
        // the players can be indvidually styled this way
        if(sourceClasses || opts.customClass){
          $player.addClass(sourceClasses).addClass(opts.customClass);
        }


        // adding controls to the player
        $player
          .find('.sc-controls')
        //    .append('<a href="#play" class="sc-play">Play</a> <a href="#pause" class="sc-pause hidden">Pause</a>')
        //      .append('<a class="sc-play"> <div class="play-toggle"> <svg id="playertoggle" class=""  width="100%" viewBox="0 0 1005.115 677.875" xmlns="http://www.w3.org/2000/svg"> <path id="play" d="M981.065,0H212.327c-17.178,0-34.994,13.491-39.674,30.018L1.039,647.903 c-4.463,16.55,5.866,29.972,22.93,29.972h174.845c17.223,0,35.039-13.422,39.673-29.972l45.905-165.451 c4.635-16.413,22.291-29.927,39.628-29.927h531.177c17.395,0,35.153-13.468,39.788-29.949l109.045-392.559 C1008.617,13.491,998.231,0,981.065,0z" fill-rule="nonzero"/> <path opacity="0" id="pause" d="M901.569,280.438H132.831c-17.178,0-34.994,13.491-39.674,30.018l-15.801,58.011 c-4.463,16.55,5.866,29.972,22.93,29.972h174.845c17.223,0,32.254,0,32.254,0l0,0h31.952h531.177 c17.395,0,35.153-12.38,39.788-28.861l14.231-59.121C929.121,293.929,918.735,280.438,901.569,280.438z" fill-rule="nonzero"/> <path style="display:none;" id="play-path" d="M981.065,0H212.327c-17.178,0-34.994,13.491-39.674,30.018L1.039,647.903 c-4.463,16.55,5.866,29.972,22.93,29.972h174.845c17.223,0,35.039-13.422,39.673-29.972l45.905-165.451 c4.635-16.413,22.291-29.927,39.628-29.927h531.177c17.395,0,35.153-13.468,39.788-29.949l109.045-392.559 C1008.617,13.491,998.231,0,981.065,0z" fill-rule="nonzero"/> </svg> </div> </a>')
      // .append('<a class="sc-play"> <div class="play-toggle"> <svg id="playertoggle" class=""  width="100%" viewBox="0 0 1005.115 677.875" xmlns="http://www.w3.org/2000/svg"> <path id="play" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> <path opacity="0" id="pause" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> <path style="display:none;" id="play-path" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> </svg> </div> </a>')
   //     .append('<a class="sc-play"> <div class="play-toggle"> <svg id="playertoggle" class=""  width="100%" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"> <path id="play" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> <path id="play-left" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> <path id="play-right" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> <path opacity="0" id="pause" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> <path opacity="0" id="pause-left" d="M447,1000 0,1000 0,0 447,0 447,500.084 z" fill-rule="nonzero"/> <path opacity="0" id="pause-right" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> <path style="display:none;" id="play-path" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> <path style="display:none;" id="play-path-left" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> <path style="display:none;" id="play-path-right" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> </svg> </div> </a>')
          .append('<a class="sc-play"> <div class="play-toggle"> <svg id="playertoggle" class=""  width="100%" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"> <path id="play" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> <path id="play-left" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> <path id="play-right" d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> <path opacity="0" id="pause" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> <path opacity="0" id="pause-left" d="M447,1000 0,1000 0,0 447,0 447,500.084 z" fill-rule="nonzero"/> <path opacity="0" id="pause-right" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> <path style="display:none;" id="play-path" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> <path style="display:none;" id="play-path-left" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> <path style="display:none;" id="play-path-right" d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> </svg> </div> </a>')
          .append('<div class="player-toggle"><div class="toggle-icon-wrap"><div class="toggle-icon">'+ toggleicon +'</div></div><div class="sc-minimise">hide</div><div class="sc-maximise">&nbsp&nbsp&nbsp&nbsp</div></div>')
        //  .append('icon')
         // .append('')
          .end()
          .append('<a href="#info" class="sc-info-toggle">Info</a>')
          .append('<div class="sc-scrubber"></div>')
            .find('.sc-scrubber')
              .append('<div class="sc-volume-slider"><span class="sc-volume-status" style="width:' + soundVolume +'%"></span></div>')
              .append('<div class="sc-time-span"><div class="sc-waveform-container"></div><div class="sc-buffer"></div><div class="sc-played"></div></div>')
              .append('<div class="sc-time-indicators"><span class="sc-position"></span> | <span class="sc-duration"></span></div>');
        $list = $('<ol class="sc-trackslist"></ol>').appendTo($player);
        // load and parse the track data from SoundCloud API
        loadTracksData($player, links, opts.apiKey);
        // init the player GUI, when the tracks data was laoded
        $player.bind('onTrackDataLoaded.scPlayer', function(event) {
          // log('onTrackDataLoaded.scPlayer', event.playerObj, playerId, event.target);
          var tracks = event.playerObj.tracks;
          if (opts.randomize) {
            tracks = shuffle(tracks);
          }
          // create the playlist
          $.each(tracks, function(index, track) {
            var active = index === 0;
            // create an item in the playlist
            $('<li><a href="' + track.permalink_url +'">' + track.title + '</a><span class="sc-track-duration">' + timecode(track.duration) + '</span></li>').data('sc-track', {id:index}).toggleClass('active', active).appendTo($list);
            // create an item in the artwork list
            $('<li></li>')
              .append(artworkImage(track, index >= opts.loadArtworks))
              .appendTo($artworks)
              .toggleClass('active', active)
              .data('sc-track', track);


             // console.log("track.id" + track.id+"");

            //  $('body').attr("data-scjson", track.id);

          
              
         

          });
          // update the element before rendering it in the DOM
          $player.each(function() {
            if($.isFunction(opts.beforeRender)){
              opts.beforeRender.call(this, tracks);
            }
          });
          // set the first track's duration
          $('.sc-duration', $player)[0].innerHTML = timecode(tracks[0].duration);
          $('.sc-position', $player)[0].innerHTML = timecode(0);
          // set up the first track info
          updateTrackInfo($player, tracks[0]);

          // if continous play enabled always skip to the next track after one finishes
          if (opts.continuePlayback) {
            $player.bind('onPlayerTrackFinish', function(event) {
              onSkip($player);
            });
          }

          // announce the succesful initialization
          $player
            .removeClass('loading')// hook into this
            .trigger('onPlayerInit');

          $('body').addClass('sc-loaded');

          // if auto play is enabled and it's the first player, start playing
          if(opts.autoPlay && !didAutoPlay){
            onPlay($player);
            didAutoPlay = true;
          }
        });


    // replace the DOM source (if there's one)
    $source.each(function(index) {
      $(this).replaceWith($player);
    });

    return $player;
  };

  // stop all players, might be useful, before replacing the player dynamically
  $.scPlayer.stopAll = function() {
    $('.sc-player.playing a.sc-pause').click();
  };

  // destroy all the players and audio engine, usefull when reloading part of the page and audio has to stop
  $.scPlayer.destroy = function() {
    $('.sc-player, .sc-player-engine-container').remove();
  };

  // plugin wrapper
  $.fn.scPlayer = function(options) {
    // reset the auto play
    didAutoPlay = false;
    // create the players
    this.each(function() {
      $.scPlayer(options, this);
    });
    return this;
  };

  // default plugin options
  $.scPlayer.defaults = $.fn.scPlayer.defaults = {
    customClass: null,
    // do something with the dom object before you render it, add nodes, get more data from the services etc.
    beforeRender  :   function(tracksData) {
      var $player = $(this);
    },
    // initialization, when dom is ready
    onDomReady  : function() {
      $('a.sc-player, div.sc-player').scPlayer();
        //  console.log("api key htuiRd1JP11Ww0X72T1C3g ");

    },
    autoPlay: false,
    continuePlayback: false,//true,
    randomize: false,
    loadArtworks: 5,
    // the default Api key should be replaced by your own one
    // get it here https://soundcloud.com/you/apps/new
    apiKey: 'htuiRd1JP11Ww0X72T1C3g' // only api Key I can find
   // apiKey: 's-8Pjrp' //https://github.com/ytdl-org/youtube-dl/blob/master/youtube_dl/extractor/soundcloud.py
//apiKey:'853fdb79a14a9ed748ec9fe482e859dd' /// this is a client id though?
    //    https://github.com/DevMountain/soundCloud-api
  };


  // the GUI event bindings
  //--------------------------------------------------------

  // toggling Minmise / Maximise
  $(document).on('click','.sc-maximise, .sc-minimise', function(event) {
   // var $list = $(this).closest('.sc-player').find('ol.sc-trackslist');
    // simulate the click in the tracklist
    console.log("clicking maximum / minumum");
    $('body').toggleClass("sc-minimised");
//    $('body').removeClass("sc-player-paused"); // if this existed remove it

    //$list.find('li.active').click();
    return false;
  });

  // toggling play/pause
  $(document).on('click','a.sc-play, a.sc-pause', function(event) {
    var $list = $(this).closest('.sc-player').find('ol.sc-trackslist');
    // simulate the click in the tracklist
    $list.find('li.active').click();
    return false;
  });

  // displaying the info panel in the player
  $(document).on('click','a.sc-info-toggle, a.sc-info-close', function(event) {
    var $link = $(this);
    $link.closest('.sc-player')
      .find('.sc-info').toggleClass('active').end()
      .find('a.sc-info-toggle').toggleClass('active');
    return false;
  });


 $(document).on('click','.sc-player-data', function(event) {
  
  console.log("clicking");

var $track = $(this),
        $player = $('.sc-player'),
      //  trackId = $track.data('sc-track').id,
   //     trackId = 1,
     trackId = $track.data('sc-player-data');//.id,
   
        play = $player.is(':not(.playing)') || $track.is(':not(.active)');

                console.log('trackID' + trackId + '');

    if (play) {
      onPlay($player, trackId);
    }else{
      onPause($player);
    }

  });


  // selecting tracks in the playlist
  $(document).on('click','.sc-trackslist li', function(event) {
    // this is generally a click triggered from the below lists

    var $track = $(this),
        $player = $track.closest('.sc-player'),
        trackId = $track.data('sc-track').id,
        play = $player.is(':not(.playing)') || $track.is(':not(.active)');

    var activeurl = $track.find('a').attr('href');

            // console.log("currently active url" + activeurl +'')

             //console.log("click trackID" + $track +"");
           //  console.log("my object: %o", $track)
            // console.log("my object: %o", activeurl)


    if (play) {
      onPlay($player, trackId, activeurl);

    }else{
      onPause($player, trackId, activeurl);
    }

   // console.log("click trackID" + trackId+"");

    $track.addClass('active').siblings('li').removeClass('active');
    $('.artworks li', $player).each(function(index) {
      $(this).toggleClass('active', index === trackId);
    });

    // ensure the player is visble at top - if not hidden
    forceheadroompin();
    // if hidden - assign a class and remove it again after a few seconds - signifying the change

      $("body").addClass("pulsate-player-icon");
           // console.log("forcing pulstate")
    
        setTimeout(function() {

            $("body").removeClass("pulsate-player-icon");
           // console.log("removeng pulstate")


      }, 1000);



    return false;
  });


  // selecting tracks outside the "radio container":
  // from the list find the associated item in the above list and peform a click event on this.  
  // also do the same for blocks
  //.radio-items li .radio-item, // archive itmes + single other shows - reivew this?
  //.sound-block .radio-item' // blocks
  // body.single  li .radio-item // single item (targetting thefirst one)
  $(document).on('click','.radio-items li .radio-item, .sound-block .radio-item, body.single .single-radio-item ', function(event) {

// I need to allow the click of view - how to do this?
  console.log("click > .radio-items li .radio-item");

    var $radioitem = $(this),
        radioitemUrl = $radioitem.closest('li').data('tracklink'); // sc permalink of the track
        
        if (!($radioitem.closest('li').hasClass('first-item-active'))) {
          // is the first item
         // console.log("is NOT first");
          //$('li.radio-item-li-1').addClass('show-play-icon');

        } // if is 1st item at the tope
        else if($radioitem.closest('li').hasClass('radio-item-li-1')) {
          // is not the first item
          //console.log("is first");
          //$('li.radio-item-li-1').removeClass('first-item-active');

        }
  

       //console.log("clicked radioitemUrl" +radioitemUrl+"");
  
   //  var $tracklistitem = $('.sc-trackslist li').find('a').attr("href", radioitemUrl);
      

       var $tracklistitem = $('.sc-trackslist li a[href="'+radioitemUrl+'"]');

        $tracklistitemlink = $tracklistitem.closest("li");
        console.log("associated $tracklistitem" + $tracklistitem+"");
        console.log("associated $tracklistitemlink" + $tracklistitemlink+"");

      //  $tracklistitem.css("background-color", "red");

       // $tracklistitemlink.css("background-color", "yellow");

       // $radioitem.css("background-color", "green")

       $tracklistitemlink.trigger( "click" ); // trigger the click in the top list
       $('body').attr("data-activescurl",radioitemUrl); // set id to body data

       // ensure the player is pinned:
       forceheadroompin();

    // $tracklistitemlink.click();
      // $tracklistitemlink.trigger( "click" );

  /*      play = $player.is(':not(.playing)') || $track.is(':not(.active)');
    if (play) {
      onPlay($player, trackId);
    }else{
      onPause($player);
    }
*/
 // console.log("click trackID" + trackId+"");
/*
    $track.addClass('active').siblings('li').removeClass('active');
    $('.artworks li', $player).each(function(index) {
      $(this).toggleClass('active', index === trackId);
    });*/
    return false;
  });
   // end selecting tracks in the bottom list


  var scrub = function(node, xPos) {
    var $scrubber = $(node).closest('.sc-time-span'),
        $buffer = $scrubber.find('.sc-buffer'),
        $available = $scrubber.find('.sc-waveform-container img'),
        $player = $scrubber.closest('.sc-player'),
        relative = Math.min($buffer.width(), (xPos  - $available.offset().left)) / $available.width();
    onSeek($player, relative);
  };

  var onTouchMove = function(ev) {
    if (ev.targetTouches.length === 1) {
      scrub(ev.target, ev.targetTouches && ev.targetTouches.length && ev.targetTouches[0].clientX);
      ev.preventDefault();
    }
  };


  // seeking in the loaded track buffer
  $(document)
    .on('click','.sc-time-span', function(event) {
      scrub(this, event.pageX);

      console.log(scrub(this, event.pageX))
      return false;
    })
    .on('touchstart','.sc-time-span', function(event) {
      this.addEventListener('touchmove', onTouchMove, false);
      event.originalEvent.preventDefault();
    })
    .on('touchend','.sc-time-span', function(event) {
      this.removeEventListener('touchmove', onTouchMove, false);
      event.originalEvent.preventDefault();
    });

  // changing volume in the player
  var startVolumeTracking = function(node, startEvent) {
    var $node = $(node),
        originX = $node.offset().left,
        originWidth = $node.width(),
        getVolume = function(x) {
          return Math.floor(((x - originX)/originWidth)*100);
        },
        update = function(event) {
          $doc.trigger({type: 'scPlayer:onVolumeChange', volume: getVolume(event.pageX)});
        };
    $node.bind('mousemove.sc-player', update);
    update(startEvent);
  };

  var stopVolumeTracking = function(node, event) {
    $(node).unbind('mousemove.sc-player');
  };

  $(document)
    .on('mousedown','.sc-volume-slider', function(event) {
      startVolumeTracking(this, event);
    })
    .on('mouseup','.sc-volume-slider', function(event) {
      stopVolumeTracking(this, event);
    });

  $doc.bind('scPlayer:onVolumeChange', function(event) {
    $('span.sc-volume-status').css({width: event.volume + '%'});
  });
  // -------------------------------------------------------------------

  // the default Auto-Initialization
  $(function() {
    if($.isFunction($.scPlayer.defaults.onDomReady)){
      $.scPlayer.defaults.onDomReady();

      //    initheadroom();
    initheadroom();

    }
  });

})(jQuery);
       

