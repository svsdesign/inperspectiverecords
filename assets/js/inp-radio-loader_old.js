var radioscriptloaded, // set as undefined initially;//
    scsjsonobject, // new track
    activescsjsonobject, // active track
    newitemurl,
    itemurl,
    sound;



//console.log("inp-radio-loader.js running. This only loads once")


 jQuery(document).ready(function($) {

    // console.log("radioscriptloaded out side if defined: currently is "+radioscriptloaded+"" )
 
    if (typeof radioscriptloaded === 'undefined') { // if undefined we want to set up the radio      
 
        if ($('body.single-radio, body.post-type-archive-radio').length > 0) { //- but only if we have a radio item - or set up regardless?

         //was:  console.log("$('body.single-radio, body.post-type-archive-radio')" );
          // console.log("$('body.single-radio" );
          radioscriptloaded = true;  // now defined
        //  newitemurl = $('#show-details').data("radio-link"); // this is a sc url - but only exist on .single-radio
        //  console.log("new url item ="+newitemurl+"")
          //console.log("existing url item ="+itemurl+"")


            if (typeof itemurl === 'undefined') { // if object not defined yet.
              
                      // if not defined yet, we need to find the scsjonobject
                      // and hecause we are on a single radio page, there should the first available data attribute
//                      itemurl = $('#radio-code').data("url");
                      if ($('body').hasClass('single-radio')) {
                      itemurl = $('#show-details').data("radio-link"); // this is a sc url but only exist on the single page atm 
                     console.log('body.singleradio')
                      } else {
                    
                    // console.log("else iunnit? ")
                        console.log('body.post-type-archive-radio')

                        itemurl = $('.top-container li:first').data("tracklink"); //so on archive we just pull the first item
                        console.log("itemurl = " +itemurl +"");
                       
                      }

                      //console.log("itemurl ="+itemurl+"")

                      SC.initialize({
                          client_id: '853fdb79a14a9ed748ec9fe482e859dd' // who'is this client ID?
                      });


                 
                      // permalink to a track
                      var track_url = itemurl;//feedsclink;

                      var myCustomFunction = function (track) {

                       //console.log("my custom funcion new track" + track.title +"" );

                       //console.log("my custom funcion new track id" + track.id +"" ); // track.id gives you the ID of the song
                       // console.log("track id" + track.id +"" ); // track.id gives you the ID of the song
                        var settrackid = track.id;
                        var $activeitem = $('.sc-trackslist li a[href="'+itemurl+'"]').closest('li');
                        console.log('$activeitem url' + itemurl+ "");

                       // $('body').data("scjson", settrackid); // set id to body data
 
                        $('body').attr("data-scjson", settrackid); // set id to body data
                        $('body').attr("data-activescurl",itemurl); // this the active item in

                        $('.sc-trackslist li').removeClass('active');
                        //$('.sc-trackslist li').addClass('not-active');

                        $activeitem.addClass('active');
                       // $activeitem.addClass('hello');

                       // $activeitem.css("background-color","orange")


                        console.log('$activeitem' + $activeitem+ "");

                      };



                      function reload_js(src) {                                


                      $('<script>').attr('src', src).appendTo('head'); // append the script for the first time?
                       console.log("reload_js(src)");


                          function wait(){ // wait for the scrip to have loaded - this works - but probably not a very good way of approaching it
                          SC.resolve(track_url).then(myCustomFunction);
                          }
                          setTimeout(wait, 2000);

                      } // function reload_js(src)

                      // run this only once? - but what if updating tracklist etc? Sure would have to ensure there are global.variabels in place?
                      reload_js('http://localhost:8888/inp-wp/wp-content/themes/inperspectiverecords/assets/js/inp-radio_v4.js'); 
                      



               // console.log('scsjsonobject'+scsjsonobject+"");

            } else if (newitemurl === itemurl) { //

              // console.log('itemurl'+itemurl+"");
             //  console.log('itemurl'+newitemurl+"");
             //  console.log("this means the new page is the currently active item - not sure this is ever going to be the case ");
               // so i don't want to change the newitemurl or itemurl

          
            } else { // if already defined
            //   console.log("this means the new page is not the currently active item - not sure this is ever going to be tbe case?")
             //  itemurl = $('#show-details').data("radio-link");




            //    console.log(' radioscriptloaded should be true;  '+radioscriptloaded+"");
           //     console.log('active scsjsonobject'+activescsjsonobject+"");
            //    console.log('scsjsonobject'+scsjsonobject+"");

            }// if 



        // .single radio      
        } else if ($('body').length > 0) {

        console.log('if body - and script not define yet');
        return;

        };  // if body or radio class


    } else { // if the radio script already defined:

      console.log("radio script already defined - not sure we can ever get to this if statement, because once we load the script straight away - if defines itself and that the last time this .js file loads I think? "); //

         if ($('body.single-radio, body.post-type-archive-radio').length > 0) { //- but only if we have a radio

        radioscriptloaded = true;  // now defined
        newitemurl = $('#show-details').data("radio-link");
      //  console.log("new url item ="+newitemurl+"")
       // console.log("existing url item ="+itemurl+"")


            if (typeof itemurl === 'undefined') { // if object not defined yet.
              
             // console.log("not sure this is possible - so remove?")
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

                       // console.log("my custom funcion new track id" + track.id +"" ); // track.id gives you the ID of the song
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

            //   console.log('itemurl'+itemurl+"");
            //   console.log('itemurl'+newitemurl+"");
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
                     // console.log("track_url" + track_url +"" ); // track.id gives you the ID of the song

                    var myCustomFunction = function (track) {

                   //   console.log("track" + track +"" ); // track.id gives you the ID of the song

                    //  console.log("my custom funcion new track id" + track.id +"" ); // track.id gives you the ID of the song
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

                  /* function reload_js(src) {                                

                       $('<script>').attr('src', src).appendTo('head'); // append the script for the first time?
                       //console.log("body.single-radio > this src = " + src + "");

                    } // function reload_js(src)
*/
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

               //  console.log('if $body  - scsjsonobject'+scsjsonobject+"");

         };  // if body or radio class
              

    } //  if (typeof radioscriptloaded === 'undefined')





 }); ///  ENDS  read.QUERY

     