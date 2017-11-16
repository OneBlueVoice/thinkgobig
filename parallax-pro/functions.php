<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'parallax', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'parallax' ) );

//* Add Image upload to WordPress Theme Customizer
add_action( 'customize_register', 'parallax_customizer' );
function parallax_customizer(){

	require_once( get_stylesheet_directory() . '/lib/customize.php' );
	
}

//* Include Section Image CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Parallax Pro Theme' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/parallax/' );
define( 'CHILD_THEME_VERSION', '1.2.2' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'parallax_enqueue_scripts_styles' );
function parallax_enqueue_scripts_styles() {

	wp_enqueue_script( 'parallax-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'parallax-google-fonts', '//fonts.googleapis.com/css?family=Montserrat|Sorts+Mill+Goudy', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_nav' );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'parallax_secondary_menu_args' );
function parallax_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Add support for additional color styles
add_theme_support( 'genesis-style-selector', array(
	'parallax-pro-blue'   => __( 'Parallax Pro Blue', 'parallax' ),
	'parallax-pro-green'  => __( 'Parallax Pro Green', 'parallax' ),
	'parallax-pro-orange' => __( 'Parallax Pro Orange', 'parallax' ),
	'parallax-pro-pink'   => __( 'Parallax Pro Pink', 'parallax' ),
) );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 360,
	'height'          => 70,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'footer-widgets',
	'footer',
) );

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'parallax_author_box_gravatar' );
function parallax_author_box_gravatar( $size ) {

	return 176;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'parallax_comments_gravatar' );
function parallax_comments_gravatar( $args ) {

	$args['avatar_size'] = 120;

	return $args;

}

//* Add custom image sizes
add_image_size('staff',200,200,true);
add_image_size( 'portfolio', 500, 0, true ); // For Portfolio Post Type
add_image_size( 'category-thumb', 450, 338, true );  // For Archive Services

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 1 );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-section-1',
	'name'        => __( 'Home Section 1', 'parallax' ),
	'description' => __( 'This is the home section 1 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-2',
	'name'        => __( 'Home Section 2', 'parallax' ),
	'description' => __( 'This is the home section 2 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-3',
	'name'        => __( 'Home Section 3', 'parallax' ),
	'description' => __( 'This is the home section 3 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-4',
	'name'        => __( 'Home Section 4', 'parallax' ),
	'description' => __( 'This is the home section 4 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-5',
	'name'        => __( 'Home Section 5', 'parallax' ),
	'description' => __( 'This is the home section 5 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'leadership-section',
	'name'        => __( 'Leadership Team', 'parallax' ),
	'description' => __( 'This is a modular section for adding the leadership team.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'services-section',
	'name'        => __( 'Services Section', 'parallax' ),
	'description' => __( 'This is a modular section for adding services icons.', 'parallax' ),
) );


//* Add custom post types and taxonomies
require_once('inc/obv_cpts.php'); // CG

//* Show Staff Type custom taxonomy terms and tags
add_filter( 'genesis_post_meta', 'custom_portfolio_post_meta' );
function custom_portfolio_post_meta( $post_meta ) {

	if ( is_post_type_archive( 'obv_team' ) )
		$post_meta = '[post_terms taxonomy="obv_team_type" before="Position: "]';

	return $post_meta;

}

//* Remove the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Show Staff Type custom taxonomy terms and tags
add_action( 'genesis_entry_header', 'custom_post_header' );
function custom_post_header( ) {

	if ( is_post_type_archive( 'obv_team' ) ) {

		$title   = get_field( "obv_team_title" );

		//Add Custom Field for title/position
		if ( $title ) {
			printf( '<div class="obv-team title">%s</div>', $title );
		}
	}

}


//* Add Leadership Team to certain pages
add_action ('genesis_before_footer' , 'add_leadership_team', 9);
function add_leadership_team() {

	if (is_page ('who-we-are') ) {
		//* Add markup for widget
		genesis_widget_area( 'leadership-section', array(
			'before' => '<div class="leadership-section widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	}
}

//* Add Leadership Team to certain pages
add_action ('genesis_before_footer' , 'add_services_section', 9);
function add_services_section() {

	if (is_page ('what-we-do') ) {
		//* Add markup for widget
		genesis_widget_area( 'services-section', array(
			'before' => '<div class="services-section widget-area"><div class="wrap"><h4 class="widget-title">One Blue Voice Services</h4>',
			'after'  => '</div></div>',
		) );
	}
}



add_filter('widget_text', 'do_shortcode');
// Add Shortcode
function custom_shortcode_service( $atts ) {

	// Attributes
	extract( shortcode_atts(
			array(
				'icon' => 'dashicons-groups',
				'title' => 'This is a Title',
				'link' => 'http://onebluevoice.com',
			), $atts )
	);

	// Code
	$output .= '<div class="service-section">';
	$output .= '<div><a href="' . $link .'"><span class="dashicons ' . $icon . '"></span></a></div>';
	$output .= '<div><a href="' . $link .'"><span class="title">' . $title . '</span></a></div>';
	$output .= '</div>';
	return $output;
}
add_shortcode( 'service', 'custom_shortcode_service' );
