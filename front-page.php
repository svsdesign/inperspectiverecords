<?php
/*
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   

 TO DO: REVIEW THE USAGE OF "<article></article> " Enbsure html5 compliant - worith looing though all post based php templates.

 */

get_header();?>

    <!-- START featured area -->
    <?php if ($sitelocation = 'local'){
     $homepage = new WP_Query("page_id=681"); // local - was 5
    } else {// not local:
     $homepage = new WP_Query("page_id=681"); // live
    }

    while ( $homepage->have_posts() ) : $homepage->the_post();

        $excludedposts = array();// declare array of "exclude" posts
        $excludednewsposts = array();// declare array of "exclude" posts - do we need to have two array for exclusion?

        if( have_rows('featured_posts') ):?>

            <div class="featured-home-wrapper">

                <div class="featured-home-carousel">

                    <?php while ( have_rows('featured_posts') ) : the_row();

                    $excludedposts[] = get_sub_field('select_post'); // push values into array and save for later
                    $thispostid = get_sub_field('select_post');
                    $thisposttype = get_post_type( $thispostid );
                    $thistemplatename = 'content-'. $thisposttype .'.php';
                    $homefeatured = true; ?>

                        <div class="featured-home-item featured-home-item-<?php echo $thisposttype?>">
  
                            <div class="inner-home-item">
  
                                 <?php //the_title($thispostid); 
                                      //echo $thistemplatename;  

                                include(locate_template($thistemplatename));?>

                            </div><!-- class="inner-home-item"-->

                        </div><!-- .feature-home-item-->

                    <?php endwhile;?>

                </div><!--.featured-home-carousel-->       
              
            </div><!--.featured-home-wrapper-->       

        <?php endif; 

        if( have_rows('featured_news') ):?>

              <div class="featured-news-home-wrapper">

                 <?php while ( have_rows('featured_news') ) : the_row();
                  $excludednewsposts[] = get_sub_field('select_post'); // push values into array and save for later
                  $thispostid = get_sub_field('select_post');
                  $thisposttype = get_post_type( $thispostid );
                  $thistemplatename = 'content-'. $thisposttype .'.php';
                  $homefeatured = true;
                  ?>

                      <div class="featured-home-item featured-home-item-<?php echo $thisposttype?>">

                      <?php include(locate_template($thistemplatename));?>

                      </div><!-- .feature-home-item-->

                  <?php endwhile;?>
          
            </div><!--.featured-home-wrapper-->       

        <?php endif;
      
    endwhile; 
    wp_reset_query(); 
    //print $excludedposts[];
    $excludedposts = implode(',', $excludedposts);
    $excludednewsposts = implode(',', $excludednewsposts);
 //   echo 'featuredpost:';
 //   echo $excludedposts;
  // echo 'featurednewspost:';
  // echo $excludednewsposts;
    ?> 

    <!-- END featured area -->

    <!-- START NEWS "archive posts" -->

    <div class="news-home-wrapper container grid">
      
        <?php
        // set the "paged" parameter (use 'page' if the query is on a static front page)
        $newshomepaged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $newsargs = array(
          'posts_per_page' => 9, // reivew this because won'tb e right
          'post_type' => 'news',
          'paged' => $newshomepaged,
          'post__not_in' => array($excludednewsposts),
         // $excludednewsposts
         // ensure to exclude the news items here - useing array variable:

        );
        // the query
        $news_query = new WP_Query( $newsargs ); 
          
        if ( $news_query->have_posts() ) :?>


          <?php // are we on page one- so we can include the first item
          //if(1 == $paged):
          //$pageno = 'first';?>
          <?php //endif;  //  are we on page 1 ?>

              <div class="page-title-positioner outer-grid-item outer-grid-item-sm-8 sticky">
                                
                  <div class="page-titler">
                            
                    <span class="inner">
                    News
                    </span><!-- inner -->

                    </div> <!--.page-title -->

              </div><!-- .page-title-position -->
              
              <div class="grid inner outer-grid-item outer-grid-item-xs-6">

                  <?php
                  // the loop
                  $newsitemnumber = 1;
                  while ( $news_query->have_posts() ) : $news_query->the_post(); 

                    $newsid = get_the_ID(); 
                    $newsitemnumber++;      
                    // end get fields
                    // echo $newsid;
                    if  ($newsitemnumber > 10) {// after the 10th item
                    // for article items; 
                    $layoutclass = 'grid-item-md-3 grid-item-lg-2';
                    } else{
                    //$layoutclass = $itemnumber.'-number';

                      //    <!-- START NEWS "more" listed archive posts" -->
                      // <!-- END NEWS "more" listed archive posts" -->
              
                    };?>
            
                    <article class="news-item item-<?php echo $newsitemnumber;?> grid-item <?php echo $layoutclass;?> grid-item-sm-6" data-itemnumber="<?php echo $newsitemnumnber;?>">
                      <?php get_template_part( 'content', 'news' );?>
                    </article>

                  <?php
                  // End the loop.
                  endwhile;?>
        
              </div><!-- .grid inner outer-grid-item outer-grid-item-xs-6 -->

           <?php global $news_query; // this global variable also used on news archives; so consider setting other global variable?          $big = 999999999; // need an unlikely integer

          $newspaginate = paginate_links( array(
              'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
              'format' => '?paged=%#%',
              'current' => max( 1, get_query_var('paged')),
              'total' => $news_query->max_num_pages,
              'prev_next' =>true,
              'type' =>  'plain',//list',//array',//list',
               'prev_text' => '<div class="small nav-previous align-left"><svg class="svg-icon previous-arrow-icon" width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g fill="#FFFFFF" fill-rule="nonzero"> <polygon transform="translate(19.874778, 20.000000) scale(-1, 1) rotate(-270.000000) translate(-19.874778, -20.000000) " points="19.8747779 29.2278846 37.6296018 6.12522213 39.8747779 7.85068148 19.8747779 33.8747779 -0.12522213 7.85068148 2.1199539 6.12522213"></polygon> </g> </g> </svg></div><div class="text">Newer Shows</div>',
              'next_text' => '<div class="small nav-next align-right"><svg class="svg-icon next-arrow-icon" width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g fill="#FFFFFF" fill-rule="nonzero"> <polygon transform="translate(19.874778, 20.000000) scale(-1, 1) rotate(-270.000000) translate(-19.874778, -20.000000) " points="19.8747779 29.2278846 37.6296018 6.12522213 39.8747779 7.85068148 19.8747779 33.8747779 -0.12522213 7.85068148 2.1199539 6.12522213"></polygon> </g> </g> </svg></div><div class="text">Older Shows</div>',
          
          ));
          if ($newspaginate):?>
      
            <div class="page-nav outer-grid-item outer-grid-item-xs-6 inner">

              <div class="grid">

                <div class="page-nav-wrapper grid-item grid-item-xs-6">

                    <a href="<?php echo get_home_url(); ?>/news/page/2">
                      View Older News
                    </a>
              
                </div>

              </div>  <!-- ".grid-->     

            </div>  <!-- ".page-nav-->     

          <?php endif;  // if we have paginated links ?>

        <?php endif;  // if ( $news_query->have_posts


    wp_reset_query();?>

    </div><!-- class="news-home-wrapper"-->

    <!-- END NEWS "archive posts" -->


    <!-- START RADIO area -->

    <div class="radio-home-wrapper">
      
        <?php
          // set the "paged" parameter (use 'page' if the query is on a static front page)
          $radiopaged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
          $radioargs = array(
          'posts_per_page' => 9, // review
          'post_type' => 'radio',
          'post_status' => 'publish', // only show published events

          'paged' => $radiopaged,
       //   'post__not_in' => $excludednewsposts // ensure exclusion across cpt's: event, radio, artists
          'post__not_in' => array($excludedposts), // this amongst others is radio "featured"
          'orderby' =>  'meta_value',
          'meta_key' =>  'show_start_date',
          'meta_query' => array(			 		
                'relation' => 'AND',
                array(
                    'key'       => 'show_start_date',
                    'compare'   => '>=', // starts after or equal
                    'value'     => '0000000000' //$now //'0000000000
                ),
                array(
                    'key'       => 'show_end_date',
                    'compare'   => '<=', // starts before or equal
                    'value'     => $now//'9999999999'
                ),
                array(
                'key'	  	=> 'is_item_public', // only allow items that are "public" - by default value either not set or 0 (if set)
                //'value'	  	=> 'true',
                //'compare' 	=> 'NOT EXISTS'
                'value' => '1',
              'compare' => '==' // not really needed, this is the default
              )
  
            )
        );
        // the query
        $radio_query = new WP_Query( $radioargs ); 
          
        if ( $radio_query->have_posts() ) :?>



            <div class="grid inner outer-grid-item outer-grid-item-xs-6">
                    
                <div class="page-title-positioner outer-grid-item outer-grid-item-sm-6 sticky">
                      
                    <div class="page-titler">
                    
                      <span class="inner">
                      Radio
                      </span><!-- inner -->

                    </div> <!--.page-title -->

                </div><!-- .page-title-position -->
                
                <div class="container top-container radio-items grid">		
            
                  <?php // are we on page one- so we can include the first item
                  //if(1 == $paged):
                  //$pageno = 'first';?>
                  <?php //endif;  //  are we on page 1 ?>
                
                  <?php
                  // the loop
                  $radioitemnumber = 1;
                  while ( $radio_query->have_posts() ) : $radio_query->the_post(); 

                    $radioid = get_the_ID(); 
                    $showtitle = get_the_title();// title						
                    $showstart = get_field('show_start_date'); // date and time picker
                    $showend = get_field('show_end_date');  // date and time picker
                    $featureimage =  get_field('feature_image'); // image
                    $featureimagecredit =  get_field('feature_image_credit');  // text
                    $description =  get_field('show_description');  // text area							 
                    $soundcloudlink =  get_field('soundcloud_link'); //text
                    $soundcloudembed =  get_field('soundcloud_embed'); // iframe / file?
                    $public =  get_field('is_item_public'); // iframe / file?

                    // end get fields
                      // echo $newsid;
                    if  ($radioitemnumber == 1): // after the 10th item
                    // 	if ($radioitemnumber == 1): // of first item of archive :?>
                          <?php if($featureimage): ?>
            
                            <div class="cover-image-item home-showcase outer-grid-item outer-grid-item-sm-8" style="background-image: url('<?php echo $featureimage;?>');">
                            </div><!-- image-item -->
            
                          <?php endif; //$featureimage  ?>
                          
                          <li data-trackid="<?php echo $radioid?>" data-tracklink="<?php echo $soundcloudlink;?>" class="radio-item-li radio-item-li-<?php echo $radioitemnumber;?> outer-grid-item inner outer-grid-item-xs-8 outer-grid-item-sm-6 <?php if ($radioitemnumber != "1"):?>grid-item-md-4<?php endif;?>">
                            
                            <div class="wrapping grid">	
                            
                              <a class="radio-item radio-item-<?php echo $radioitemnumber;?> grid-item grid-item-xs-1" title="play <?php echo $showtitle; ?>" id="radio-item-<?php echo $radioid?>">
            
                                  <div class="play-icon-wrap">
              
                                      <div class="play-toggle">
                
                                        <svg id="playertoggle_<?php echo $radioid?>" class="playertoggle"  width="100%" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"> 
                                          
                                          <path class="play-inline" id="play_<?php echo $radioid?>" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> 
                                          <path class="play-left-inline"id="play-left_<?php echo $radioid?>" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/> 
                                          <path class="play-right-inline" id="play-right_<?php echo $radioid?>" d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> 
                                          <path opacity="0" id="pause_<?php echo $radioid?>" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> 
                                          <path opacity="0" id="pause-left_<?php echo $radioid?>" d="M447,1000 0,1000 0,0 447,0 447,500.084 z" fill-rule="nonzero"/> 
                                          <path opacity="0" id="pause-right_<?php echo $radioid?>" d="M1000,1000 553,1000 553,0 1000,0 1000,500 z" fill-rule="nonzero"/> 
                                          <path style="display:none;" id="play-path_<?php echo $radioid?>" d="M1000,500.083 501.186,251.083 501.186,749.084" fill-rule="nonzero"/> 
                                          <path style="display:none;" id="play-path-left_<?php echo $radioid?>" d="M501.186,250.593 0,0 0,1000 501.186,749.407 z" fill-rule="nonzero"/>
                                          <path style="display:none;" id="play-path-right_<?php echo $radioid?>" d="M1000,500.083 501.186,251.083 501.186,749.084 z" fill-rule="nonzero"/> 
                                        
                                        </svg> 
                
                                      </div>
                
                                  </div>
                                            
                              </a><!-- .radio-item outer-grid-item outer-grid-item-sm-8-->
                            
                              <a class="view-radio-item view-radio-item-<?php echo $radioitemnumber;?> grid-item grid-item-xs-5 grid-item-sm-4 grid-item-md-5" href="<?php echo the_permalink($radioid);?>" title="view <?php echo $showtitle; ?>" id="view-radio-item-<?php echo $radioid?>">
                                
                                <div class="details-wrap">
                                    
                                  <div class="radio-date">
                                    <?php $showstart = get_field('show_start_date'); echo date_i18n('jS F Y', $showstart);  ?>
                                  </div><!-- .date -->
                                  
                                  <div class="radio-view-item">
                                    View Show
                                  </div><!--view-item-->
                                  
            
                                  <?php if($showtitle): ?>
            
                                    <div class="radio-name">	
                                    <?php echo $showtitle; ?>
                                    </div><!-- .event-name -->
                                
                                  <?php endif; //$name ?>	
            
                                </div><!--.outer-grid-item inner -->
            
                              </a>
                              
                            </div><!-- wrapping -->
            
                          </li>
                    
                    <?php else:// other itmems
                      //else if ($radioitemnumber == 1){ // NOt the first item
                    ?>
          
                        <li data-trackid="<?php echo $radioid?>" data-tracklink="<?php echo $soundcloudlink;?>" class="test radio-item-li  <?php if ($radioitemnumber != "1"):?><?php if ($radioitemnumber > "7"):?> outer-grid-item outer-grid-item-xs-6 <?php else:?> grid-item grid-item-xs-6 grid-item-md-3 <?php endif;?> <?php else:?> grid-item grid-item-xs-6 <?php endif;?>">
          
                            <div class="wrapping <?php if ($radioitemnumber > "7")://if items on rows?>grid<?php endif;?>">	
                            
                              <a class="radio-item radio-item-<?php echo $radioitemnumber;?> <?php if ($radioitemnumber > "7")://if items on rows?>grid-item grid-item-xs-1<?php endif;?>" title="play <?php echo $showtitle; ?>" id="radio-item-<?php echo $radioid?>">
            
                                <?php get_template_part( 'content-radio' ); // reivew this?>
                                
                              </a><!-- .radio-item outer-grid-item outer-grid-item-sm-8-->
                            
                              <a class="view-radio-item view-radio-item-<?php echo $radioitemnumber;?> <?php if ($radioitemnumber > "7")://if items on rows?>grid-item grid-item-xs-5<?php endif;?>" href="<?php echo the_permalink();?>" title="view <?php echo $showtitle; ?>" id="view-radio-item-<?php echo $radioid?>">
                                
                                <div class="details-wrap"><!-- classes - delete? outer-grid-item inner outer-grid-item-sm-6"-->
                                    
                                  <div class="radio-date">
                                    <?php $showstart = get_field('show_start_date'); echo date_i18n('jS F Y', $showstart);  ?>
                                  </div><!-- .date -->
                                  
                                  <div class="radio-view-item">
                                    View Show
                                  </div><!--view-item-->
                                  
            
                                  <?php if($showtitle): ?>
            
                                    <div class="radio-name">	
                                    <?php echo $showtitle; ?>
                                    </div><!-- .event-name -->
                                
                                  <?php endif; //$name ?>	
            
                                </div><!--.details-wrap -->
            
                              </a>
                              
                            </div><!-- wrapping -->
          
                        </li>
          
                    <?php endif;// of item = 1
          
                      if($radioitemnumber == 1): ?>
                        </div>  <!-- top container--> 
                         <div class="container radio-items outer-grid-item outer-grid-item-sm-6 inner grid">  
                      <?php endif; //item no == 2  
            
                      if ($radioitemnumber == 3):?>
                        </div>  <!-- container--> 
                        <div class="container radio-items bottom-container outer-grid-item outer-grid-item-sm-6 inner">  
                      <?php endif; //item no == 7?>
                      

                      <?php /*
                    <article class="radio-item item-<?php echo $radioitemnumber;?> grid-item <?php echo $layoutclass;?> grid-item-sm-6" data-itemnumber="<?php echo $radioitemnumnber;?>">
                      <?php get_template_part( 'content', 'radio' );?>
                    </article> */?>

                  <?php $radioitemnumber++;

                  // End the loop.
                  endwhile;?>

                </div>  <!-- container--> 

        
            </div><!-- .grid inner outer-grid-item outer-grid-item-xs-6 -->

         <?php global $radio_query; // this is global querry that is also on the radio archives pages; so Maybe need to set up a home global querry?
      //https://kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin < maybe better solution in terms of genering html

         $big = 999999999; // need an unlikely integer

         $radiopaginate = paginate_links( array(
              'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
              'format' => '?paged=%#%',
              'current' => max( 1, get_query_var('paged')),
              'total' => $radio_query->max_num_pages,
              'prev_next' =>true,
             // 'before_page_number' =>'<div class="test">',
             // 'after_page_number' =>'</div>',
      //        'format' => '/page/%#%',  
      //        'current' => $current_page,  
      //        'total' => $total_pages,
              'type' =>  'plain',//list',//array',//list',
      //     'prev_text' => '<div class="next">' . get_template_part('svg/inline', 'dm_arrow_left.svg') .'</div>',
              'prev_text' => '<div class="small nav-previous align-left"><svg class="svg-icon previous-arrow-icon" width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g fill="#FFFFFF" fill-rule="nonzero"> <polygon transform="translate(19.874778, 20.000000) scale(-1, 1) rotate(-270.000000) translate(-19.874778, -20.000000) " points="19.8747779 29.2278846 37.6296018 6.12522213 39.8747779 7.85068148 19.8747779 33.8747779 -0.12522213 7.85068148 2.1199539 6.12522213"></polygon> </g> </g> </svg></div><div class="text">Newer Shows</div>',
              'next_text' => '<div class="small nav-next align-right"><svg class="svg-icon next-arrow-icon" width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g fill="#FFFFFF" fill-rule="nonzero"> <polygon transform="translate(19.874778, 20.000000) scale(-1, 1) rotate(-270.000000) translate(-19.874778, -20.000000) " points="19.8747779 29.2278846 37.6296018 6.12522213 39.8747779 7.85068148 19.8747779 33.8747779 -0.12522213 7.85068148 2.1199539 6.12522213"></polygon> </g> </g> </svg></div><div class="text">Older Shows</div>',
          
            ));
      
        if ($radiopaginate):?>
      
          <div class="page-nav outer-grid-item outer-grid-item-xs-6 inner">

            <div class="grid">

                <div class="page-nav-wrapper grid-item grid-item-xs-6">

                  <a href="<?php echo get_home_url(); ?>/radio/page/2">
                      View Older Radio
                  </a>

                </div>
            
            </div>

          </div>  <!-- ".page-nav-->     

        <?php endif;  // if we have paginated links ?>

      <?php endif;  // if ( $radio_query->have_posts
      wp_reset_query(); 
       ?>

    </div><!-- class="radio-home-wrapper"-->

    <!-- END RADIO area -->

    <!-- START RELEASES area -->

    <div class="release-home-wrapper grid">
      
      <div class="outer-grid-item outer-grid-item-xs-6 inner">
        
        <div class="grid">
          
            <div class="border grid-item grid-item-xs-6">
            </div>
        
        </div>

      </div>

      <div class="release-home-carousel">

          <?php
          // set the "paged" parameter (use 'page' if the query is on a static front page)
          //  $releasepaged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
          $releaseargs = array(
          'posts_per_page' => 6, // review
          'post_type' => 'releases',
          'post__not_in' => array($excludedposts), // this amongst others is release "featured"
          );
          // the query
          $release_query = new WP_Query( $releaseargs ); 
          if ( $release_query->have_posts() ) :?>

              <?php // are we on page one- so we can include the first item
              //if(1 == $paged):
              //$pageno = 'first';?>
              <?php //endif;  //  are we on page 1 ?>
              
            <!-- <div class="grid inner outer-grid-item outer-grid-item-xs-6"> -->

                  <?php
                  // the loop
                  $releaseitemnumber = 1;
                  while ( $release_query->have_posts() ) : $release_query->the_post(); 

                    $releaseid = get_the_ID(); 
                    $releaseitemnumber++;   //    
                    // end get fields
                    // echo $newsid;
                  //  if  ($releaseitemnumber > 10) {// after the 10th item
                    // for article items; 
                    $layoutclass = '';
                  
                  // } else {
                    //$layoutclass = $itemnumber.'-number';

                      //    <!-- START NEWS "more" listed archive posts" -->
                      // <!-- END NEWS "more" listed archive posts" -->
              
                    //}

                    /// review the uses of these classes - there's no need for the grid item classes I don't think - check the blocks instead?
                    ?>
            
                    <div class="release-home-item item-<?php echo $releaseitemnumber;?> grid-item <?php echo $layoutclass;?> grid-item-sm-6" data-itemnumber="<?php echo $releaseitemnumnber;?>">
                      <?php get_template_part( 'content', 'releases' );?>
                    </div>

                  <?php
                  // End the loop.
                  endwhile;?>
            
            <!--   </div>.grid inner outer-grid-item outer-grid-item-xs-6 -->


          <?php endif;  // if ( $release_query->have_posts

          wp_reset_query();?>

      </div><!--.release-home-carousel-->
        
      <div class="outer-grid-item outer-grid-item-xs-6 inner">
      
          <div class="grid">

              <div class="border grid-item grid-item-xs-6 more-release-wrapper">
                  
                  <a href="<?php echo get_home_url(); ?>/releases">
                    View All Releases
                  </a>

              </div><!--.more-release-wrapper-->
          
          </div><!--.grid-->

      </div><!-- .outer-grid-item outer-grid-item-xs-6 inner-->

    </div><!-- class="release-home-wrapper grid"-->

    <!-- END RELEASES area -->

<?php get_footer();?>
