<?php
/*
NOTE: this file requires WordPress 2.7+ to function
*/
$settings = 'mods_'.get_current_theme(); // do not change!

$defaults = array( // define our defaults
		'subscribe' => 'Yes',
		'feedburner_id' => 'themejunkie',
		'flickr' => 'Yes',
		'track' => 'Yes',
		'footer_widgets' => 'Yes',
		'showad468x60' => 'Yes',
		'showad300x250' => 'Yes'
		 // <-- no comma after the last option
);

//	push the defaults to the options database,
//	if options don't yet exist there.
add_option($settings, $defaults, '', 'yes');

/*
///////////////////////////////////////////////
This section hooks the proper functions
to the proper actions in WordPress
\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
*/
//	this function registers our settings in the db
add_action('admin_init', 'register_theme_settings');
function register_theme_settings() {
	global $settings;
	register_setting($settings, $settings);
}
//	this function adds the settings page to the Appearance tab
add_action('admin_menu', 'add_theme_options_menu');
function add_theme_options_menu() {
	add_submenu_page('themes.php', __('Настройки темы Channel', 'themejunkie'), __('Настройки темы Channel', 'themejunkie'), 8, 'theme-options', 'theme_settings_admin');
}

function theme_settings_admin() { ?>
<?php theme_options_css_js(); ?>

<div class="wrap">
  <?php
	global $settings, $defaults;
	if(get_theme_mod('reset')) {
		echo '<div class="updated fade" id="message"><p>'.__('Настройки темы', 'themejunkie').' <strong>'.__('Сброшены', 'themejunkie').'</strong></p></div>';
		update_option($settings, $defaults);
	} elseif($_REQUEST['updated'] == 'true') {
		echo '<div class="updated fade" id="message"><p>'.__('Настройки темы', 'themejunkie').' <strong>'.__('Сохранены', 'themejunkie').'</strong></p></div>';
	}
	screen_icon('options-general');
?>
  <h2><?php echo get_current_theme() . ' '; _e('Настройки темы', 'themejunkie'); ?></h2>
  <form method="post" action="options.php">
    <?php settings_fields($settings); // important! ?>
    <?php // begin first column ?>
    <div class="metabox-holder">
      <div class="postbox">
        <h3>
          <?php _e("Панель управления Theme Junkie", 'themejunkie'); ?>
        </h3>
        <div class="inside">
          <p>Тема Channel создана <a rel="nofollow" href="http://www.theme-junkie.com/"><?php _e("Theme Junkie", 'themejunkie'); ?></a>.</p>
          </p>
          <p style="border-top: 1px solid #ccc; padding-top: 10px;">
          <a href="http://www.theme-junkie.com/demo/channel/" target="_blank"><?php _e("Превью", 'themejunkie'); ?></a> // <a href="http://www.theme-junkie.com/download/channel.zip"><?php _e("Получить последнюю версию", 'themejunkie'); ?></a> // <a rel="nofollow" href="http://www.theme-junkie.com/contact/" target="_blank"><?php _e("Контакт", 'themejunkie'); ?></a>
        </div>
      </div>
      <div class="postbox">
        <h3>
          <?php _e("Flickr", 'themejunkie'); ?>
        </h3>
        <div class="inside">
          <p>
            <?php _e("Показывать фотки Flickr в боковом меню?", 'themejunkie'); ?>
            <br />
            <select name="<?php echo $settings; ?>[flickr]">
              <option style="padding-right:10px;" value="Yes" <?php selected('Yes', get_theme_mod('flickr')); ?>>Да</option>
              <option style="padding-right:10px;" value="No" <?php selected('No', get_theme_mod('flickr')); ?>>Нет</option>
            </select>
          </p>
        </div>
      </div>
      <div class="postbox">
        <h3>
          <?php _e("Виджеты в нижней части сайта", 'themejunkie'); ?>
        </h3>
        <div class="inside">
          <p>
            <?php _e("Показывать виджеты в нижней части сайта?", 'themejunkie'); ?>
            <br />
            <select name="<?php echo $settings; ?>[footer_widgets]">
              <option style="padding-right:10px;" value="Yes" <?php selected('Yes', get_theme_mod('footer_widgets')); ?>>Да</option>
              <option style="padding-right:10px;" value="No" <?php selected('No', get_theme_mod('footer_widgets')); ?>>Нет</option>
            </select>
          </p>
        </div>
      </div>
      <div class="postbox">
        <h3>
          <?php _e("Код Analytics", 'themejunkie'); ?>
        </h3>
        <div class="inside">
          <p>
            <?php _e("Включить код analytics или другого счетчика?", 'themejunkie'); ?>
            <br />
            <select name="<?php echo $settings; ?>[track]">
              <option style="padding-right:10px;" value="Yes" <?php selected('Yes', get_theme_mod('track')); ?>>Да</option>
              <option style="padding-right:10px;" value="No" <?php selected('No', get_theme_mod('track')); ?>>Нет</option>
            </select>
            <br />
            <?php _e("Введите код вашего счетчика", 'themejunkie'); ?>
            : <br />
            <textarea name="<?php echo $settings; ?>[track_code]" cols=35 rows=5><?php echo stripslashes(get_theme_mod('track_code')); ?></textarea>
          </p>
        </div>
      </div>
      <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Настройки сохранены', 'themejunkie') ?>" />
        <input type="submit" class="button-highlighted" name="<?php echo $settings; ?>[reset]" value="<?php _e('Настройки сброшены', 'themejunkie'); ?>" />
      </p>
    </div>
    <?php // end first column ?>
    <?php // begin second column ?>
    <div class="metabox-holder">
      <div class="postbox">
        <h3>
          <?php _e("Подписка", 'themejunkie'); ?>
        </h3>
        <div class="inside">
          <p>
            <?php _e("Показывать этот блок в шапке?", 'themejunkie'); ?>
            <br />
            <select name="<?php echo $settings; ?>[subscribe]">
              <option style="padding-right:10px;" value="Yes" <?php selected('Yes', get_theme_mod('subscribe')); ?>>Да</option>
              <option style="padding-right:10px;" value="No" <?php selected('No', get_theme_mod('subscribe')); ?>>Нет</option>
            </select>
            <br/>
            <?php _e("Ваш ID Feedburner", 'themejunkie'); ?>
            :<br />
            <input type="text" name="<?php echo $settings; ?>[feedburner_id]" value="<?php echo get_theme_mod('feedburner_id'); ?>" size="35" />
          </p>
        </div>
      </div>
      <div class="postbox">
        <h3>
          <?php _e("Баннер 468x60", 'themejunkie'); ?>
          -
          <?php _e("Шапка", 'themejunkie'); ?>
        </h3>
        <div class="inside">
          <p>
            <?php _e("Показывать этот блок в шапке?", 'themejunkie'); ?>
            <br />
            <select name="<?php echo $settings; ?>[showad468x60]">
              <option style="padding-right:10px;" value="Yes" <?php selected('Yes', get_theme_mod('showad468x60')); ?>>Да</option>
              <option style="padding-right:10px;" value="No" <?php selected('No', get_theme_mod('showad468x60')); ?>>Нет</option>
            </select>
          </p>
          <p>
            <?php _e("Введите свой код", 'themejunkie'); ?>
            :<br />
            <textarea name="<?php echo $settings; ?>[ad468x60]" cols=35 rows=5><?php echo stripslashes(get_theme_mod('ad468x60')); ?></textarea>
          </p>
        </div>
      </div>
      <div class="postbox">
        <h3>
          <?php _e("Баннер 300x250", 'themejunkie'); ?>
          -
          <?php _e("Боковое меню", 'themejunkie'); ?>
        </h3>
        <div class="inside">
          <p>
            <?php _e("Показывать этот блок в боковом меню?", 'themejunkie'); ?>
            <br />
            <select name="<?php echo $settings; ?>[showad300x250]">
              <option style="padding-right:10px;" value="Yes" <?php selected('Yes', get_theme_mod('showad300x250')); ?>>Да</option>
              <option style="padding-right:10px;" value="No" <?php selected('No', get_theme_mod('showad300x250')); ?>>Нет</option>
            </select>
          </p>
          <p>
            <?php _e("Введите свой код", 'themejunkie'); ?>
            :<br />
            <textarea name="<?php echo $settings; ?>[ad300x250]" cols=35 rows=5><?php echo stripslashes(get_theme_mod('ad300x250')); ?></textarea>
          </p>
        </div>
      </div>
    </div>
    <!--end second column-->
  </form>
</div>
<?php }

// add CSS and JS if necessary
function theme_options_css_js() {
echo <<<CSS

<style type="text/css">
	.metabox-holder { 
		width: 350px; float: left;
		margin: 0; padding: 0 10px 0 0;
	}
	.metabox-holder .postbox .inside {
		padding: 0 10px;
	}
	input, textarea, select {
		margin: 5px 0 5px 0;
		padding: 1px;
	}
</style>

CSS;
echo <<<JS

<script type="text/javascript">
jQuery(document).ready(function($) {
	$(".fade").fadeIn(1000).fadeTo(1000, 1).fadeOut(1000);
});
</script>

JS;
}
?>
