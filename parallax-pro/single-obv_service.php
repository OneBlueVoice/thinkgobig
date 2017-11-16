<?php

// Remove post info
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

// Remove the post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

// Display featured image above title
add_action( 'genesis_entry_content', 'obv_show_featured_image', 7 );
function obv_show_featured_image() {
	?><h3 class="service-excerpt"><?php the_excerpt(); ?></h3> <?php
	if ( $image = genesis_get_image( 'format=url&size=category-thumbnail' ) ) {
		printf( '<div class="category-thumbnail"><a href="%s" rel="bookmark"><img src="%s" alt="%s" /></a></div>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );
	}
}

// Adds Sub Services Under Single Service
add_action( 'genesis_before_footer', 'add_sub_services', 8 );
function add_sub_services() {
	echo '<div class="services-sub-pages-section sub-service-section"><div class="wrap">';
	echo '<h2>Services in ' . get_the_title() . '</h2>';
	$children = wp_list_pages( 'title_li=&post_type=obv_service&child_of=' . get_the_ID() . '&echo=1' );

	if ( $children ) {
		echo '<ul>' . $children . '</ul>';
	}

	echo '</div></div>';

}

// Gets Any taxonomy Parent of Service Type (Term - Taxonomy)
add_action( 'genesis_before_footer', 'add_service_type_staff', 8 );
function add_service_type_staff() {

	// Puts Taxonomy Parents into Array
	$terms = get_the_terms( $post->ID, 'obv_service_type' );

	//  Make sure $terms is not empty
	//	if ( count( $terms ) == 0 ) {
	//		return;
	//	}
	//	$term = $terms[0];

	// Get Team Members with that Same Service Type Taxonomy
	$args = array(
		'post_type'      => 'obv_team',
		'posts_per_page' => - 1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'post_status'    => 'publish',
		'tax_query'      => array(
			array(
				'taxonomy' => 'obv_service_type',
				'field'    => 'slug',
				'terms'    => array_map( function ( $term ) {
					return $term->slug;
				}, $terms ),
			)
		)
	);

	$teammembers = new WP_Query( $args );

	if ( $teammembers->have_posts() ) {

		echo '<div class="leaders-section sub-service-section"><div class="wrap">';
		echo '<h2>' . get_the_title() . ' Team</h2>';

		while ( $teammembers->have_posts() ) : $teammembers->the_post();
			printf( '<a href="%s" title="$s">%s</a><br/>', get_permalink(), get_the_title(), get_the_title() );
		endwhile;

		echo '</div></div>';

	}

}

// Remove entry meta from entry footer incl. markup
//remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
//remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

// Remove post content navigation (for multi-page posts)
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );


genesis();