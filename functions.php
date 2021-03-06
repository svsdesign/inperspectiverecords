<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   
 */
 

//determine if wer're local or nott

$root = get_stylesheet_directory_uri();
//http://localhost:8888/; 
if (strpos($root, 'local') !== false) {
$sitelocation = 'local';
}else{
$sitelocation = 'live';
}
//end determine if wer're local or nott

// add further classes to the admin menu

function wpse_320244_admin_body_class($classes) {
//https://wordpress.stackexchange.com/questions/320244/how-do-i-add-a-custom-body-class-to-the-admin-area-of-a-page
    global $post;
    // get_current_screen() returns object with current admin screen
    // @link https://codex.wordpress.org/Function_Reference/get_current_screen
    $current_screen = get_current_screen();

    if ($sitelocation = 'local'){

        if($current_screen->base === "post" && absint($post->ID) === 3) {
         $classes .= ' admin-page-id-3';
        } 
        elseif($current_screen->base === "post" && absint($post->ID) === 343) {
         $classes .= ' admin-page-id-343';
        }

        return $classes;

    } else {//live site:

        if($current_screen->base === "post" && absint($post->ID) === 3) {
         $classes .= ' admin-page-id-3';
        } 
        elseif($current_screen->base === "post" && absint($post->ID) === 343) { // review this - it probably be diff id
         $classes .= ' admin-page-id-343';
        }

        return $classes;

    }//if ($sitelocation = 'local'

}

add_filter('admin_body_class', 'wpse_320244_admin_body_class');

// END add further classes to the admin menu


/* "Un-register" the normal post + associated functions and options
https://www.mitostudios.com/blog/how-to-remove-posts-blog-post-type-from-wordpress/ */

// Remove side menu
add_action( 'admin_menu', 'remove_default_post_type' );

function remove_default_post_type() {
    remove_menu_page( 'edit.php' );
}

// Remove +New post in top Admin Menu Bar
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}

// Remove Quick Draft Dashboard Widget
add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );

function remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}

// End remove normal post type


/* de-register/enqueue the cookie notice css scripts 
"cookie-notice-front"
        wp_enqueue_style( 'cookie-notice-front', plugins_url( 'css/front' . ( ! ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '.min' : '' ) . '.css', __FILE__ ) );

*/

add_action( 'wp_enqueue_scripts', 'remove_default_stylesheet', 20 );
function remove_default_stylesheet() {
      wp_dequeue_style( 'cookie-notice-front' ); // cookie notice plugin
  //  wp_deregister_style( 'original-register-stylesheet-handle' );
 
   // wp_register_style( 'new-style', get_stylesheet_directory_uri() . '/new.css', false, '1.0.0' ); 
    //wp_enqueue_style( 'new-style' );
}

//


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



/* This seemingly made the pagination work - but each page just displays the firs page set of posts

    function bamboo_request($query_string )
    {
        if( isset( $query_string['page'] ) ) {
            if( ''!=$query_string['page'] ) {
                if( isset( $query_string['name'] ) ) {
                    unset( $query_string['name'] );
                }
            }
        }
        return $query_string;
    }
    add_filter('request', 'bamboo_request');

    add_action('pre_get_posts','bamboo_pre_get_posts');
    function bamboo_pre_get_posts( $query ) { 
        if( $query->is_main_query() && !$query->is_feed() && !is_admin() ) { 
            $query->set( 'paged', str_replace( '/', '', get_query_var( 'page' ) ) ); 
        } 
    }
*/

 
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
            // 'label'               => __( 'News', 'inperspectiverecords' ),
            // 'description'         => __( 'Inperspective Label News', 'inperspectiverecords' ),
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
            '_builtin' => false, // It's a custom post type, not built in
            '_edit_link' => 'post.php?post=%d',
            'capability_type' => 'post',
            'rewrite' =>  $rewrite,
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
          //  'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            // 'query_var'           => true,
            // 'rewrite' => array('slug' => 'news', 'with_front' => true ),
            $rewrite = array(
                'slug'                  => 'news',
                'with_front'            => true,
                'pages'                 => true,
                'feeds'                 => true,
            ),

            // 'query_var'           => 'post_type',//false,
            'exclude_from_search' => false,
            'publicly_queryable'  => true
         );
         
        // Registering your Custom Post Type
    //  flush_rewrite_rules(false);
    //  flush_rewrite_rules();
 
        register_post_type( 'news', $args );

    }
    

     
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
     
    add_action( 'init', 'post_type_news' );
 
 /*   add_action( 'pre_get_posts', function ( $query ) {
        if ( $query->is_post_type_archive( 'news' ) && $query->is_main_query() && ! is_admin() ) {
          $query->set( 'posts_per_page', 7 );
        }
      } );
      */
   /* add_action( 'pre_get_posts', function ( $q ) {

        if( !is_admin() && $q->is_main_query() && $q->is_post_type_archive( 'news' ) ) {
    
            $q->set( 'posts_per_page', 5 );
    
        }
    
    });*/
 /*
    function custom_posts_per_page( $query ) {

        if ( $query->is_archive('news') ) {
            set_query_var('posts_per_page', 5);
        }
        }
        add_action( 'pre_get_posts', 'custom_posts_per_page' );*/

    /*
    add_action( 'pre_get_posts' ,'wpse222471_query_post_type_news', 1, 1 );
    function wpse222471_query_post_type_portofolio( $query )
    {
        if ( ! is_admin() && is_post_type_archive( 'news' ) && $query->is_main_query() )
        {
            $query->set( 'posts_per_page', 5 ); //set query arg ( key, value )
        }
    }*/


/*
 
function set_posts_per_page_for_news( $news_query ) {
    if ( !is_admin() &&  $news_query ->is_main_query() && is_post_type_archive( 'news' ) ) {
      $news_query->set( 'posts_per_page', '6' );
    }
  }
  add_action( 'pre_get_posts', 'set_posts_per_page_for_news' );
 */
  
/*
    add_action( 'parse_query','changept' );
    function changept() {
        if( is_category() && !is_admin() )
            // set_query_var( 'post_type', array( 'post', 'your_custom_type' ) );
            set_query_var( 'post_type', array( 'post', 'news' ) );

            return;
    }
*/

    /**
 * Fix pagination on archive pages
 * After adding a rewrite rule, go to Settings > Permalinks and click Save to flush the rules cache
 */
/*
function my_pagination_rewrite() {
    add_rewrite_rule('news/page/?([0-9]{1,})/?$', 'index.php?category_name=blog&paged=$matches[1]', 'top');
}
add_action('init', 'my_pagination_rewrite');
*/

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
    
        // register a spacer block
    
       
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
            'supports' 		=> array(
                'align' 	=> false,
            ),
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
            'supports' 		=> array(
                'align' 	=> false,
            ),
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
            'keywords'          => array('inprelease'),
            'supports' 		=> array(
                'align' 	=> false,
            ),
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

  // register an gallery block:
       //https://www.advancedcustomfields.com/resources/acf_register_block_type/#examples
        acf_register_block(array(
            'name'              => 'inpgallery',
            'title'             => __('Inp Gallery'),
            'description'       => __('A custom gallery block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',
          //  'enqueue_script'    => '',

            'enqueue_assets'    => function(){
            //  wp_enqueue_script('flickity-pgkd','https://npmcdn.com/flickity@2/dist/flickity.pkgd.js', array('jquery'), false, true);
           //    wp_enqueue_style( 'flickity styles', 'https://npmcdn.com/flickity@2.2.1/dist/flickity.css' );
//  //  wp_enqueue_style( 'flickity-style', 'https://npmcdn.com/flickity@2.2.1/dist/flickity.css'); // Styles moved into "block-gallery.scss"
              wp_enqueue_script('flickity-pgkd', 'https://npmcdn.com/flickity@2/dist/flickity.pkgd.js', array( 'jquery' ), '', true );
              wp_enqueue_script('inp-gallery-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inpgallery/assets/js/script.js', array( 'jquery' ), '', true );

            },

            'icon'              => 'format-gallery',
          //'mode'              => 'preview',//"auto" or "preview" This lets you control how the block is presented the Gutenberg block editor. The default is “auto” which renders the block to match the frontend until you select it, then it becomes an editor. If set to “preview” it will always look like the frontend and you can edit content in the sidebar.
            'supports'          => array( 'mode' => false ),
            'keywords'          => array( 'inpgallery'),
            'supports' 		=> array(
                'align' 	=> false,
            ),
        ));

        
        acf_register_block(array(
            'name'              => 'inpmerch',
            'title'             => __('Inp Merch'),
            'description'       => __('A custom merch block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',
            'enqueue_assets'    => function(){
         //     wp_enqueue_script('inp-merch-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inpmerch/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'universal-access',
          //'mode'              => 'preview',//"auto" or "preview" This lets you control how the block is presented the Gutenberg block editor. The default is “auto” which renders the block to match the frontend until you select it, then it becomes an editor. If set to “preview” it will always look like the frontend and you can edit content in the sidebar.
            'keywords'          => array( 'inpmerch'),
            'supports' 		=> array(
                'align' 	=> false,
                'mode' => false 
            ),
        ));

        acf_register_block(array(
            'name'              => 'inpevent',
            'title'             => __('Inp Event'),
            'description'       => __('A custom event block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',
            'enqueue_assets'    => function(){
         //     wp_enqueue_script('inp-event-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inpevent/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'calendar-alt',
          //'mode'              => 'preview',//"auto" or "preview" This lets you control how the block is presented the Gutenberg block editor. The default is “auto” which renders the block to match the frontend until you select it, then it becomes an editor. If set to “preview” it will always look like the frontend and you can edit content in the sidebar.
             'keywords'          => array( 'inpevent'),
             'supports' 		=> array(
                'align' 	=> false,
                'mode' => false 
            ),
        ));

        acf_register_block(array(
            'name'              => 'inpspacer',
            'title'             => __('Inp Spacer'),
            'description'       => __('A Spacer block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-credit-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inpcredit/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array( 'inpspacer'),
            'supports' 		=> array(
                'align' 	=> false,
                'mode' => false 
            ),
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



/**
 * Templates and Page IDs without editor
 *
 */
function ea_disable_editor( $id = false ) {

	$excluded_templates = array(
		// 'page-grid.php'//,
		//'templates/contact.php'
	);

	$excluded_ids = array(
        get_option( 'page_on_front' ), // home = 237
        679, // About Page
        681, // home page
        574 // news
	);

	if( empty( $id ) )
		return false;

	$id = intval( $id );
	$template = get_page_template_slug( $id );

	return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}

/**
 * Disable Gutenberg by template
 *
 */
function ea_disable_gutenberg( $can_edit, $post_type ) {

	if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
		return $can_edit;

	if( ea_disable_editor( $_GET['post'] ) )
        $can_edit = false;
        
    if ($post_type === 'projects') 
        return false;

	return $can_edit;

}
add_filter( 'gutenberg_can_edit_post_type', 'ea_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'ea_disable_gutenberg', 10, 2 );

/**
 * Disable Classic Editor by template
 *
 */
 
function ea_disable_classic_editor() {

	$screen = get_current_screen();
	if( 'page' !== $screen->id || ! isset( $_GET['post']) )
		return;

	if( ea_disable_editor( $_GET['post'] ) ) {
		remove_post_type_support( 'page', 'editor' );
	}

}
add_action( 'admin_head', 'ea_disable_classic_editor' );

/**
 * Allow Block options
 *
 */
 
function allowed_block_types( $allowed_blocks, $post ) {
 
	$allowed_blocks = array(
        'acf/inpquote',
        'acf/inpcredit',
        'acf/inpartist',
        'acf/inptext',
        'acf/inpsound',
        'acf/inprelease',
        'acf/inpimage',
        'acf/inpgallery',
        // 'acf/inpmerch', enable when finished
        'acf/inpevent',
        'acf/inpspacer'
	);
 
	if( $post->post_type === 'page' ) {
        $allowed_blocks[] = 
       // 'core/shortcode';
        'core/paragraph';// consider keeping this

	}
 
	return $allowed_blocks;
 
}
add_filter( 'allowed_block_types', 'allowed_block_types', 10, 2 );

 

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



    // START CUSTOM POST TYPE: Radio


    function post_type_radio() {

     $labels = array(
        'name' => _x('Podcasts', 'post type general name'),
        'singular_name' => _x('Podcasts', 'post type singular name'),
        'add_new' => _x('Add New', 'podcast'),
        'add_new_item' => __('Add New Podcasts'),
        'edit_item' => __('Edit Podcasts'),
        'new_item' => __('New Podcasts'),
        'view_item' => __('View Podcasts'),
        'search_items' => __('Search Podcasts'),
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
        'rewrite' => array("slug" => "podcasts"), // Permalinks
        // 'query_var' => true,
        'menu_position' => null
      );
 
  flush_rewrite_rules( false );

    register_post_type( 'radio' , $args );
    flush_rewrite_rules();


    }

    add_action('init', 'post_type_radio', 0);

    /*
    // END CUSTOMPOST TYPE: Radio
    */

    add_action( 'pre_get_posts' ,'wpse222471_query_post_type_radio', 1, 1 );
    function wpse222471_query_post_type_portofolio( $query )
    {
        if ( ! is_admin() && is_post_type_archive( 'radio' ) && $query->is_main_query() )
        {
            $query->set( 'posts_per_page', 6 ); //set query arg ( key, value )
        }
    }



/* setting pagination */
// 1. Pre aug 19' I'm not sure this - radio pagination - is being used - or works- doesn't work because I'm dong a new query 
// 2. Aug 19' - !should remove that (in the radio-arhive.php template, as I did for news - i.e the below for news works now :)
// 3. doesnt updae teh links / or content
function set_posts_per_page_for_radio( $radio_query ) {
    if ( !is_admin() &&  $radio_query ->is_main_query() && is_post_type_archive( 'radio' ) ) {
      $radio_query->set( 'posts_per_page', '4' );
    }
  }
  //add_action( 'pre_get_posts', 'set_posts_per_page_for_radio' );
  // end I'm not sure this - radio pagination - is being used - or works?
  
  
  
  /* setting pagination */
   function set_posts_per_page_for_news( $news_query ) {
    if ( !is_admin() &&  $news_query->is_main_query() && is_post_type_archive( 'news' ) ) {
      $news_query->set( 'posts_per_page', '16' );
    }
  }
  //add_action( 'pre_get_posts', 'set_posts_per_page_for_news' );
   /* end setting pagination */
  
  /* setting pagination number */

 
/*
// END CUSTOMPOST TYPE: Radio

 

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



/* EVENT COLUMNS START */


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
add_action("manage_posts_custom_column", "my_custom_columns");
add_filter("manage_edit-events_columns", "my_page_columns");



function my_set_sortable_columns( $columns )
{
    $columns['event_start_date'] = 'event_start_date';
    return $columns;
}
   // make columns sortable
add_filter( 'manage_edit-events_sortable_columns', 'my_set_sortable_columns' );


 
function event_date_column_orderby( $vars ) {
if ( isset( $vars['orderby'] ) && 'event_start_date' == $vars['orderby'] ) {
    $vars = array_merge( $vars, array(
        'meta_key' => 'event_start_date',
        'orderby' => 'meta_value'
    ) );
}

return $vars;
}
add_filter( 'request', 'event_date_column_orderby' );
 
/* EVENT COLUMNS END */



/* RELEASE COLUMNS START */

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

/* RELEASE COLUMNS END */

/* RADIO COLUMNS START*/


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

    if($column == 'show_start_date') {
    
        if(get_field('show_start_date')){
        $start = get_field('show_start_date'); echo date_i18n('d M Y g:i a', $start);
        }

    } elseif($column == 'show_end_date'){

        if(get_field('show_end_date')){
            
        $end = get_field('show_end_date');
       // echo $end;
        //echo date_i18n('d M Y g:i a', $end); // this retunring 01 Jan 1970 12:00 am  
        echo date_i18n('d M Y g:i a', $end);
        }

    } elseif($column == 'is_item_public'){

        if(get_field('is_item_public')){
        $public = get_field('is_item_public');

            if ($public == '1'){
                echo 'true';
            }
        }
    
    } 

}
//END - Add the custom columns to the radio post type:


function my_radio_sortable_columns( $columns )
{
    $columns['show_start_date'] = 'show_start_date';
    return $columns;
}
   // make columns sortable
add_filter( 'manage_edit-radio_sortable_columns', 'my_radio_sortable_columns' );

function radio_date_column_orderby( $vars ) {
   
    if ( isset( $vars['orderby'] ) && 'show_start_date' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'show_start_date',
            'orderby' => 'meta_value'
        ) );
    }
    return $vars;

}
add_filter( 'request', 'radio_date_column_orderby' );
 
 
/* RADIO COLUMNS END */



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

 
/* fields: in CPT: releases. releases_artists - field key: field_5c44546ed39be 

*/

/* 
        this function shows how to create a simple two way relationship field
        the example assumes that you are using either a single relationship field
        where posts of the same type are related or you can have 2 relationship
        fields on two different post types. this example also assumes that
        the relationship field(s) do not impose any limits on the number
        of selections
        
        The concept covered in this file has also been coverent on the ACF site
        on this page https://www.advancedcustomfields.com/resources/bidirectional-relationships/
        The example shown there is very similar, but requires but is created to work
        where the field name is the same, similar to my plugin that does this.
        This example will let you have fields of different names
    */
    
  
    if ($sitelocation = "local"){ // if local: different field keys (although not in this case)
 
       // add the filter for your relationship field
        add_filter('acf/update_value/key=field_5c44546ed39be', 'acf_reciprocal_relationship', 10, 3);
        // if you are using 2 relationship fields on different post types
        // add second filter for that fields as well
        add_filter('acf/update_value/key=field_5c44564c6a48d', 'acf_reciprocal_relationship', 10, 3);


    } else {// live site:

          // add the filter for your relationship field
        add_filter('acf/update_value/key=field_5c44546ed39be', 'acf_reciprocal_relationship', 10, 3);
        // if you are using 2 relationship fields on different post types
        // add second filter for that fields as well
        add_filter('acf/update_value/key=field_5c44564c6a48d', 'acf_reciprocal_relationship', 10, 3);



    }// if $sitelocation = ""

    function acf_reciprocal_relationship($value, $post_id, $field) {
        
        // set the two fields that you want to create
        // a two way relationship for
        // these values can be the same field key
        // if you are using a single relationship field
        // on a single post type
        
        // the field key of one side of the relationship
    
        if ($sitelocation = "local"){ // if local: different field keys

            $key_a = 'field_5c44546ed39be'; //"artist content": field name releases_artists // local site
            // the field key of the other side of the relationship
            // as noted above, this can be the same as $key_a
            $key_b = 'field_5c44564c6a48d'; //:"Release Content": field name releases_artists //local site
     
        } else{ //live:

           $key_a = 'field_5c44546ed39be'; //"artist content": field name releases_artists // local site
            // the field key of the other side of the relationship
            // as noted above, this can be the same as $key_a
            $key_b = 'field_5c44564c6a48d'; //:"Release Content": field name releases_artists //local site


        } 
          //if local or live     
        // figure out wich side we're doing and set up variables
        // if the keys are the same above then this won't matter
        // $key_a represents the field for the current posts
        // and $key_b represents the field on related posts
        if ($key_a != $field['key']) {
            // this is side b, swap the value
            $temp = $key_a;
            $key_a = $key_b;
            $key_b = $temp;
        }
        
        // get both fields
        // this gets them by using an acf function
        // that can gets field objects based on field keys
        // we may be getting the same field, but we don't care
        $field_a = acf_get_field($key_a);
        $field_b = acf_get_field($key_b);
        
        // set the field names to check
        // for each post
        $name_a = $field_a['name'];
        $name_b = $field_b['name'];
        
        // get the old value from the current post
        // compare it to the new value to see
        // if anything needs to be updated
        // use get_post_meta() to a avoid conflicts
        $old_values = get_post_meta($post_id, $name_a, true);
        // make sure that the value is an array
        if (!is_array($old_values)) {
            if (empty($old_values)) {
                $old_values = array();
            } else {
                $old_values = array($old_values);
            }
        }
        // set new values to $value
        // we don't want to mess with $value
        $new_values = $value;
        // make sure that the value is an array
        if (!is_array($new_values)) {
            if (empty($new_values)) {
                $new_values = array();
            } else {
                $new_values = array($new_values);
            }
        }
        
        // get differences
        // array_diff returns an array of values from the first
        // array that are not in the second array
        // this gives us lists that need to be added
        // or removed depending on which order we give
        // the arrays in
        
        // this line is commented out, this line should be used when setting
        // up this filter on a new site. getting values and updating values
        // on every relationship will cause a performance issue you should
        // only use the second line "$add = $new_values" when adding this
        // filter to an existing site and then you should switch to the
        // first line as soon as you get everything updated
        // in either case if you have too many existing relationships
        // checking end updated every one of them will more then likely
        // cause your updates to time out.
        //$add = array_diff($new_values, $old_values);
        $add = $new_values;
        $delete = array_diff($old_values, $new_values);
        
        // reorder the arrays to prevent possible invalid index errors
        $add = array_values($add);
        $delete = array_values($delete);
        
        if (!count($add) && !count($delete)) {
            // there are no changes
            // so there's nothing to do
            return $value;
        }
        
        // do deletes first
        // loop through all of the posts that need to have
        // the recipricol relationship removed
        for ($i=0; $i<count($delete); $i++) {
            $related_values = get_post_meta($delete[$i], $name_b, true);
            if (!is_array($related_values)) {
                if (empty($related_values)) {
                    $related_values = array();
                } else {
                    $related_values = array($related_values);
                }
            }
            // we use array_diff again
            // this will remove the value without needing to loop
            // through the array and find it
            $related_values = array_diff($related_values, array($post_id));
            // insert the new value
            update_post_meta($delete[$i], $name_b, $related_values);
            // insert the acf key reference, just in case
            update_post_meta($delete[$i], '_'.$name_b, $key_b);
        }
        
        // do additions, to add $post_id
        for ($i=0; $i<count($add); $i++) {
            $related_values = get_post_meta($add[$i], $name_b, true);
            if (!is_array($related_values)) {
                if (empty($related_values)) {
                    $related_values = array();
                } else {
                    $related_values = array($related_values);
                }
            }
            if (!in_array($post_id, $related_values)) {
                // add new relationship if it does not exist
                $related_values[] = $post_id;
            }
            // update value
            update_post_meta($add[$i], $name_b, $related_values);
            // insert the acf key reference, just in case
            update_post_meta($add[$i], '_'.$name_b, $key_b);
        }
        
        return $value;
        
    } // end function acf_reciprocal_relationship


/* end acf_reciprocal_relationship fields functions */

 

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

        if ( !is_admin() ) :
            // Remove as we don't want WP built it jQuery
            wp_deregister_script( 'jquery' );

        endif;
    // wp_enqueue_script('jquery');

    wp_enqueue_style( 'inp-style', get_stylesheet_directory_uri().'/dist/css/style.min.css' );
  
  


 // Browserify & jQuery for local development
 if ( $_SERVER['REMOTE_ADDR'] === '::1' || $_SERVER['REMOTE_ADDR'] === '127.0.0.1' ):

    wp_enqueue_script( 'jquery', get_template_directory_uri() .'/dist/js/jquery.js', array(), null, false );
    wp_enqueue_script( '__bs_script__', 'http://'. $_SERVER['SERVER_NAME'] .':3000/browser-sync/browser-sync-client.js', array(), '2.17.3', true );

else:

    wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', array(), null, false );

endif;

// Pull in any vendors scripts and site app
wp_enqueue_script('inp-vendors', get_template_directory_uri() .'/dist/js/vendors.min.js', array('jquery'), filemtime( get_stylesheet_directory().'/dist/js/vendors.min.js' ), true );
wp_enqueue_script('inp-app', get_template_directory_uri() .'/dist/js/app.min.js', array('jquery','inp-vendors'), filemtime( get_stylesheet_directory().'/dist/js/app.min.js' ), true );

// Localise our app scipt above with any PHP/site variables we may need - might not need this;'r evies
$theme_vars = array(
    'base_url' => home_url(),
    'template_url' => get_stylesheet_directory_uri(),
    'root' => esc_url_raw( rest_url() ),
    'nonce' => wp_create_nonce( 'wp_rest' )
);
wp_localize_script('inp-app', 'WP_settings', $theme_vars );




};
add_action('wp_enqueue_scripts', 'inp_scripts');



function my_admin_block_assets() {
 
	//wp_enqueue_style('admin-artist-block',''.get_stylesheet_directory_uri().'/template-parts/blocks/inpartist/assets/css/style.css', array(), '1');
	wp_enqueue_style('admin-blocks',''.get_stylesheet_directory_uri().'/dist/css/admin.style.min.css', array(), '1');

	//enquire js
	// wp_enqueue_script('th-admin-enquire', ''.get_stylesheet_directory_uri().'/assets/js/enquire.js', array( 'jquery' ), '', true );


	 // admin js: - review
	wp_enqueue_script('inp-admin-site', ''.get_stylesheet_directory_uri().'/dist/js/app.admin.min.js', array( 'jquery' ), '', true );

}
add_action( 'enqueue_block_editor_assets', 'my_admin_block_assets' );
 

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



/*admin favicons */
 function add_favicon() {
    $favicon_url = get_stylesheet_directory_uri();
    echo'<link rel="apple-touch-icon" sizes="180x180" href="'. $favicon_url .'/assets/site-icons/back-end/apple-touch-icon.png">';
    echo'<link rel="icon" type="image/png" sizes="32x32" href="'. $favicon_url .'/assets//site-icons/back-end/favicon-32x32.png">';
        '<link rel="icon" type="image/png" sizes="16x16" href="'. $favicon_url .'/assets/site-icons/back-end/favicon-16x16.png">';
        '<link rel="manifest" href="'. $favicon_url .'/assets/site-icons/back-end/site.webmanifest">';
        '<link rel="mask-icon" href="'. $favicon_url .'/assets/site-icons/back-end/safari-pinned-tab.svg" color="#f0523b">';
        '<link rel="shortcut icon" href="'. $favicon_url .'./assets/site-icons/back-end/favicon.ico">';
        '<meta name="msapplication-TileColor" content="#ffffff">';
        '<meta name="msapplication-config" content="'. $favicon_url .'/assets/site-icons/back-end/browserconfig.xml">';
        '<meta name="theme-color" content="#ffffff">';

}
add_action('login_head', 'add_favicon');
add_action('admin_head', 'add_favicon');
/* end admin favicons */

?>