<div class="ishare">
    
<div class="postbox">
    <div class="ishare-title">
        <h1><a href="//share.itraffic.su/"><img src="<?php echo(plugins_url('ishare/images/icon-20x20.png')); ?>" alt="iShare logo" title="iShare" /></a> <?php _e('iShare - settings','ishare')?></h1>
    </div>
</div>
    
<?php

if (isset($_POST[ISHARE_CODE])  && check_admin_referer( 'ishare-save' ) ) {

    $allowed_html = array(
            'div' => array(
                'class' => array()
                ),
            'script' => array(
                'type' => array(),
                'async' => array(),
                'charset' => array(),
                'src' => array(),
                ),
        );
    
    $allowed_protocols = array('http','https');
    
    $code = wp_kses($_POST[ISHARE_CODE], $allowed_html, $allowed_protocols);
    
    update_option(ISHARE_CODE, $code);

    //update_option(ISHARE_SHOW_ON_SINGLE, ($_POST[ISHARE_SHOW_ON_SINGLE] ? 'yes' : 'no'));
    update_option(ISHARE_SHOW_ON_PAGE, ($_POST[ISHARE_SHOW_ON_PAGE] ? 'yes' : 'no'));
    update_option(ISHARE_SHOW_ON_ARCHIVE, ($_POST[ISHARE_SHOW_ON_ARCHIVE] ? 'yes' : 'no'));
    update_option(ISHARE_SHOW_ON_MAIN, ($_POST[ISHARE_SHOW_ON_MAIN] ? 'yes' : 'no'));

    update_option(ISHARE_INSERT_MODE, ($_POST[ISHARE_INSERT_MODE] == 'auto' ? 'auto' : 'shortcode'));
    update_option(ISHARE_INSERT_POSITION, ( ($_POST[ISHARE_INSERT_POSITION] && in_array($_POST[ISHARE_INSERT_POSITION],array('top','bottom','both'))) ? $_POST[ISHARE_INSERT_POSITION] : 'bottom'));

?>
<div class="updated"><p><?php _e('Settings have been saved. Buttons social networks are displayed when viewing the post.','ishare')?></p></div>
<?php
}

?>
<div class="postbox">
    <div class="inside">
        <p>
            <a href="//share.itraffic.su/faq" target="_blank">FAQ</a> |
            <a href="//share.itraffic.su/news" target="_blank"><?php _e('News','ishare')?></a> |
            <a href="//share.itraffic.su/donate" target="_blank"><?php _e('Donate','ishare')?></a>
        </p>
    </div>
</div>


<div class="postbox">
	<?php echo ishare_get_widget(); ?>
</div>

<div class="postbox">
	<form action="<?php echo admin_url( "options-general.php?page=".ISHARE_PLUGIN_ID );?>" method="POST" id="ishare-form">
	
	    <p>
		<?php _e('Insert position','ishare') ?>: 
		<select id="<?php echo ISHARE_INSERT_POSITION ?>" name="<?php echo ISHARE_INSERT_POSITION ?>">
			<option value="bottom" <?php echo( (get_option(ISHARE_INSERT_POSITION) == "bottom" || !get_option(ISHARE_INSERT_POSITION)) ? 'selected="selected"' : '') ?>><?php _e('bottom','ishare') ?></option>
			<option value="top" <?php echo(get_option(ISHARE_INSERT_POSITION)== "top" ? 'selected="selected"' : '') ?>><?php _e('top','ishare') ?></option>
			<option value="both" <?php echo(get_option(ISHARE_INSERT_POSITION)== "both" ? 'selected="selected"' : '') ?>><?php _e('both','ishare') ?></option>
		</select>
	    </p>

	    <p>
		<?php _e('Insert mode','ishare') ?>: 
		<select id="<?php echo ISHARE_INSERT_MODE ?>" name="<?php echo ISHARE_INSERT_MODE ?>" onchange="change_insert_mode()">
			<option value="auto" <?php echo( (get_option(ISHARE_INSERT_MODE) == "auto" || !get_option(ISHARE_INSERT_MODE)) ? 'selected="selected"' : '') ?>><?php _e('auto mode','ishare') ?></option>
			<option value="shortcode" <?php echo(get_option(ISHARE_INSERT_MODE)== "shortcode" ? 'selected="selected"' : '') ?>><?php _e('via shortcode','ishare') ?></option>
		</select>
	    </p>

            <div id="ishare-auto-info" style="display:<?php echo( (get_option(ISHARE_INSERT_MODE) == "auto" || !get_option(ISHARE_INSERT_MODE)) ? 'block' : 'none') ?>">
		<div>
	             <label>
        	     <input type="checkbox" checked="checked" disabled="" name="<?php echo ISHARE_SHOW_ON_SINGLE ?>" /><?php _e('On single','ishare')?>
                     </label>
		</div>
		<div>
	             <label>
        	     <input type="checkbox" <?php echo(get_option(ISHARE_SHOW_ON_PAGE)== "yes" ? 'checked="checked"' : '') ?> name="<?php echo ISHARE_SHOW_ON_PAGE ?>" /><?php _e('On page','ishare')?>
                     </label>
		</div>
		<div>
	             <label>
        	     <input type="checkbox" <?php echo(get_option(ISHARE_SHOW_ON_ARCHIVE)== "yes" ? 'checked="checked"' : '') ?> name="<?php echo ISHARE_SHOW_ON_ARCHIVE ?>" /><?php _e('On archive (category pages, labels, authors and pages of archives by date)','ishare')?>
                     </label>
		</div>
		<div>
	             <label>
        	     <input type="checkbox" <?php echo(get_option(ISHARE_SHOW_ON_MAIN)== "yes" ? 'checked="checked"' : '') ?> name="<?php echo ISHARE_SHOW_ON_MAIN ?>" /><?php _e('On main','ishare')?>
                     </label>
		</div>
            </div>

	    <div id="ishare-shortcode-info" style="display:<?php echo(get_option(ISHARE_INSERT_MODE) == "shortcode" ? 'block' : 'none') ?>">
		<ul>
		<li><?php _e('To add shortcode in the .php file is a template design','ishare')?>: <div><strong>&lt;?php echo do_shortcode("[ishare_buttons]"); ?&gt;</strong></div></li>
		<li><?php _e('To insert in the visual editor','ishare')?>: <div><strong>[ishare_buttons]</strong></div></li>
		</ul>
	    </div>

            <p>
	        <input type="hidden" id="<?php echo(ISHARE_CODE) ?>" name="<?php echo(ISHARE_CODE) ?>" value="" />
                <input type="button" value="<?php _e('Save','ishare')?>" class="button-primary" onclick="getCode(); return false;" />
            </p>

            <?php wp_nonce_field( 'ishare-save' ); ?>

	    <p>
	    <?php _e('For all the proposals on the bugs','ishare')?> <a href="mailto:share@itraffic.su"><?php _e('write us','ishare')?></a> или <a href="//share.itraffic.su" target="_blank"><?php _e('leave comments','ishare')?></a>
	    </p>
        </form>                
</div>

<div class="postbox">
	<div class="inside">
	<p>
	<?php _e('Friends! The plugin is available for free, we constantly develop and improve it.','ishare'); ?>
	</p>
	<p>
	<a href="https://wordpress.org/support/view/plugin-reviews/ishare" target="_blank"><?php _e('Give us your feedback','ishare');?></a> -
	<?php _e(' - our project young and we really value your opinion!','ishare'); ?>
	</p>
	</div>
</div>

</div>