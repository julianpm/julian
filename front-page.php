<?php
/**
 * The template for displaying front page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package julian
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post(); ?>

				<div class="row">
					<div class="columns small-12">
						<h1>;lkjasdf;</h1>
					</div>
				</div>
				
			<?php
			endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
