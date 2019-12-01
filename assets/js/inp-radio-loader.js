var radioscriptloaded, // set as undefined initially;//
    scsjsonobject, // new track
    activescsjsonobject, // active track
    newitemurl,
    itemurl,
    dir = theme_directory;

  //  sound;



//console.log("inp-radio-loader.js running. This only loads once")
//console.log("theme_directory" + dir+"");

 jQuery(document).ready(function($) {

    // console.log("radioscriptloaded out side if defined: currently is "+radioscriptloaded+"" )
     function checkScript(){

        if (typeof radioscriptloaded === 'undefined') { // if undefined we want to set up the radio      
     
            //if ($('body.single-radio, body.post-type-archive-radio').length > 0) { //- but only if we have a radio item - or set up regardless?
            if ($('.radio-container').length > 0) { // if container exists - 

             //was:  console.log("$('body.single-radio, body.post-type-archive-radio')" );
              // console.log("$('body.single-radio" );
            //  newitemurl = $('#show-details').data("radio-link"); // this is a sc url - but only exist on .single-radio
            //  console.log("new url item ="+newitemurl+"")
              //console.log("existing url item ="+itemurl+"")


                if (typeof itemurl === 'undefined') { // if object not defined yet.
                  
                          // if not defined yet, we need to find the scsjonobject
                          // and hecause we are on a single radio page, there should the first available data attribute
                         //  itemurl = $('#radio-code').data("url");
                          if ($('body').hasClass('single-radio')) {
                             
                            radioscriptloaded = true;  // now defined
                            itemurl = $('#show-details').data("radio-link"); // this is a sc url but only exist on the single page atm 
                          
                            // permalink to a track
                            var track_url = itemurl;//feedsclink;
                          
                            console.log('body.singleradio')
                            console.log('itemurl on single radio page ='+itemurl+'')

                            reload_js(''+dir+'/assets/js/inp-radio_v4.js'); 

                          } else if ($('body').hasClass('post-type-archive-radio')) {
                            
                            radioscriptloaded = true;  // now defined


// ISSUES - when coming from somwhere else the archive page needs to have a link for people to play the top one.
// it currently just pauses the existing track if you click the play

                            // console.log("else iunnit? ")
                            console.log('body.post-type-archive-radio')

                            itemurl = $('.top-container li:first').data("tracklink"); //so on archive we just pull the first item
                            console.log("itemurl = " +itemurl +"");

                     
                          // permalink to a track
                          var track_url = itemurl;//feedsclink;
                          //reload_js('http://localhost:8888/inp-wp/wp-content/themes/inperspectiverecords/assets/js/inp-radio_v4.js'); 
                            reload_js(''+dir+'/assets/js/inp-radio_v4.js'); 

                          } else if ($('_.radio-item li').length > 0){ // we want to detect if there's a link to a sc url?
                             // I'm not sure this is ever used? not on the archve page
                             //suggest deleting this ?
                             // $this is not define
                              console.log("I'm not sure this is ever used? - delete if neeedd");

                             /* $thisitem = $this;
                              radioscriptloaded = true;  // now defined

                              itemurl = $thisitem.data("radio-link"); // this is a sc url but only exist on the single page atm 

                              console.log(".radio-item li itemurl = " +itemurl +"");

                       
                              // permalink to a track
                              var track_url = itemurl;//feedsclink;

                              reload_js(''+dir+'/assets/js/inp-radio_v4.js'); 
                              */

    
                            } else if ($('.sound-block').length > 0){ 

                                console.log("we have a soundblock");

                              // if there's more than one item - im not sure we need to run this twice?
                              // the script I load in, should be able to check - so maybe just load the first one?
                              // this currently not able to retreive the associated data (trakclink)

                                console.log("$this" + $(this)+"")
                                var itemurl =  $('body .radio-item:first').data("tracklink"); // pull in the first item only?


                              //  $('.radio-item').each(function() {
                                  
                                   // console.log("radio item each");
                                  //  $thisitem = $(this).closest('.radio-item'); 
                                   radioscriptloaded = true;  // now defined


                                    //                                    console.log("$thisitem " + $thisitem +"");

                      
                                   // itemurl = $thisitem.data('tracklink');
                                     
                                   console.log("radio block item itemurl = " +itemurl +"");
                                  //  console.log("sound block tracklink " + $thisitem.data("tracklink") +"");

                                  // permalink to a track  
                                var track_url = itemurl;//feedsclink;
                                    console.log("track_url " +track_url +"");

                                    reload_js(''+dir+'/assets/js/inp-radio_v4.js'); 
                      


                          
//                            console.log("sound block tracklink " + $thisitem.data("tracklink") +"");

                            //itemurl = $('.sound-block .radio-item').data("tracklink"); // this is a sc url but only exist on the single page atm 


                     
                          // permalink to a track
                          //  var track_url = itemurl;//feedsclink;

                            //reload_js('http://localhost:8888/inp-wp/wp-content/themes/inperspectiverecords/assets/js/inp-radio_v4.js'); 


                          


                          } else {


                            // console.log("else iunnit? ")
                            console.log('body - but we wont have a radio item yet - so keep look for attrchange to the body class?' )
                            // here I want to look for dom changes and thenn whenn they happend we run - checkScript() 
                            //checkScript()
                            // This makes a lot changes and then runs it immediately again - not sure this is very good appraoch

                                  $("body").attrchange({
                                    trackValues: true, // set to true so that the event object is updated with old & new values
                                    callback: function(evnt) {
                                        if(evnt.attributeName == "class") { // which attribute you want to watch for changes
                                            console.log("a class changes existed");

                                            // var bodyclass = $("body").attr("class"); 
                                            /// console.log(bodyclass); 
                                            //console.log(evnt.newValue); 

                                        
                                          //start review this - ensure all if statemnents are consolidated to ensure I'm not running anything more than once

                                               if (evnt.newValue.search(/has-sound-block/i) == -1){
                                                 
                                                 console.log("we dont have a sound block class - do nothing");

                                               } else {
                                                 
                                                 console.log("we DO have a block class - run script again");
                                                 checkScript(); // initial run 

                                               }

                                                // review this Part 2 - establish why again we need to run this on archive page?
                                                
                                                if (evnt.newValue.search(/post-type-archive-radio/i) == -1)
                                                //if((evnt.newValue.search(/post-type-archive-radio/i) == -1) || (evnt.newValue.search(/single-radio/i) == -1))
                                                { // "open" is the class name you search for inside "class" attribute
                                                 console.log("we dont have archive radio class OR sound block class");
                                                 // yeah but this would also be true mean that if the radio wone did exist, but the archive didn't 

                                                } else {
                                                 
                                                //  console.log("else - so we might have the archive or soundblock class ");
                                                 console.log("we DO have post-type-archive-radio - run script again");

                                                 checkScript(); // initial run 

                                                }//if(evnt.newValue.search(/post-type-archive-radio/i) == -1)
                                                
                                                // end review this Part 2 


                                            //end review this - Part 1

                                        }// if(evnt.attributeName == "class") { 
                                    }
                                });

                          } //else

                          //console.log("itemurl ="+itemurl+"")

                          SC.initialize({
                           //   client_id: '853fdb79a14a9ed748ec9fe482e859dd' // who'is this client ID? Works locally and in incognito
                              //client_id: '95f22ed54a5c297b1c41f72d713623ef' // Client id foudn here https://github.com/mediaelement/mediaelement/issues/2501 -
                              client_id: 'ssV1Qfh3hGcBHMcuZ3bz3xHb3aoP5KUB'
                          });
                          //Uncaught (in promise) DOMException: The play() request was interrupted by a call to pause().
                          //https://developers.google.com/web/updates/2017/06/play-request-was-interrupted < review

                          console.log("SC"+ SC +"");

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
 

                } else if (newitemurl === itemurl) {
      
                  // console.log('itemurl'+itemurl+"");            
            
                } else { // if already defined
                
                }// if 


            // .single radio      
            /*} else if ($('body').length > 0) {

            console.log('if body - i.e not single or radio archive - and script not defined yet');
            checkScript(); // go back and check again?
            console.log('checkScript(); // go back and check again?');
*/

            };  // if .radio-container


        } else { // if the radio script already defined:
        

          console.log('radio script defined');
        //  console.log("radio script already defined - so no need to reload it"); //

             if ($('body').hasClass('post-type-archive-radio')) {
            
             console.log("Radio script defined - post-type-archive-radio");
             //if already defined on arvhice post - maybe we need to add/change the classes to resovle the following issue: 
  
// ISSUES - when coming from somwhere else the archive page needs to have a link for people to play the top one.
// I think it currently just pauses the existing track if you click the play?

 
              } // if body has class: .post-type-archive-radio


        } //  if (typeof radioscriptloaded === 'undefined')


     } // function checkScript()

     WaitForSoundcloud();

function WaitForSoundcloud() {
    if(typeof SC == "undefined") {
        setTimeout(WaitForSoundcloud, 500);
    } else {

       checkScript(); // initial run

     /*   SC.initialize({
          client_id: 'xxxxxxxx'
        });

        SC.oEmbed(track_url, {}).then(function(oEmbed) {
            console.log('oEmbed response: ', oEmbed);
        });

       */ 
    }

   // https://stackoverflow.com/questions/30906134/sc-is-not-defined-when-using-soundcloud-sdk
   // talk about thi https://jshint.com/docs/

}


 }); ///  ENDS  read.QUERY

     