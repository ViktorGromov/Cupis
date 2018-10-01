<?php
/*
 * @package    CharisChurchTheme
 * @subpackage ThemeCode
 * @author     ChapelWorks Church Theme Team <support@structurworks.com>
 * @copyright  Copyright (c) 2014, StructurWorks LLC
 * @link       http://chapelworks-church-themes.com
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
?>


			<footer class="footer" role="contentinfo">
				<div class="footer-main clearfix" role="main">
		
					<div class="footer-left-main first">
					
						<div class="footer-nav" >
							<?php charis_footer_links(); ?>
						</div>
						
					</div>
					<?php
					if ( function_exists('stwcbp_create_announcement_postype') ) { 
						//plugin is activated ?>
						<div class="footer-center-main">						
							<p class="footer-addr"> <?php _e( 'Join us at:  ', 'charistheme' );?></p>
							<div itemscope itemtype="http://schema.org/PostalAddress">						
								<span class="footer-addr-name" itemprop="name"><?php echo cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_name'); ?> / </span>
								<span class="footer-street-address" itemprop="street-address"><?php echo cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_addr_street'); ?> / </span>
								<span class="footer-locality" itemprop="addressLocality"><?php echo cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_addr_city'); ?></span> 
								<span class="footer-region" itemprop="addressRegion"><?php echo cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_addr_state'); ?></span>
								<span class="footer-postal-code" itemprop="postalCode"><?php echo cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_addr_zip'); ?></span><br><br>
								<span class="footer-postal-code" itemprop="Phone">Telephone: <?php echo cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_phone_number'); ?></span>						
							</div>
							
						</div>
					 <?php
					} ?>
					<div class="footer-right-main last">	
						
						<div class='footer-copyright'>
							<span class="source-org copyright ">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></span><br><br>
							<p> <?php _e('Theme design by ','charistheme')?> <a href="http://www.chapelworks-church-themes.com"><?php _e('ChapelWorks','charistheme')?></a></p>
						</div>
					</div>

				</div>

			</footer>

		</div>

		
		<?php wp_footer(); ?>

	</body>

</html>