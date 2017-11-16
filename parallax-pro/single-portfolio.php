<?php
//* Enqueue FlexSlider
add_action( 'wp_enqueue_scripts', 'obv_enqueue_slick_scripts' );
function obv_enqueue_slick_scripts() {
	wp_enqueue_style( 'slick-styles', '//cdn.jsdelivr.net/jquery.slick/1.5.8/slick.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'slick-theme-styles', '//cdn.jsdelivr.net/jquery.slick/1.5.8/slick-theme.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_script( 'slick', '//cdn.jsdelivr.net/jquery.slick/1.5.8/slick.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'slick-init',  get_stylesheet_directory_uri() . '/js/slick-init.js', array( 'slick' ), '1.0.0', true );
}

//* Force full width content
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove Post Info
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove Post Meta
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* Display custom fields above entry content
add_action( 'genesis_entry_content', 'obv_do_post_content', 9 );
function obv_do_post_content() {

	// Left Half with Portfolio Images
	echo '<div class="main-project-image project-image one-half first">';
		$images = get_field('obv_portfolio_images');
		if( $images ) { ?>
			<div class="slick-slider">
					<?php foreach( $images as $image ): ?>
							<div class="portfolio-image"><img data-lazy="<?php echo $image['sizes']['portfolio']; ?>" alt="<?php echo $image['alt']; ?>" /></div>
					<?php endforeach; ?>
			</div>
			<div class="slider-nav">
					<?php foreach( $images as $image ): ?>
							<div class="portfolio-thumb"><img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" /></div>
					<?php endforeach; ?>
			</div>
		<?php } elseif( has_post_thumbnail() ) {
			$image_args = array(
				'size' => 'portfolio',
			);
			genesis_image( $image_args );
		} else {
			echo '<img src="'. get_stylesheet_directory_uri() .'/images/portfolio.gif" alt="Default portfolio Image" />';
		}
	echo '</div>';

	// Right Half with Content Custom Fields
	echo '<div class="one-half">';
		obv_display_custom_fields();
	echo '</div>';

	echo '<div class="clear"></div>';

}

//* Function to display values of custom fields (if not empty)
function obv_display_custom_fields() {
	$client_name = get_field( 'obv_portfolio_client_name' );
	$portfolio_summary = get_field( 'obv_portfolio_project_summary' );
	$portfolio_link = get_field( 'obv_portfolio_project_link' );
	$terms = get_terms( 'portfolio_category' );

	if ( $client_name || $portfolio_link ) {
		echo '<div class="portfolio-meta">';
		if ( $client_name ) {
			echo '<h4>' . $client_name . '</h4>';
		}
		if ( $portfolio_summary ) {
			echo $portfolio_summary;
		}
		if ( $terms ) {
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
				echo '<h5>OBV Services Used:</h5>';
				echo '<ul>';
				foreach ( $terms as $term ) {
					echo '<li>' . $term->name . '</li>';

				}
				echo '</ul>';
			}
		}
		if ( $portfolio_link ) {
			echo '<a target="_blank" href="' . $portfolio_link . '" class="obv-button button">View Project</a>';
		}
		echo '</div>';
	}
}

//* Previous and Next Post navigation
add_action('genesis_entry_content', 'obv_custom_post_nav');
function obv_custom_post_nav() {
	echo '<div class="prev-next-post-links">';
	previous_post_link('<div class="previous-post-link">&laquo; %link</div>', '<strong>%title</strong>' );
	next_post_link('<div class="next-post-link">%link &raquo;</div>', '<strong>%title</strong>' );
	echo '</div>';
}
genesis();