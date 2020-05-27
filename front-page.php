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
     $homepage = new WP_Query("page_id=5"); // local
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

                                <?php include(locate_template($thistemplatename));?>

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

                      <div class="featured-home-news-item featured-home-item-<?php echo $thisposttype?>">
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

    <div class="news-home-wrapper">
      
        <?php
        // set the "paged" parameter (use 'page' if the query is on a static front page)
        $newspaged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $newsargs = array(
          'posts_per_page' => 9, // reivew this because won'tb e right
          'post_type' => 'news',
          'paged' => $newspaged,
       //   'post__not_in' => $excludednewsposts // ensure exclusion across cpt's: event, radio, artists
          'post__not_in' => array($excludednewsposts),
        //  $excludednewsposts
    // ensure to exclude the news items here - useing array variable:

        );
        // the query
        $news_query = new WP_Query( $newsargs ); 
          
            if ( $news_query->have_posts() ) :?>


          <?php // are we on page one- so we can include the first item
          //if(1 == $paged):
          //$pageno = 'first';?>
          <?php //endif;  //  are we on page 1 ?>
      
          <div class="grid inner outer-grid-item outer-grid-item-xs-6">


              <div class="page-title-positioner outer-grid-item outer-grid-item-sm-8 sticky">
                                
                  <div class="page-titler">
                            
                    <span class="inner">
                    News
                    </span><!-- inner -->

                    </div> <!--.page-title -->

                </div><!-- .page-title-position -->

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

    Review the pagination - so link the next page into page 2 of the news archvie              
      <?php global $news_query; // this global variable also used on news archives; so consider setting other global variable?
      //https://kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin < maybe better solution in terms of genering html

         $big = 999999999; // need an unlikely integer

         $newspaginate = paginate_links( array(
              'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
              'format' => '?paged=%#%',
              'current' => max( 1, get_query_var('paged')),
              'total' => $news_query->max_num_pages,
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
      
        if ($newspaginate):?>
      
          <div class="page-nav outer-grid-item outer-grid-item-xs-6 inner">

            <div class="grid">

                <div class="page-nav-wrapper grid-item grid-item-xs-6">

                <?php echo $newspaginate;?>

                </div>
            
              </div>

          </div>  <!-- ".page-nav-->     

        <?php endif;  // if we have paginated links ?>

      <?php endif;  // if ( $news_query->have_posts


      wp_reset_query(); 
      ?>

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
          'paged' => $radiopaged,
       //   'post__not_in' => $excludednewsposts // ensure exclusion across cpt's: event, radio, artists
          'post__not_in' => array($excludedposts), // this amongst others is radio "featured"
 
        );
        // the query
        $radio_query = new WP_Query( $radioargs ); 
          
            if ( $radio_query->have_posts() ) :?>

          <?php // are we on page one- so we can include the first item
          //if(1 == $paged):
          //$pageno = 'first';?>
          <?php //endif;  //  are we on page 1 ?>
      
          <div class="grid inner outer-grid-item outer-grid-item-xs-6">

              <?php
              // the loop
              $radioitemnumber = 1;
              while ( $radio_query->have_posts() ) : $radio_query->the_post(); 

                $radioid = get_the_ID(); 
                $radioitemnumber++;   //    
                // end get fields
                // echo $newsid;
                if  ($radioitemnumber > 10) {// after the 10th item
                // for article items; 
                $layoutclass = 'grid-item-md-3 grid-item-lg-2';
               
                } else {
                //$layoutclass = $itemnumber.'-number';

                  //    <!-- START NEWS "more" listed archive posts" -->
                  // <!-- END NEWS "more" listed archive posts" -->
          
                };?>
         
                <article class="radio-item item-<?php echo $radioitemnumber;?> grid-item <?php echo $layoutclass;?> grid-item-sm-6" data-itemnumber="<?php echo $radioitemnumnber;?>">
                  <?php get_template_part( 'content', 'radio' );?>
                </article>

              <?php
              // End the loop.
              endwhile;?>
        
          </div><!-- .grid inner outer-grid-item outer-grid-item-xs-6 -->

Review the pagination - so link the next page into page 2 of the radio archvie              
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

                <?php echo $radiopaginate;?>

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


          <div class="release-home-wrapper">
      
        <?php
        // set the "paged" parameter (use 'page' if the query is on a static front page)
      //  $releasepaged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $releaseargs = array(
          'posts_per_page' => 6, // review
          'post_type' => 'releases',
          'paged' => $releasepaged,
       //   'post__not_in' => $excludednewsposts // ensure exclusion across cpt's: event, release, artists
          'post__not_in' => array($excludedposts), // this amongst others is release "featured"
 
        );
        // the query
        $release_query = new WP_Query( $releaseargs ); 
          
            if ( $release_query->have_posts() ) :?>

          <?php // are we on page one- so we can include the first item
          //if(1 == $paged):
          //$pageno = 'first';?>
          <?php //endif;  //  are we on page 1 ?>
      
          <div class="grid inner outer-grid-item outer-grid-item-xs-6">

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
                $layoutclass = 'grid-item-md-3 grid-item-lg-2';
               
               // } else {
                //$layoutclass = $itemnumber.'-number';

                  //    <!-- START NEWS "more" listed archive posts" -->
                  // <!-- END NEWS "more" listed archive posts" -->
          
                //}

                /// review the uses of these classes - there's no need for the grid item classes I don't think - check the blocks instead?
                ;?>
         
                 <article class="release-item item-<?php echo $releaseitemnumber;?> grid-item <?php echo $layoutclass;?> grid-item-sm-6" data-itemnumber="<?php echo $releaseitemnumnber;?>">
                  <?php get_template_part( 'content', 'releases' );?>
                </article>

              <?php
              // End the loop.
              endwhile;?>
        
          </div><!-- .grid inner outer-grid-item outer-grid-item-xs-6 -->


      <?php endif;  // if ( $release_query->have_posts

     wp_reset_query(); 

      ?>

    </div><!-- class="release-home-wrapper"-->

    <!-- END RELEASES area -->

<?php get_footer();?>
