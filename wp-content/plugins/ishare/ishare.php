<?php
/**
 * @package iShare
 * @version 1.2.4
 */
/*
Plugin Name: iShare
Plugin URI: https://share.itraffic.su/plugins
Description: iShare - social share buttons plugin. Add Vkontakte, OK, Facebook, Twitter, Google+, etc share buttons.
Author: ishare
Version: 1.2.4
Author URI: https://share.itraffic.su/
Text Domain: ishare
*/

define( 'ISHARE_PLUGIN_ID', 'iShare' );
define( 'ISHARE_PLUGIN_NAME', 'iShare' );
define( 'ISHARE_CODE', 'ishare-code' );
define( 'ISHARE_INSERT_MODE', 'ishare-insert-mode' );
define( 'ISHARE_INSERT_POSITION', 'ishare-insert-position' );
define( 'ISHARE_SHOW_ON_SINGLE', 'ishare-show-on-single' );
define( 'ISHARE_SHOW_ON_PAGE', 'ishare-show-on-page' );
define( 'ISHARE_SHOW_ON_ARCHIVE', 'ishare-show-on-archive' );
define( 'ISHARE_SHOW_ON_MAIN', 'ishare-show-on-main' );

$ishare_shortcode_counter=0;

//Добавление пунка меню в Настройки
add_action('admin_menu','ishare_settings_menu');

function ishare_settings_menu() {
    add_options_page("Settings ".ISHARE_PLUGIN_NAME,
            ISHARE_PLUGIN_NAME,
            8,
            ISHARE_PLUGIN_ID,
            'ishare_render_settings_page');
}

function ishare_render_settings_page () {
    include 'settings.php';
}

// Для стат. блока кнопок
function ishare_render_static_buttons( $content ) {

    if( get_option(ISHARE_INSERT_MODE) == 'auto' || !get_option(ISHARE_INSERT_MODE) ) {

 	    if (ishare_is_fixed()) {return $content;} //ничего не добавляем

	    $add = false;

	    if( is_page() ) {
		if (get_option(ISHARE_SHOW_ON_PAGE) == "yes") {$add = true;}
	    }
	    elseif( is_archive() ) {
		if (get_option(ISHARE_SHOW_ON_ARCHIVE) == "yes") {$add = true;}
	    }
	    elseif( is_front_page() ) {
		if (get_option(ISHARE_SHOW_ON_MAIN) == "yes") {$add = true;}
	    }
	    else {$add = true;}

	    if ($add) {

		$title=get_the_title();
		$description = wp_trim_words( wp_strip_all_tags($content), 20, ' ...' );
		$id = get_the_ID();
    
		$position = get_option(ISHARE_INSERT_POSITION);

		$content = (($position == 'top' || $position == 'both') ? ishare_get_code($title,$description,$id,1) :'')
				.$content.
		           (($position == 'bottom' || $position == 'both' || !$position) ? ishare_get_code($title,$description,$id,2) :'');

		}
    }

    return $content;
}

add_filter( 'the_content', 'ishare_render_static_buttons', 200 );

// Для фикс. блока кнопок
function ishare_render_fixed_buttons() {

    if( get_option(ISHARE_INSERT_MODE) == 'auto' || !get_option(ISHARE_INSERT_MODE) ) {

 	if (ishare_is_fixed()) {

		$add = false;
		$title = '';
		$description = '';
		$id = 0;

		if( is_page() ) {
			if (get_option(ISHARE_SHOW_ON_PAGE) == "yes") {
				$add = true; 
				$title = get_the_title();
				$description = wp_trim_words( wp_strip_all_tags(get_the_excerpt()), 20, ' ...' );
				$id = get_the_ID();
			}
		}
		elseif( is_single() ) {
			$add = true; 
			$title = get_the_title(); 
			$description = wp_trim_words( wp_strip_all_tags(get_the_excerpt()), 20, ' ...' );
			$id = get_the_ID();
			}
		elseif( is_archive() ) {
			if (get_option(ISHARE_SHOW_ON_ARCHIVE) == "yes") {$add = true;}
		}
		elseif( is_front_page() ) {
			if (get_option(ISHARE_SHOW_ON_MAIN) == "yes") {$add = true;}
		}
		else {$add = true;}

		if ($add) {echo ishare_get_code($title,$description,$id);}
	}
    }
}

add_action('wp_footer', 'ishare_render_fixed_buttons');

//Добавление shortcode
function ishare_shortcode() {

    global $ishare_shortcode_counter;

    if( (get_option(ISHARE_INSERT_MODE) == 'shortcode') ) {


	$id=0;
	$title='';
	$description='';
	$counter=0;

	$ishare_shortcode_counter++;
	

	if( is_single() || is_page() ) {
		$title = get_the_title(); 
		$id = get_the_ID();
		$description = wp_trim_words( wp_strip_all_tags(get_the_excerpt()), 20, ' ...' );
	}

        return ishare_get_code($title,$description,$id,$ishare_shortcode_counter);
    };

}
add_shortcode( 'ishare_buttons', 'ishare_shortcode' );

//Загрузка переводов
add_action( 'plugins_loaded', 'ishare_textdomain' );

function ishare_textdomain() {
	load_plugin_textdomain( 'ishare', false, dirname(plugin_basename( __FILE__ )).'/languages' );
}

//Загрузка стилей
add_action('admin_enqueue_scripts', 'ishare_scripts_admin');
function ishare_scripts_admin($hook_suffix) {
    
    if ($hook_suffix != 'settings_page_iShare' && $hook_suffix != 'toplevel_page_iShare') {
        return;
    }
    
    wp_register_style( 'ishare_css', plugins_url('/css/ishare.css', __FILE__) );
    wp_enqueue_style( 'ishare_css' );

    wp_register_script( 'ishare_js', plugins_url('/js/ishare.js', __FILE__) );
    wp_enqueue_script( 'ishare_js' );
}

//Добавление пункта в основное меню
function ishare_admin_menu()
    {
    add_menu_page('iShare', ISHARE_PLUGIN_NAME, 'manage_options', ISHARE_PLUGIN_ID, 'ishare_render_settings_page', plugins_url('ishare/images/icon-20x20.png') );
    }
    
add_action( 'admin_menu', 'ishare_admin_menu' );


function ishare_no_xss_protection_header($current_screen)
   {
   if ($current_screen->base == 'settings_page_iShare' || $current_screen->base == 'toplevel_page_iShare') {
            header('X-XSS-Protection: 0');
        }
   }

add_action( 'current_screen', 'ishare_no_xss_protection_header' );


//Генерация кода
function ishare_get_code($title='',$description='',$id=0,$pos=0) {

	$ishare_code = htmlspecialchars_decode(stripslashes(get_option(ISHARE_CODE)));

	$url = get_permalink();
	if ( !$url || ishare_is_fixed() ) {
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = $protocol.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
	}

	$ishare_code = preg_replace('/<div/iu', '<div data-url="'.$url.'" ', $ishare_code);
		

	if ($id) {
		$ishare_code = preg_replace('/it-share-([0-9a-z]{32})/iu', 'it-share-$1'.($id ? '-'.$id : '').($pos ? '_'.$pos:''), $ishare_code);
		$ishare_code = preg_replace('/key=([0-9a-z]{32})\">/iu', 'key=$1'.($id ? '-'.$id : '').($pos ? '_'.$pos:'').'">', $ishare_code);
	}

	if ($title) {
		$ishare_code = preg_replace('/<div/iu', '<div data-title="'.htmlspecialchars($title).'" ', $ishare_code);
	}
	if ($description) {
		$ishare_code = preg_replace('/<div/iu', '<div data-description="'.htmlspecialchars($description).'" ', $ishare_code);
	}

	return $ishare_code;
    
}

//Проверяет фикс. полож или нет
function ishare_is_fixed() {

	$ishare_code = htmlspecialchars_decode(stripslashes(get_option(ISHARE_CODE)));

 	return strpos($ishare_code,"fixed") === false ? false : true;
}

function ishare_get_widget() {

$ishare_code = ishare_get_code();

$start = strpos($ishare_code,'?buttons=');
$end = strpos($ishare_code,'key=');

if ($start && $end) {$preset = substr($ishare_code,$start+1,$end-$start-2);}

return '<iframe src="//share.itraffic.su/index.php?plugin=wp&lang='.substr(get_bloginfo('language'),0,2).'&'.$preset.'" width="100%" height="600px" id="ishare-frame">Your browser does not support iframes!</iframe>';
}