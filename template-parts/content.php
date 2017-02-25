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
	<?php
		
		if ( has_post_thumbnail() ){
			the_post_thumbnail();
		}

		the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="entry-title"><h2 class="no-margin">', '</h2></a>' );
	
	?>
</article><!-- #post-## -->