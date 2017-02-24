<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package julian
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="row">
				<div class="columns small-12">
					<?php jul_social_media(); ?>
					<p><?php echo esc_html_e( 'Copyright', 'jul' ); ?> © <?php echo date( 'Y' ); ?>. <?php echo esc_html_e( 'All rights are reserved.', 'jul' ); ?></p>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
