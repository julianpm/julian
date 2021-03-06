<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package julian
 */

if ( ! function_exists( 'jul_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function jul_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'jul' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'jul' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'jul_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function jul_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'jul' ) );
		if ( $categories_list && jul_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'jul' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'jul' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'jul' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'jul' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'jul' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function jul_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'jul_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'jul_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so jul_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so jul_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in jul_categorized_blog.
 */
function jul_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'jul_categories' );
}
add_action( 'edit_category', 'jul_category_transient_flusher' );
add_action( 'save_post',     'jul_category_transient_flusher' );

/**
 * Display navigation to next/previous post when applicable.
 * CUSTOM SINGLE-POST NAVIGATION
 * TO GO IN TEMPLATE TAGS
 */
function jul_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<div class="row section-padding">
		<div class="columns small-12">	
			<nav class="navigation posts-navigation" role="navigation">
				<div class="nav-links">
					<?php previous_post_link( '<div class="nav-previous">%link</div>', 'Previous' ); ?>
					<?php next_post_link( '<div class="nav-next">%link</div>', 'Next' ); ?>
				</div><!-- .nav-links -->
			</nav><!-- .navigation -->
		</div>
	</div>
	<?php
}

// SOCIAL MEDIA REPEATER
function jul_social_media(){
	if ( function_exists( 'get_field' ) ){
		$social_icons = get_field( 'jul_social_icons', 'option' );

		if ( $social_icons ){

			foreach ( $social_icons as $social_icon ){
				$social_link = $social_icon['jul_social_media_link'];
				$social_icon = $social_icon['jul_social_media_icon'];

				if ( $social_link && $social_icon ){ ?>

					<a href="<?php echo esc_url( $social_link ); ?>">
						<i class="fa fa-<?php echo esc_html( $social_icon ); ?>" aria-hidden="true"></i>
					</a>

				<?php }

			}

		}

	}
}

// ABOUT INFO
function jul_about(){
	if ( function_exists( 'get_field' ) ){
		$about = get_field( 'jul_about', 'option' );

		if ( $about ){ ?>

			<div class="row section-padding" id="about">
				<div class="columns small-12">
					<?php echo wp_kses_post( $about ); ?>
				</div>
			</div>

		<?php }

	}
}

// CONTACT INFO
function jul_contact(){
	if ( function_exists( 'get_field' ) ){
		$contact = get_field( 'jul_contact', 'option' );

		if ( $contact ){ ?>

			<div class="row section-padding" id="contact">
				<div class="columns small-12">
					<?php echo wp_kses_post( $contact ); ?>
				</div>
			</div>

		<?php }

	}
}

// SITE LINK
function jul_site_link(){
	if ( function_exists( 'get_field' ) ){
		$site_link = get_field( 'jul_site_link' );
		$site_link_text = get_field( 'jul_site_link_text' );

		if ( $site_link && $site_link_text ){ ?>

			<a class="btn" href="<?php echo esc_url( $site_link ); ?>">
				<?php echo esc_html( $site_link_text ); ?>
			</a>

		<?php }
	}
}