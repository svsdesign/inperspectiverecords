<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) : the_post();?>

<div class="container">
  
  <div class="page-title-position">
    <div class="page-title">
      Artists
    </div> <!--.page-title -->
  </div><!-- .page-title-position -->
 
  <div class="image-items">

    <div class="image-item" data-image="andy-skopes-image" style="background-image: url('https://svsdesign.co.uk/wp-content/themes/inperspectiverecords/images/web-test-2018/artist-image-profane.jpg');">
    </div><!-- image-item -->

    <div class="image-item" data-image="breakage-image" style="background-image: url('https://svsdesign.co.uk/wp-content/themes/inperspectiverecords/images/web-test-2018/artist-image-acs.jpg');">
    </div><!-- image-item -->

        <div class="image-item" data-image="acs-image" style="background-image: url('https://svsdesign.co.uk/wp-content/themes/inperspectiverecords/images/web-test-2018/artist-image-acs.jpg');">
    </div><!-- image-item -->
    
       <div class="image-item" data-image="chris-image" style="background-image: url('https://svsdesign.co.uk/wp-content/themes/inperspectiverecords/images/web-test-2018/artist-image-chris.jpg');">
    </div><!-- image-item -->

    <div class="image-item" data-image="profane-image" style="background-image: url('https://svsdesign.co.uk/wp-content/themes/inperspectiverecords/images/web-test-2018/artist-image-profane.jpg');">
    </div><!-- image-item -->

  </div><!-- image-items -->

  <div class="list-items">

    <div class="list-item" data-imgid="andy-skopes-image">
      <div class="item-text">
        Andy Skopes
      </div><!-- item-text -->
    </div><!-- list-item -->
    <div class="list-item" data-imgid="acs-image">
      <div class="item-text">
      Acs
      </div><!-- item-text -->
    </div><!-- list-item -->
    <div class="list-item" data-imgid="breakage-image">
    	<div class="item-text">
      Breakage
      </div><!-- item-text -->
    </div><!-- list-item -->
    <div class="list-item" data-imgid="chris-image">
      <div class="item-text">
      Chris Inperspective
      </div><!-- item-text --> 
    </div><!-- list-item -->
    <div class="list-item">
      <div class="item-text">
      Earl Grey 
      </div><!-- item-text -->
    </div><!-- list-item -->
    <div class="list-item">
      <div class="item-text">
      Equinox
      </div><!-- item-text -->
    </div><!-- list-item -->
    <div class="list-item">
      <div class="item-text">
      Fracture & Neptune
      </div><!-- item-text -->
    </div><!-- list-item -->
    <div class="list-item">
      <div class="item-text">
      Gilles Appleton
      </div><!-- item-text -->
    </div><!-- list-item -->
    <div class="list-item">
      <div class="item-text">
      Goldenchild
      </div><!-- item-text -->
    </div><!-- list-item -->
    <div class="list-item">
      <div class="item-text">
      Infamy
      </div><!-- item-text -->
    </div><!-- list-item -->

    <div class="list-item" data-imgid="profane-image">
      <div class="item-text">
      Profane  
      </div><!-- item-text -->
    </div><!-- list-item -->

  </div><!-- list-items -->


  
</div><!-- container -->


<?php	//	get_template_part( 'whitecanvas-page' );
	endwhile;
endif;

get_footer();
