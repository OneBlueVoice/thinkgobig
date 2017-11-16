<?php
/**
 * This file adds the custom staff team member post type single post template.
 *
 */
//* Force full width content layout
// add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the entry meta in the entry header
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//* Remove the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the author box on single posts
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

//* Remove the post meta function
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* Custom Elements from Custom Fields
add_action ('genesis_entry_content' , 'add_obv_team_custom_fields' , 9);
function add_obv_team_custom_fields() {
	$title   = get_field( "obv_team_title" );
	$quote   = get_field( "obv_team_quote" );
	$twitter = get_field( "obv_team_twitter" );
	$fname = get_field( "obv_team_first_name" );
	$lname = get_field( "obv_team_last_name" );

	//Add featured Image thumbnail
	if ( $image = genesis_get_image( 'format=url&size=staff' ) ) {
		printf( '<div class="obv-team-image"><img src="%s" alt="%s" class="alignleft" /></div>', $image, the_title_attribute( 'echo=0' ) );
	}

	//Add back the title
	genesis_do_post_title();

	//Add Custom Field for title/position
	if ($title) {
		printf( '<div class="obv-team title">%s</div>', $title );
	}

	//Add Custom Field for quote
	if ($quote) {
		printf( '<div class="obv-team quote">%s</div>', $quote );
	}

	//Add Custom Field for twitter username/link
	if ($twitter) {
		printf ( '<div class="obv-team twitter"><a href="http://twitter.com/%s"><span class="dashicons dashicons-twitter"></span> Follow %s on Twitter</a></div>', $twitter, $fname );
	}

}



genesis();