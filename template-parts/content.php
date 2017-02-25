<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package julian
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ){
		the_post_thumbnail();
	} ?>
	<?php
	if ( is_single() ) :
		the_title( '<h1 class="entry-title">', '</h1>' );
	else :
		the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="entry-title"><h2>', '</h2></a>' );
	endif; ?>
</article><!-- #post-## -->