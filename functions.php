<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   
 */
 


/*
TO DO:
-finishin this list - refer to sketch file + finish the planning document designs; sitemap and content for each box + signup designs with chris first?
REGISTER POSTTYPES:

- artist
	- archive
	- single
		- current artist
		- past artists

- news 
	- archive
	- single

- releases
	- archive
	- single
		- available
		- archived

- event
	- archive
	- single
		- past
		- current
		- next

- radio
	- archive
	- single

REGISTER PAGE TYPES
- about
- t&c

*/


/* create custom post types */

	/* ARTISTS */
 
	function post_type_artists() {
	 
		// Set UI labels for Custom Post Type
	    $labels = array(
	        'name'                => _x( 'Artists', 'Post Type General Name', 'inperspectiverecords' ),
	        'singular_name'       => _x( 'Artist', 'Post Type Singular Name', 'inperspectiverecords' ),
	        'menu_name'           => __( 'Artists', 'inperspetiverecords' ),
	        'parent_item_colon'   => __( 'Artists', 'inperspectiverecords' ),
	        'all_items'           => __( 'All Artists', 'inperspectiverecords' ),
	        'view_item'           => __( 'View Artist', 'inperspectiverecords' ),
	        'add_new_item'        => __( 'Add New Artist', 'inperspectiverecords' ),
	        'add_new'             => __( 'Add New', 'inperspectiverecords' ),
	        'edit_item'           => __( 'Edit Artist', 'inperspectiverecords' ),
	        'update_item'         => __( 'Update Artist', 'inperspectiverecords' ),
	        'search_items'        => __( 'Search Artist', 'inperspectiverecords' ),
	        'not_found'           => __( 'Not Found', 'inperspectiverecords' ),
	        'not_found_in_trash'  => __( 'Not found in Trash', 'inperspectiverecords' ),
	    );
	     
	// Set other options for Custom Post Type
	     
	    $args = array(
	        'label'               => __( 'artists', 'inperspectiverecords' ),
	        'description'         => __( 'Inperspective Label Artists', 'inperspectiverecords' ),
	        'labels'              => $labels,
	        // Features this CPT supports in Post Editor
		    'supports' => array( 'title', 'editor', 'excerpt', 'author', 'revisions' ),
	        // You can associate this CPT with a taxonomy or custom taxonomy. 
	      //'taxonomies'          => array( 'genres' ),
	        /* A hierarchical CPT is like Pages and can have
	        * Parent and child items. A non-hierarchical CPT
	        * is like Posts.
	        */ 
	        'hierarchical'        => false,
	        'public'              => true,
	        'show_ui'             => true,
	        'show_in_menu'        => true,
	        'show_in_nav_menus'   => true,
	        'show_in_admin_bar'   => true,
	      //  'menu_position'       => 5,
	        'can_export'          => true,
	        'has_archive'         => true,
	        'exclude_from_search' => false,
	        'publicly_queryable'  => true,
	        'capability_type'     => 'post',
	    );
	     
	    // Registering your Custom Post Type
	    register_post_type( 'artists', $args );
	 
	}
	 
	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
	 
	add_action( 'init', 'post_type_artists', 0 );

	/* ARTISTS */

    /* NEWS */
 
    function post_type_news() {
     
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'News', 'Post Type General Name', 'inperspectiverecords' ),
            'singular_name'       => _x( 'News', 'Post Type Singular Name', 'inperspectiverecords' ),
            'menu_name'           => __( 'News', 'inperspetiverecords' ),
            'parent_item_colon'   => __( 'News', 'inperspectiverecords' ),
            'all_items'           => __( 'All News', 'inperspectiverecords' ),
            'view_item'           => __( 'View News', 'inperspectiverecords' ),
            'add_new_item'        => __( 'Add New News', 'inperspectiverecords' ),
            'add_new'             => __( 'Add New', 'inperspectiverecords' ),
            'edit_item'           => __( 'Edit News', 'inperspectiverecords' ),
            'update_item'         => __( 'Update News', 'inperspectiverecords' ),
            'search_items'        => __( 'Search News', 'inperspectiverecords' ),
            'not_found'           => __( 'Not Found', 'inperspectiverecords' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'inperspectiverecords' ),
        );
         
    // Set other options for Custom Post Type
         
        $args = array(
            'label'               => __( 'News', 'inperspectiverecords' ),
            'description'         => __( 'Inperspective Label News', 'inperspectiverecords' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'taxonomies' => array('post_tag','category'),
            'show_in_rest' => true,
            'supports' => array( 'title', 'editor', 'excerpt', 'author', 'revisions'),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
          //'taxonomies'          => array( 'genres' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
          //  'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
        );
         
        // Registering your Custom Post Type
        register_post_type( 'news', $args );
     
    }
     
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
     
    add_action( 'init', 'post_type_news', 0 );

//start Testimonial block

    function register_acf_block_types() {
// assigning js + css?

//https://www.billerickson.net/block-styles-in-gutenberg/
 //end asigning js + css - this the best approcah?

/*
       enqueing syles for blcoks
       
       https://jasonyingling.me/enqueueing-scripts-and-styles-for-gutenberg-blocks/

       */ 

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'testimonial',
            'title'             => __('Testimonial'),
            'description'       => __('A custom testimonial block.'),
            'render_template'   => 'template-parts/blocks/testimonial/testimonial.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'testimonial', 'quote' ),
        ));
    }

    // Check if function exists and hook into setup.
    if( function_exists('acf_register_block_type') ) {
        add_action('acf/init', 'register_acf_block_types');
    }



//end testimonial block

    /* NEWS */


	/* RELEASES */

	function post_type_releases() {
	 
	    // Set UI labels for Custom Post Type
	    $labels = array(
	        'name'                => _x( 'Releases', 'Post Type General Name', 'inperspectiverecords' ),
	        'singular_name'       => _x( 'Release', 'Post Type Singular Name', 'inperspectiverecords' ),
	        'menu_name'           => __( 'Releases', 'inperspetiverecords' ),
	        'parent_item_colon'   => __( 'Releases', 'inperspectiverecords' ),
	        'all_items'           => __( 'All Releases', 'inperspectiverecords' ),
	        'view_item'           => __( 'View Release', 'inperspectiverecords' ),
	        'add_new_item'        => __( 'Add New Release', 'inperspectiverecords' ),
	        'add_new'             => __( 'Add New', 'inperspectiverecords' ),
	        'edit_item'           => __( 'Edit Release', 'inperspectiverecords' ),
	        'update_item'         => __( 'Update Release', 'inperspectiverecords' ),
	        'search_items'        => __( 'Search Release', 'inperspectiverecords' ),
	        'not_found'           => __( 'Not Found', 'inperspectiverecords' ),
	        'not_found_in_trash'  => __( 'Not found in Trash', 'inperspectiverecords' ),
	    );
	     
	// Set other options for Custom Post Type
	     
	    $args = array(
	        'label'               => __( 'Releases', 'inperspectiverecords' ),
	        'description'         => __( 'Inperspective Label Releases', 'inperspectiverecords' ),
	        'labels'              => $labels,
	        // Features this CPT supports in Post Editor
	        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'revisions' ),
	        // You can associate this CPT with a taxonomy or custom taxonomy. 
	      //'taxonomies'          => array( 'genres' ),
	        /* A hierarchical CPT is like Pages and can have
	        * Parent and child items. A non-hierarchical CPT
	        * is like Posts.
	        */ 
	        'hierarchical'        => false,
	        'public'              => true,
	        'show_ui'             => true,
	        'show_in_menu'        => true,
	        'show_in_nav_menus'   => true,
	        'show_in_admin_bar'   => true,
	      //  'menu_position'       => 5,
	        'can_export'          => true,
	      //  'rewrite' => array("slug" => "releases"), // Permalinks

	        'has_archive'         => true,
	        'exclude_from_search' => false,
	        'publicly_queryable'  => true,
	        'capability_type'     => 'post',
	    );
	     
	    // Registering your Custom Post Type
	    register_post_type( 'releases', $args );
	 
	}
	
	add_action( 'init', 'post_type_releases', 0 );

	/* RELEASES */



	/* RADIO - I need to design this - so lets register at a later date? */
	// START CUSTOM POST TYPE: Radio


	function post_type_radio() {

// not sure why There are not variable and values for the labels - as per the other posts? Revise this maybe, so we have consistent labelling etc.

	    register_post_type( 'radio', array(
	        'label' => __('Radio'),
	        'singular_label' => __('Radio Item'),
	        'public' => true,
	        'has_archive' => true,
	        'show_ui' => true,
	        '_builtin' => false, // It's a custom post type, not built in
	        '_edit_link' => 'post.php?post=%d',
	        'capability_type' => 'post',
	        'rewrite' => array("slug" => "radio"), // Permalinks
	     	'query_var' => true,
	        'menu_position' => null,
	     ));
	        // add the following function if you are getting
	        // a 'Page not found' error from your permalink
	        //flush_rewrite_rules( false );
	}

	 add_action('init', 'post_type_radio');

/*
// END CUSTOMPOST TYPE: Radio


	*/

	/* EVENTS - will require different post type options - check out RS; the way events are code in this- */

/*
*
*
START event
*
*
*/


//START event - adding events - http://tatiyants.com/how-to-use-wordpress-custom-post-types-to-add-events-to-your-site/


add_action('init', 'event_register');
 
function event_register() {
 
    $labels = array(
        'name' => _x('Events', 'post type general name'),
        'singular_name' => _x('Event', 'post type singular name'),
        'add_new' => _x('Add New', 'event'),
        'add_new_item' => __('Add New Event'),
        'edit_item' => __('Edit Event'),
        'new_item' => __('New Event'),
        'view_item' => __('View Event'),
        'search_items' => __('Search Events'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );
 
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'has_archive' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title','editor','thumbnail')
      );
 
        //   flush_rewrite_rules( false );


    register_post_type( 'events' , $args );
}


 
// END - http://tatiyants.com/how-to-use-wordpress-custom-post-types-to-add-events-to-your-site/



add_action("manage_posts_custom_column", "my_custom_columns");
add_filter("manage_edit-events_columns", "my_page_columns");


function my_page_columns($columns)
{
    $columns = array(
        'title'     => 'Title',
      //  'date'      =>  'Date',
        'event_start_date'    =>  'Start',
        'event_end_date'      =>  'End',
        'author'    =>  'Author',
        'venue' => 'Venue'
    );
    return $columns;
}

function my_custom_columns($column)
{
    global $post;
 
/* events */

    if($column == 'event_start_date')
    {
    
        if(get_field('event_start_date')){
           $start = get_field('event_start_date'); echo date_i18n('d M Y g:i a', $start);
         //   echo 'start';
        }
     //   echo wp_get_attachment_image( get_field('page_image', $post->ID), array(200,200) );
    }
    elseif($column == 'event_end_date')
    {
           if(get_field('event_end_date')){
     //     echo 'end';

       $end = get_field('event_end_date'); echo date_i18n('d M Y g:i a', $end);

            }
    }elseif($column == 'venue')
    {
           if(get_field('venue')){
     //     echo 'end';

       $venue = get_field('venue'); echo $venue;

            }
    } 

    
/* events */



};
 


// Add the custom columns to the releases post type:
add_filter( 'manage_releases_posts_columns', 'set_custom_edit_releases_columns' );
function set_custom_edit_releases_columns($columns) {
    unset( $columns['code'] );
    $columns['release_code'] = __( 'Code', 'code' );
 
    return $columns;
}

// Add the data to the custom columns for the releases post type:
add_action( 'manage_releases_posts_custom_column' , 'custom_releases_column', 10, 2 );
function custom_releases_column( $column, $post_id ) {
    switch ( $column ) {

        case 'release_code' :


       // echo get_post_meta( $post_id , 'release_code' , true ); 
 
     //     echo 'end';

       $code = get_field('release_code'); echo $code;

       //     }

     //  case 'publisher' :
        //    echo get_post_meta( $post_id , 'publisher' , true ); 
            break;

    }
}

 /*
add_action("manage_posts_releases_column", "my_custom_release_columns");
add_filter("manage_edit-releases_columns", "my_page_release_columns");


function my_page_release_columns($columns)
{
    $columns = array(
        'release_code' => 'Code'
    );
    return $columns;
}

function my_custom_release_columns($column)
{
    global $post;
 
// events 

    if($column == 'release_code')
    {
           if(get_field('release_code')){
     //     echo 'end';

       $code = get_field('release_code'); echo $code;

            }
    }
// events 



};

*/


// http://wordpress.stackexchange.com/questions/149076/query-between-dates-using-date-picker-fields
//http://joshuaiz.com/words/ordering-events-by-advanced-custom-fields-date-time-picker-field/

// this not really being used at the moment; because we are using the time picker aswell as date; this would require editing based on adding time to the equation


function get_meta_sql_date( $pieces, $queries ) {
    global $wpdb;

    // get start and end date from query
    foreach ( $queries as $q ) {

        if ( !isset( $q['key'] ) ) {
            return $pieces;
        }

        if ( 'event_start_date' === $q['key'] ) {
            $start_date = isset( $q['value'] ) ?  $q['value'] : '';
        }
        if ( 'event_end_date' === $q['key'] ) {
            $end_date = isset( $q['value'] ) ?  $q['value'] : '';
        }
    }

    if ( ( '' === $start_date ) || ( '' === $end_date ) ) {
        return $pieces;
    }

    $query = "";

    // after start date AND before end date
    $_query = " AND (
        ( $wpdb->postmeta.meta_key = 'event_start_date' AND ( CAST($wpdb->postmeta.meta_value AS DATE) >= %s) )
        AND ( mt1.meta_key = 'event_end_date' AND ( CAST(mt1.meta_value AS DATE) <= %s) )
    )";
    $query .= $wpdb->prepare( $_query, $start_date, $end_date );

    // OR before start date AND after end end date
    $_query = " OR (
        ( $wpdb->postmeta.meta_key = 'event_start_date' AND ( CAST($wpdb->postmeta.meta_value AS DATE) <= %s) )
        AND ( mt1.meta_key = 'event_end_date' AND ( CAST(mt1.meta_value AS DATE) >= %s) )
    )";
    $query .= $wpdb->prepare( $_query, $start_date, $end_date );

    // OR before start date AND (before end date AND end date after start date)
    $_query = " OR (
        ( $wpdb->postmeta.meta_key = 'event_start_date' AND ( CAST($wpdb->postmeta.meta_value AS DATE) <= %s) )
        AND ( mt1.meta_key = 'event_end_date'
            AND ( CAST(mt1.meta_value AS DATE) <= %s )
            AND ( CAST(mt1.meta_value AS DATE) >= %s )
        )
    )";
    $query .= $wpdb->prepare( $_query, $start_date, $end_date, $start_date );

    // OR after end date AND (after start date AND start date before end date) )
    $_query = "OR (
        ( mt1.meta_key = 'event_end_date' AND ( CAST(mt1.meta_value AS DATE) >= %s ) )
        AND ( $wpdb->postmeta.meta_key = 'event_start_date'
            AND ( CAST($wpdb->postmeta.meta_value AS DATE) >= %s )
            AND ( CAST($wpdb->postmeta.meta_value AS DATE) <= %s )
        )
    )";
    $query .= $wpdb->prepare( $_query, $end_date, $start_date, $end_date );

    $pieces['where'] = $query;

    return $pieces;
};


// http://wordpress.stackexchange.com/questions/149076/query-between-dates-using-date-picker-fields
//http://joshuaiz.com/words/ordering-events-by-advanced-custom-fields-date-time-picker-field/

// END  this not really being used at the moment; because we are using the time picker aswell as date; this would require editing based on adding time to the equation

// START -  add meta value if next event


        $notnextarg = array(
            'post_type'              => 'events', // your event post type slug
            'post_status'            => 'publish', // only show published events
        );

        $my_query = null;
        $my_query = new WP_Query($notnextarg);
        while ($my_query->have_posts()) : $my_query->the_post();
            $postid = get_the_ID();
            update_post_meta( $postid, 'is-next-event', 'false');
        endwhile;
 
         wp_reset_query(); //reset 

        $now = current_time( 'timestamp' ); // Get current unix timestamp
        $eventstart = get_field('event_start_date');  // text - 
        $nextarg = array (
            'post_type'              => 'events', // your event post type slug
            'post_status'            => 'publish', // only show published events
            'order'                  => 'ASC', // Show earlier events first
            'posts_per_page'         => 1,
            'numberposts'   => -1,
            'orderby' =>  'meta_value',
            'meta_key' =>  'event_start_date',
            'meta_query' => array(
                    
                    'relation' => 'AND',
                    array(
                        'key'       => 'event_start_date',
                        'compare'   => '>=', // starts after or equal
                        'value'     => $now
                    ),
                    array(
                        'key'       => 'event_end_date',
                        'compare'   => '<=', // starts before or equal
                        'value'     => '9999999999'
                    )
                ),
            ); 

        // query
        $the_query = new WP_Query( $nextarg ); 
              while ( $the_query->have_posts() ) : $the_query->the_post();    
                $eventid = get_the_ID();                            
                update_post_meta( $eventid, 'is-next-event', 'true');  
            endwhile;  
        wp_reset_query();  // Restore global post data stomped by the_post().  
 

// END - add meta value if next event


// START -  add meta value if event is not upcoming


        $notupcomingarg = array(
            'post_type'              => 'events', // your event post type slug
            'post_status'            => 'publish', // only show published events
        );

        $my_query = null;
        $my_query = new WP_Query($notupcomingarg);
        while ($my_query->have_posts()) : $my_query->the_post();
            $postid = get_the_ID();
            update_post_meta( $postid, 'is-upcoming-event', 'false');
        endwhile;
 
         wp_reset_query(); //reset 

        $now = current_time( 'timestamp' ); // Get current unix timestamp
        $eventstart = get_field('event_start_date');  // text - this now  ‘Y-m-d H:i:s’. not Unix


//       $end = get_field('event_end_date'); echo date_i18n('d M Y g:i a', $end);

        $upcomingarg = array (
            'post_type'              => 'events', // your event post type slug
            'post_status'            => 'publish', // only show published events
            'order'                  => 'ASC', // Show earlier events first
            'posts_per_page'         => 9999999,
            'numberposts'   => -1,
            'orderby' =>  'meta_value',
            'meta_key' =>  'event_start_date',
            'meta_query' => array(
                    
                    'relation' => 'AND',
                    array(
                        'key'       => 'event_start_date',
                        'compare'   => '>=', // starts after or equal
                        'value'     => $now
                    ),
                    array(
                        'key'       => 'event_end_date',
                        'compare'   => '<=', // starts before or equal
                        'value'     => '9999999999'
                    )
                ),
            ); 

        // query
        $the_query = new WP_Query( $upcomingarg ); 
              while ( $the_query->have_posts() ) : $the_query->the_post();    
                $eventid = get_the_ID();                            
                update_post_meta( $eventid, 'is-upcoming-event', 'true');  
            endwhile;  
        wp_reset_query();  // Restore global post data stomped by the_post().  
 

// END - add meta value if event is upcoming


/*
 // this function added because by default dates are now save as  // text - this now  ‘Y-m-d H:i:s’. not Unix
add_filter('acf/update_value/type=date_time_picker', 'my_update_value_date_time_picker', 10, 3);

function my_update_value_date_time_picker( $value, $post_id, $field ) {
    
    return strtotime($value);
    
}
*/
 
  // this function added because by default dates are now save as  // text - this now  ‘Y-m-d H:i:s’. not Unix
add_filter('acf/update_value/type=date_time_picker', 'my_update_value_date_time_picker', 10, 3);

function my_update_value_date_time_picker( $value, $post_id, $field ) {
    
    return strtotime($value);
    
}



/*
*
*
END event
*
*
*/




	/* EVENTS - will require different post type options */
	
	/* NEWS - use existing post type ? */

	/* NEWS - use existing post type ? */


/* end create custom post types */


function inp_scripts()
{

    $template_directory = get_stylesheet_directory_uri();
    global $template;

/*    wp_enqueue_script(
        'jquery.easing',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js',
        array('jquery'),
        '1.3',
        true
    );
*/
    wp_enqueue_script('jquery');

/*
    wp_enqueue_script( // review if we're using this?
        'mutation-summary',
        get_stylesheet_directory_uri().'/assets/js/mutation-summary.js',
       //  array('jquery'),
        '0.1.1',
        true
    ); */

    wp_enqueue_script(
        'attrchange', 
        'https://cdnjs.cloudflare.com/ajax/libs/attrchange/2.0.1/attrchange.min.js',
        array('jquery'),
        false,
        true
    );


    wp_enqueue_style( 'system-style', get_stylesheet_uri() );
  

	wp_enqueue_script(
		'barba', 
		'https://cdnjs.cloudflare.com/ajax/libs/barba.js/1.0.0/barba.min.js',
		false,
		true
	);
	  
	wp_enqueue_script(
		'enquire', 
		get_stylesheet_directory_uri().'/assets/js/enquire.js',
		array('jquery'),
		false,
		true
	);

	wp_enqueue_script(
		'inp-ajax', 
		get_stylesheet_directory_uri().'/assets/js/inp-ajax.js',
		array('jquery'),
		false,
		true
	);

 
	wp_enqueue_script(
		'inp-base', 
		get_stylesheet_directory_uri().'/assets/js/inp-base.js',
		array('jquery'),
		false,
		true
	);



    wp_enqueue_script(
        'isotope',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.3/imagesloaded.pkgd.min.js',
         array('jquery'),
        '4.1.3',
        true
    );

	wp_enqueue_script(
        'snapsvg',
		'https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.5.1/snap.svg-min.js',
		 array('jquery'),
		false,
		true
    ); 
    
   /* this an issue maybe - needs enquering every time its called ? which sound ike bollocks? */
    wp_enqueue_script(
        'scsdk',
        'https://connect.soundcloud.com/sdk/sdk-3.3.0.js',
         array('jquery'),
        false,
        true
    );

    wp_enqueue_script(
        'radioloader',
        get_stylesheet_directory_uri().'/assets/js/inp-radio-loader.js',
        array('jquery'),
        false,
        true
    );



 /*
    wp_enqueue_script(
        'inp-radio-loader', 
        get_stylesheet_directory_uri().'/assets/js/inp-radio-loader.js',
        array('jquery'),
        false,
        true
    );
*/


 /*
    wp_enqueue_script(
        'inpradio',
        'http://localhost:8888/inp-wp/wp-content/themes/inperspectiverecords/assets/js/inp-radio.js',
         array('jquery'),
        false,
        true
    );
*/
   /* wp_enqueue_script(
        'mcval', 
        get_stylesheet_directory_uri().'/assets/js/mc-val.js',
        array('jquery'),
        false,
        true
    );
*/

 	//if (basename($template) == 'systems-page.php' || basename($template) == 'front-page.php') {
       

/*
         wp_enqueue_script(
            'typed',
			get_stylesheet_directory_uri().'/assets/js/typed.min.js',
    		array('jquery'),
            false,
            true
        );

        wp_enqueue_script(
            'isotope',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.1/isotope.pkgd.min.js',
            array('jquery'),
            '3.0.1',
            true
        );

   	

   		wp_enqueue_script(
            'flickity',
			get_stylesheet_directory_uri().'/assets/js/flickity.pkgd.min.js',
			array('jquery'),
            false,
            true
        );
*/

   // }// if (basename($template) == 'systems-page.php')

};
add_action('wp_enqueue_scripts', 'inp_scripts');


/* Add Navigations */


function register_navigations() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Navigation' ),
      'header-second-menu' => __( 'Header Second Navigation' ),
      'social-menu' => __( 'Social Navigation' ),
      'footer-menu' => __( 'Footer Navigation' ),
      'footer-second-menu' => __( 'Footer Second Navigation' )

    )
  );
}
add_action( 'init', 'register_navigations' );


/* End Add Navigations */


/* setting pagination */
// 1. Pre aug 19' I'm not sure this - radio pagination - is being used - or works- doesn't work because I'm dong a new query 
// 2. Aug 19' - !should remove that (in the radio-arhive.php template, as I did for news - i.e the below for news works now :)
function set_posts_per_page_for_radio( $radio_query ) {
  if ( !is_admin() &&  $radio_query ->is_main_query() && is_post_type_archive( 'radio' ) ) {
    $radio_query->set( 'posts_per_page', '4' );
  }
}
add_action( 'pre_get_posts', 'set_posts_per_page_for_radio' );
// end I'm not sure this - radio pagination - is being used - or works?



/* setting pagination */
 function set_posts_per_page_for_news( $news_query ) {
  if ( !is_admin() &&  $news_query->is_main_query() && is_post_type_archive( 'news' ) ) {
    $news_query->set( 'posts_per_page', '16' );
  }
}
add_action( 'pre_get_posts', 'set_posts_per_page_for_news' );
 /* end setting pagination */

/* setting pagination number */


?>