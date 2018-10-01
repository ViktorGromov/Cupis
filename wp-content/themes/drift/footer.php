<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id="main-core".
 *
 * @package ThinkUpThemes
 */
?>

		</div><!-- #main-core -->
		</div><!-- #main -->
		<?php /* Sidebar */ drift_thinkup_sidebar_html(); ?>
	</div>
	</div><!-- #content -->

	<footer>
		<?php /* Custom Footer Layout */ drift_thinkup_input_footerlayout();
		echo	'<!-- #footer -->';  ?>
		
		<div id="sub-footer">

		<?php /* Custom Sub-Footer Layout */ drift_thinkup_input_subfooterlayout(); ?>

		<div id="sub-footer-core">

			<?php if ( has_nav_menu( 'sub_footer_menu' ) ) : ?>
			<?php wp_nav_menu( array( 'depth' => 1, 'container_class' => 'sub-footer-links', 'container_id' => 'footer-menu', 'theme_location' => 'sub_footer_menu' ) ); ?>
			<?php endif; ?>
			<!-- #footer-menu -->

			<?php if ( ! has_nav_menu( 'sub_footer_menu' ) ) : ?>
			<?php /* Social Media Icons */ drift_thinkup_input_socialmediafooter(); ?>
			<?php endif; ?>

			<div class="copyright">
			<?php /* === Add custom footer === */ drift_thinkup_input_copyright(); ?>
			</div>
			<!-- .copyright -->

		</div>
		</div>
	</footer><!-- footer -->

</div><!-- #body-core -->
</div><!-- #body-core-wrap -->

<?php wp_footer(); ?>

</body>
</html>