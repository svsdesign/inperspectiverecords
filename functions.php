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



- Further considerations:
disabling some of the standard blocks - i.e especially the layout; collumns and tables etc.
     - Related reading: https://developer.wordpress.org/block-editor/developers/themes/theme-support/
    - Do I use block manager or just allow/confgure blocks via php? Markup exmaple below
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



/// START BLOCKS 

// allow only certain blocks:
/* review this - probaby just use the options availavle int h CMS?
'block manager'
https://rudrastyh.com/gutenberg/remove-default-blocks.html
add_filter( 'allowed_block_types', 'wpse324908_allowed_block_types', 10, 2 );

function wpse324908_allowed_block_types( $allowed_blocks, $post ) {    
   $allowed_blocks = array(
        'core/shortcode',
        'core/image',
        'core/gallery',
  //      'core/heading',
       // 'core/quote',       
        'core/embed',
  //      'core/list',
        'core/separator',
  //      'core/more',
  //     'core/button',
  //      'core/pullquote',
 //       'core/table',
        'core/preformatted',
        'core/code',
        'core/html',
//        'core/freeform',
 //       'core/latest-posts',
//        'core/categories',
//        'core/cover',
        'core/text-columns',
 //       'core/verse',
        'core/video',
        'core/audio',
        'core/block',
        'core/paragraph',
        'core-embed/twitter',
        'core-embed/youtube',
        'core-embed/facebook',
        'core-embed/instagram',
        'core-embed/wordpress',
        'core-embed/soundcloud',
        'core-embed/spotify',
//        'core-embed/flickr',
        'core-embed/vimeo',
//        'core-embed/animoto',
//        'core-embed/cloudup',
//        'core-embed/collegehumor',
//        'core-embed/dailymotion',
//        'core-embed/funnyordie',
//        'core-embed/hulu',
//        'core-embed/imgur',
//        'core-embed/issuu',
//        'core-embed/kickstarter',
//        'core-embed/meetup-com',
        'core-embed/mixcloud',
 //       'core-embed/photobucket',
 //       'core-embed/polldaddy',
//        'core-embed/reddit',
//        'core-embed/reverbnation',
//      'core-embed/screencast',
//        'core-embed/scribd',
//        'core-embed/slideshare',
//        'core-embed/smugmug',
//        'core-embed/speaker',
//        'core-embed/ted',
//        'core-embed/tumblr',
//        'core-embed/videopress',
  //      'core-embed/wordpress-tv'
        //inp ones:

    );     
    return $allowed_blocks;    
}
//end allow only certain blocks:

 */

function my_admin_block_assets() {
//https://wp.zacgordon.com/2017/12/26/how-to-add-javascript-and-css-to-gutenberg-blocks-the-right-way-in-plugins-and-themes/
//https://support.advancedcustomfields.com/forums/topic/js-fires-before-block-is-rendered/
//https://kinsta.com/blog/critical-rendering-path/
//https://modularwp.com/gutenberg-block-custom-styles/

//wp_enqueue_style('admin-artist-block',''.get_stylesheet_directory_uri().'/template-parts/blocks/inpartist/assets/css/style.css', array(), '1');
wp_enqueue_style('admin-blocks',''.get_stylesheet_directory_uri().'/admin-style.css', array(), '1');

 

}
add_action( 'enqueue_block_editor_assets', 'my_admin_block_assets' );


 

add_action('acf/init', 'my_acf_init');
function my_acf_init() {
    
    // check function exists
    if( function_exists('acf_register_block') ) {
        
    // register a quote block:
    
        acf_register_block(array(
            'name'              => 'inpquote',
            'title'             => __('Inp Quote'),
            'description'       => __('A custom quote block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',
            'enqueue_assets'    => function(){
                //  wp_enqueue_script('inp-quote-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inpquote/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'editor-quote',
          //  'mode'              => 'preview',//"auto" or "preview" This lets you control how the block is presented the Gutenberg block editor. The default is “auto” which renders the block to match the frontend until you select it, then it becomes an editor. If set to “preview” it will always look like the frontend and you can edit content in the sidebar.
            'supports'           => array( 'mode' => false ),//If set to “Edit” it appears like a metabox in the content area. The user can switch the mode by clicking the button in the top right corner, unless you specifically disable it with 

            'keywords'          => array( 'inpquote'),
        ));

    
    // register a credit block:
    
        acf_register_block(array(
            'name'              => 'inpcredit',
            'title'             => __('Inp Credit'),
            'description'       => __('A custom credit block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-credit-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inpcredit/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array( 'inpcredit'),
        ));
    

    // register an artist block:
    
        acf_register_block(array(
            'name'              => 'inpartist',
            'title'             => __('Inp Artist'),
            'description'       => __('A custom artist block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-artist-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inpartist/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array( 'inpartist'),
        ));

    
    // register a text block:
    
        acf_register_block(array(
            'name'              => 'inptext',
            'title'             => __('Inp Text'),
            'description'       => __('A custom text block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array( 'inptext'),
        ));

    
    // register a sound block:
    
        acf_register_block(array(
            'name'              => 'inpsound',
            'title'             => __('Inp Sound'),
            'description'       => __('A custom sound block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
           //  wp_enqueue_script('inp-sound-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inpsound/assets/js/script.js', array( 'jquery' ), '', true );

            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array( 'inpsound'),
        ));
  
    // register a release block:
    
        acf_register_block(array(
            'name'              => 'inprelease',
            'title'             => __('Inp Release'),
            'description'       => __('A custom release block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
              wp_enqueue_script('inp-release-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inprelease/assets/js/script.js', array( 'jquery' ), '', true );
           },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array( 'inprelease'),
        ));

     // register an image block:
       
        acf_register_block(array(
            'name'              => 'inpimage',
            'title'             => __('Inp Image'),
            'description'       => __('A custom image block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',
            'enqueue_assets'    => function(){
                //  wp_enqueue_script('inp-quote-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inpquote/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'format-image',
          //'mode'              => 'preview',//"auto" or "preview" This lets you control how the block is presented the Gutenberg block editor. The default is “auto” which renders the block to match the frontend until you select it, then it becomes an editor. If set to “preview” it will always look like the frontend and you can edit content in the sidebar.
            'supports'          => array( 'mode' => false ),
            'keywords'          => array( 'inpimage'),
        ));





    }// if( function_exists('acf_register_block') )

}//function my_acf_init() {




function my_acf_block_render_callback( $block ) {
    
    // convert name ("acf/quote") into path friendly slug ("quote")
    $slug = str_replace('acf/', '', $block['name']);
    
    // include a template part from within the "template-parts/block" folder
    if( file_exists( get_theme_file_path("/template-parts/blocks/{$slug}/content-{$slug}.php") ) ) {
        include( get_theme_file_path("/template-parts/blocks/{$slug}/content-{$slug}.php") );
    } //if

}

 

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





    // START CUSTOM POST TYPE: Radio


    function post_type_radio() {

     $labels = array(
        'name' => _x('Radio', 'post type general name'),
        'singular_name' => _x('Radio', 'post type singular name'),
        'add_new' => _x('Add New', 'radio'),
        'add_new_item' => __('Add New Radio'),
        'edit_item' => __('Edit Radio'),
        'new_item' => __('New Radio'),
        'view_item' => __('View Radio'),
        'search_items' => __('Search Radio'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );
 
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        '_builtin' => false, // It's a custom post type, not built in
        '_edit_link' => 'post.php?post=%d',
        'capability_type' => 'post',
       // 'rewrite' => array("slug" => "radio"), // Permalinks
        'query_var' => true,
        'menu_position' => null
      );
 
        //   flush_rewrite_rules( false );


    register_post_type( 'radio' , $args );


    }

    add_action('init', 'post_type_radio', 0);

    /*
    // END CUSTOMPOST TYPE: Radio
    */



/* Deletet this whole comment blow - we are registering post type above iwth. the label

	function post_type_radio() {

 
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

*/
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
       // 'author'    =>  'Author',
        'venue' => 'Venue'
    );
    return $columns;
}

function my_custom_columns($column) {

global $post;
 
/* events */

    if($column == 'event_start_date')
    {
    
        if(get_field('event_start_date')){
        $start = get_field('event_start_date'); echo date_i18n('d M Y g:i a', $start);
        }

    }elseif($column == 'event_end_date'){

        if(get_field('event_end_date')){
        $end = get_field('event_end_date'); echo date_i18n('d M Y g:i a', $end);
        }

    }elseif($column == 'venue'){

        if(get_field('venue')){
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

        $code = get_field('release_code'); echo $code;
 
    break;


    }
}




// Add the custom columns to the radio post type:
add_filter( 'manage_radio_posts_columns', 'set_custom_edit_radio_columns' );
function set_custom_edit_radio_columns($columns) {
 
     $columns = array(
        'title'     => 'Title',
      //  'date'      =>  'Date',
        'show_start_date'    =>  'Start',
        'show_end_date'      =>  'End', // this retunring 01 Jan 1970 12:00 am  
        //'author'    =>  'Author',
        'is_item_public' => 'List on Archive'
    );
    return $columns;
}

// Add the data to the custom columns for the releases post type:
add_action( 'manage_radio_posts_custom_column' , 'custom_radio_column', 10, 2 );
function custom_radio_column( $column, $post_id ) {
    global $post;
 
/* events */

    if($column == 'show_start_date')
    {
    
        if(get_field('show_start_date')){
        $start = get_field('show_start_date'); echo date_i18n('d M Y g:i a', $start);
        }

    }elseif($column == 'show_end_date'){

        if(get_field('show_end_date')){
            
        $end = get_field('show_end_date');
       // echo $end;
        //echo date_i18n('d M Y g:i a', $end); // this retunring 01 Jan 1970 12:00 am  
        echo date_i18n('d M Y g:i a', $end);
        }

    }elseif($column == 'is_item_public'){

        if(get_field('is_item_public')){
        $public = get_field('is_item_public');

            if ($public == '1'){
                echo 'true';
            }
        }
    
    } 

}
//END - Add the custom columns to the radio post type:



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

// go trough my code and remove any traces of system

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

    wp_enqueue_script(
        'headroom',
        'https://cdnjs.cloudflare.com/ajax/libs/headroom/0.10.3/headroom.min.js',
        array('jquery'),
        false,
        true
    );

    wp_enqueue_script(
        'headroom-jquery',
        'https://cdnjs.cloudflare.com/ajax/libs/headroom/0.10.3/jQuery.headroom.min.js',
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




// Enqueue WordPress theme styles within Gutenberg. 
// I need to find a better solution for this.
// have disabled this for now, because causing issues with CMS markups
//function theme_editor_styles() {
    //wp_enqueue_style( 'editor-style', get_stylesheet_directory_uri() . '/css/editor.css' ); // i basically need to make another stylesheet for my admin
  //  wp_enqueue_style( 'editor-style', get_stylesheet_uri() ); // i basically need to make another stylesheet for my admin

   // wp_enqueue_style( 'system-style', get_stylesheet_uri() );


//}
//add_action( 'enqueue_block_editor_assets', 'theme_editor_styles' );


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