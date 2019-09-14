var radioscriptloaded, // set as undefined initially;//
    scsjsonobject, // new track
    activescsjsonobject, // active track
    newitemurl,
    itemurl;
  //  sound;



//console.log("inp-radio-loader.js running. This only loads once")


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
    //                      itemurl = $('#radio-code').data("url");
                          if ($('body').hasClass('single-radio')) {
                                          radioscriptloaded = true;  // now defined

                          itemurl = $('#show-details').data("radio-link"); // this is a sc url but only exist on the single page atm 
                         console.log('body.singleradio')



                     
                          // permalink to a track
                          var track_url = itemurl;//feedsclink;


                          reload_js('http://localhost:8888/inp-wp/wp-content/themes/inperspectiverecords/assets/js/inp-radio_v4.js'); 


                          } else if ($('body').hasClass('post-type-archive-radio')) {
                                      radioscriptloaded = true;  // now defined

                        // console.log("else iunnit? ")
                            console.log('body.post-type-archive-radio')

                            itemurl = $('.top-container li:first').data("tracklink"); //so on archive we just pull the first item
                            console.log("itemurl = " +itemurl +"");

                     
                          // permalink to a track
                          var track_url = itemurl;//feedsclink;
                          reload_js('http://localhost:8888/inp-wp/wp-content/themes/inperspectiverecords/assets/js/inp-radio_v4.js'); 

                          } else if ($('.radio-item li').length > 0){ // we want to detect if there's a link to a sc url?
                           
                            $thisitem = $this;
                                          radioscriptloaded = true;  // now defined

                            itemurl = $thisitem.data("radio-link"); // this is a sc url but only exist on the single page atm 

                            console.log(".radio-item li itemurl = " +itemurl +"");

                     
                          // permalink to a track
                          var track_url = itemurl;//feedsclink;

                            reload_js('http://localhost:8888/inp-wp/wp-content/themes/inperspectiverecords/assets/js/inp-radio_v4.js'); 


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
                                            console.log("class changes exist");

                                            if(evnt.newValue.search(/post-type-archive-radio/i) == -1)
                                            //if((evnt.newValue.search(/post-type-archive-radio/i) == -1) || (evnt.newValue.search(/single-radio/i) == -1))
                                             { // "open" is the class name you search for inside "class" attribute
                                             console.log("we dont have archive radio class");

                                                // your code to execute goes here...
                                            } else{
                                             console.log("not the classes we want - so don't run?");
                                             checkScript(); // initial run 



                                            }
                                        }
                                    }
                                });

                          } //else

                          //console.log("itemurl ="+itemurl+"")

                          SC.initialize({
                              client_id: '853fdb79a14a9ed748ec9fe482e859dd' // who'is this client ID?
                          });



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

          console.log("radio script already defined - so no need to reload it"); //


        } //  if (typeof radioscriptloaded === 'undefined')


     } // function checkScript()
    checkScript(); // initial run


 }); ///  ENDS  read.QUERY

     