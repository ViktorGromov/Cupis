<?php

include("settings.php");

# Sidebar
if (function_exists('register_sidebar'))
{
    register_sidebar(array(
		'name'			=> 'Full Width Widget',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="box">',
    ));

    register_sidebar(array(
		'name'			=> 'Left Widget',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="box">',
    ));

    register_sidebar(array(
		'name'			=> 'Right Widget',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="box">',
    ));
    register_sidebar(array(
		'name'			=> 'Footer Widget',
        'before_widget'	=> '',
        'after_widget'	=> '</div></div>',
        'before_title'	=> '<div class="left"><h3>',
        'after_title'	=> '</h3><div class="box">',
    ));
}

# Limit Post
function the_content_limit($max_char, $more_link_text = '', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo "";
      echo $content;
      echo "&nbsp;<a href='";
      the_permalink();
      echo "'>"."Читать полностью &rarr;</a>";
      echo "";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "";
        echo $content;
        echo "...";
        echo "&nbsp;<a href='";
        the_permalink();
        echo "'>"."</a>";
        echo "";
   }
   else {
      echo "";
      echo $content;
      echo "&nbsp;<a href='";
      the_permalink();
      echo "'>"."Читать полностью &rarr;</a>";
      echo "";
   }
}


# Displays post image attachment (sizes: thumbnail, medium, full)
function get_thumbnail($postid=0, $size='thumbnail', $attributes='') {
	if ($postid<1) $postid = get_the_ID();
	if ($images = get_children(array(
		'post_parent' => $postid,
		'post_type' => 'attachment',
		'numberposts' => 1,
		'post_mime_type' => 'image', )))
		foreach($images as $image) {
			$thumbnail=wp_get_attachment_image_src($image->ID, $size);
			?>

<img src="<?php echo $thumbnail[0]; ?>" <?php echo $attributes; ?> />
<?php
		}
	else {
		echo '<img src=' . get_bloginfo ( 'stylesheet_directory' );
		echo '/images/noimage.gif>';
	}

}

# Most Comment
function mdv_most_commented($no_posts = 5, $before = '<li>', $after = '</li>', $show_pass_post = false, $duration='') {
    global $wpdb;

	$mdv_most_commented = wp_cache_get('mdv_most_commented');
	if ($mdv_most_commented === false) {
		$request = "SELECT ID, post_title, comment_count FROM $wpdb->posts";
		$request .= " WHERE post_status = 'publish'";
		if (!$show_pass_post) $request .= " AND post_password =''";

		if ($duration !="") $request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";

		$request .= " ORDER BY comment_count DESC LIMIT $no_posts";
		$posts = $wpdb->get_results($request);

		if ($posts) {
			foreach ($posts as $post) {
				$post_title = htmlspecialchars($post->post_title);
				$comment_count = $post->comment_count;
				$permalink = get_permalink($post->ID);
				$mdv_most_commented .= $before . '<a href="' . $permalink . '" title="' . $post_title.'">' . $post_title . '</a>' . $after;
			}
		} else {
			$mdv_most_commented .= $before . "None found" . $after;
		}

		wp_cache_set('mdv_most_commented', $mdv_most_commented);
	}

    echo $mdv_most_commented;
}

# Retrieves the setting's value depending on 'key'.
function theme_settings($key) {
	global $settings;
	return $settings[$key];
}

?>