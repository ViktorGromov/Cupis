<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package blooster
 */
?>

	

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'blooster' ) ); ?>"></a>
			
			<?php printf( esc_html__( 'Wordpress Theme: %1$s by %2$s.', 'blooster' ), 'blooster', '<a href="http://logoholique.com/" rel="designer">Logoholique</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
