<?php
/*
 * @package    CharisChurchTheme
 * @subpackage ThemeCode
 * @author     Kevin Gibson <kevin@structurworks.com>
 * @copyright  Copyright (c) 2014, StructurWorks LLC
 * @link       http://chapelworks-church-themes.com
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
?>



<div  class="sidebar sidebar2 clearfix" role="complementary"> 

	<?php if ( is_active_sidebar( 'sidebar2' ) ) {?>

		<?php dynamic_sidebar( 'sidebar2' ); 
		
	}?>


</div>