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
	<div class="row">
		<div class="columns small-12">
			<?php
				if ( has_post_thumbnail() ){
					the_post_thumbnail();
				}
			?>
		</div>
	</div>
	<div class="single-post-content section-padding">
		<div class="row">
			<div class="columns small-12">
				<?php the_title( '<h1 class="entry-title no-margin-top">', '</h1>' ); ?>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<?php jul_post_navigation(); ?>
</article><!-- #post-## -->