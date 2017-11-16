<?php

// Remove the default loop
remove_action( 'genesis_loop', 'genesis_do_loop' );


// Add custom loop
add_action( 'genesis_loop', 'os_do_loop' );
function os_do_loop() {
	// Get Just Top Level parent Pages
	$args = array(
			'post_type'=> 'obv_service',
			'parent' => 0,
			'sort_order' => 'asc',
			'sort_column'=> 'menu_order',
			'post_status' => 'publish'
	);

	$pages = get_pages($args);
	$thumbsize = 'category-thumb';

	//set counter to help with column classes
	$i = 0;

	//set number of columns desired
	$columns = 2;

	//Add back standard page header
	?>
	<header class="entry-header">
		<h1 class="entry-title" itemprop="headline">Our Services</h1>
	</header>

	<?php

	foreach( $pages as $page ) { ?>
		<div id="service-<?php echo $page->ID; ?>" class="obv_service type-obv_service status-publish obv_service_type-digital-tools entry <?php if( 0 == $i % $columns ) echo 'first' ;?>">
		<a href="<?php echo get_permalink( $page->ID ); ?>" class="link-hover item<?php echo $i; ?>">
			<h4 class="entry-title"><?php echo $page->post_title; ?></h4>
			<?php
				echo get_the_post_thumbnail( $page->ID, 'category-thumb' );
			?>
			<div class="item-hover">
				<div class="item-container">
					<?php echo $page->post_excerpt; ?>
				</div>
			</div>
		</a>
		</div>
		<?php $i++;
	}
}


// Remove post info
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

// Remove the post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

// Display featured image above title
add_action ( 'genesis_entry_header', 'obv_show_featured_image', 7 );
function obv_show_featured_image() {
	if ( $image = genesis_get_image( 'format=url&size=category-thumbnail' ) ) {
		printf( '<div class="category-thumbnail"><a href="%s" rel="bookmark"><img src="%s" alt="%s" /></a></div>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );
	}
}

// Remove the post content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

// Remove entry meta from entry footer incl. markup
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

// Remove the entry title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// Add entry title in .entry-content
add_action( 'genesis_entry_content', 'genesis_do_post_title' );

// Remove post content navigation (for multi-page posts)
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );


genesis();