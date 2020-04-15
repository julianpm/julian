<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package julian
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			echo '<div class="wrapper">';

				jul_about();
				?>

				<div class="row">
					<div class="columns small-12">
						<h1 class="no-margin-top"><?php echo esc_html_e( 'Portfolio', 'jul' ); ?></h1>
					</div>

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post(); ?>

						<div class="columns small-12 large-6">
							<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
						</div>

					<?php
					endwhile; ?>
				</div>

				<?php
				jul_contact();

			echo '</div>';

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
