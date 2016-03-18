<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package abc-sushi
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'abc-sushi' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'abc-sushi' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'abc-sushi' ), 'abc-sushi', '<a href="http://underscores.me/" rel="designer">Kariann Brown, Amrita Singh, Dewshan Sarathchndra</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->


<?php wp_footer(); ?>

<script type="text/javascript"> jQuery(document).ready(function($) {
$.backstretch("<?php echo get_stylesheet_directory_uri(); ?>/img/thimage.jpg");
});
</script>


</body>
</html>