<?php
//* Add Custom Post Type for Team Members
if ( ! function_exists('custom_post_obv_team') ) {

// Register Custom Post Type
	function custom_post_obv_team() {

		$labels = array(
			'name'                => _x( 'Team Members', 'Post Type General Name', 'onebluevoice' ),
			'singular_name'       => _x( 'Team Member', 'Post Type Singular Name', 'onebluevoice' ),
			'menu_name'           => __( 'Team Members', 'onebluevoice' ),
			'name_admin_bar'      => __( 'Team Members', 'onebluevoice' ),
			'parent_item_colon'   => __( 'Parent Item:', 'onebluevoice' ),
			'all_items'           => __( 'All Items', 'onebluevoice' ),
			'add_new_item'        => __( 'Add New Item', 'onebluevoice' ),
			'add_new'             => __( 'Add New', 'onebluevoice' ),
			'new_item'            => __( 'New Item', 'onebluevoice' ),
			'edit_item'           => __( 'Edit Item', 'onebluevoice' ),
			'update_item'         => __( 'Update Item', 'onebluevoice' ),
			'view_item'           => __( 'View Item', 'onebluevoice' ),
			'search_items'        => __( 'Search Item', 'onebluevoice' ),
			'not_found'           => __( 'Not found', 'onebluevoice' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'onebluevoice' ),
		);
		$rewrite = array(
			'slug'                => 'team-member',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => __( 'Team Member', 'onebluevoice' ),
			'description'         => __( 'One Blue Voice team members', 'onebluevoice' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
			'taxonomies'          => array( 'obv_team_type','obv_service_type' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-groups',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => 'team-members',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);
		register_post_type( 'obv_team', $args );

	}
	add_action( 'init', 'custom_post_obv_team', 0 );

}

//* Add Custom Post Type for Services
if ( ! function_exists('custom_post_obv_service') ) {

	// Register Custom Post Type
	function custom_post_obv_service() {

		$labels = array(
				'name'                => _x( 'Services', 'Post Type General Name', 'onebluevoice' ),
				'singular_name'       => _x( 'Service', 'Post Type Singular Name', 'onebluevoice' ),
				'menu_name'           => __( 'Services', 'onebluevoice' ),
				'name_admin_bar'      => __( 'Services', 'onebluevoice' ),
				'parent_item_colon'   => __( 'Parent Item:', 'onebluevoice' ),
				'all_items'           => __( 'All Items', 'onebluevoice' ),
				'add_new_item'        => __( 'Add New Item', 'onebluevoice' ),
				'add_new'             => __( 'Add New', 'onebluevoice' ),
				'new_item'            => __( 'New Item', 'onebluevoice' ),
				'edit_item'           => __( 'Edit Item', 'onebluevoice' ),
				'update_item'         => __( 'Update Item', 'onebluevoice' ),
				'view_item'           => __( 'View Item', 'onebluevoice' ),
				'search_items'        => __( 'Search Item', 'onebluevoice' ),
				'not_found'           => __( 'Not found', 'onebluevoice' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'onebluevoice' ),
		);
		$rewrite = array(
				'slug'                => 'service',
				'with_front'          => true,
				'pages'               => true,
				'feeds'               => true,
		);
		$args = array(
				'label'               => __( 'Service', 'onebluevoice' ),
				'description'         => __( 'One Blue Voice Services', 'onebluevoice' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
				'taxonomies'          => array( 'obv_service_type' ),
				'hierarchical'        => true,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-megaphone',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => 'services',
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'rewrite'             => $rewrite,
				'capability_type'     => 'page',
		);
		register_post_type( 'obv_service', $args );

	}
	add_action( 'init', 'custom_post_obv_service', 0 );
}



//* Register Taxonomy for Team Types
if ( ! function_exists( 'custom_taxonomy_team_type' ) ) {

// Register Custom Taxonomy
	function custom_taxonomy_team_type() {

		$labels = array(
			'name'                       => _x( 'Team Member Types', 'Taxonomy General Name', 'onebluevoice' ),
			'singular_name'              => _x( 'Team Member Type', 'Taxonomy Singular Name', 'onebluevoice' ),
			'menu_name'                  => __( 'Team Types', 'onebluevoice' ),
			'all_items'                  => __( 'All Items', 'onebluevoice' ),
			'parent_item'                => __( 'Parent Item', 'onebluevoice' ),
			'parent_item_colon'          => __( 'Parent Item:', 'onebluevoice' ),
			'new_item_name'              => __( 'New Item Name', 'onebluevoice' ),
			'add_new_item'               => __( 'Add New Item', 'onebluevoice' ),
			'edit_item'                  => __( 'Edit Item', 'onebluevoice' ),
			'update_item'                => __( 'Update Item', 'onebluevoice' ),
			'view_item'                  => __( 'View Item', 'onebluevoice' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'onebluevoice' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'onebluevoice' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'onebluevoice' ),
			'popular_items'              => __( 'Popular Items', 'onebluevoice' ),
			'search_items'               => __( 'Search Items', 'onebluevoice' ),
			'not_found'                  => __( 'Not Found', 'onebluevoice' ),
		);
		$rewrite = array(
			'slug'                       => 'team-type',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'obv_team_type', array( 'obv_team' ), $args );

	}
	add_action( 'init', 'custom_taxonomy_team_type', 0 );

}


//* Register Taxonomy for Service Types
if ( ! function_exists( 'custom_taxonomy_service_type' ) ) {

// Register Custom Taxonomy
	function custom_taxonomy_service_type() {

		$labels = array(
			'name'                       => _x( 'Service Types', 'Taxonomy General Name', 'onebluevoice' ),
			'singular_name'              => _x( 'Service Type', 'Taxonomy Singular Name', 'onebluevoice' ),
			'menu_name'                  => __( 'Service Types', 'onebluevoice' ),
			'all_items'                  => __( 'All Items', 'onebluevoice' ),
			'parent_item'                => __( 'Parent Item', 'onebluevoice' ),
			'parent_item_colon'          => __( 'Parent Item:', 'onebluevoice' ),
			'new_item_name'              => __( 'New Item Name', 'onebluevoice' ),
			'add_new_item'               => __( 'Add New Item', 'onebluevoice' ),
			'edit_item'                  => __( 'Edit Item', 'onebluevoice' ),
			'update_item'                => __( 'Update Item', 'onebluevoice' ),
			'view_item'                  => __( 'View Item', 'onebluevoice' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'onebluevoice' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'onebluevoice' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'onebluevoice' ),
			'popular_items'              => __( 'Popular Items', 'onebluevoice' ),
			'search_items'               => __( 'Search Items', 'onebluevoice' ),
			'not_found'                  => __( 'Not Found', 'onebluevoice' ),
		);
		$rewrite = array(
			'slug'                       => 'service-type',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'obv_service_type', array( 'obv_service' , 'obv_team' ), $args );

	}
	add_action( 'init', 'custom_taxonomy_service_type', 0 );

}
