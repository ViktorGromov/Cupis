=== Charis Church Theme (Basic Edition) ===
Contributors: ChapelWorks Church Theme Team
Tags:  custom-background, custom-header, featured-images, flexible-header, fluid-layout, gray, blue, tan, white, responsive-layout, right-sidebar, left-sidebar, sticky-post, theme-options, translation-ready, two-columns, microformats
Requires at least: 4.1
Tested up to: 4.2.2
Stable tag: 1.0.9
License: GPLv2 or later
License URI:  http://www.gnu.org/licenses/gpl-2.0-standalone.html

Charis Church Theme for WordPress implements a custom Website Content Management System (CMS) for churches 
when used with the free plugins available here: http://chapelworks-church-themes.com/free-plugins/


== Description ==
Documentation and a live demo can be found at: http://chapelworks-church-themes.com

Two versions are available: a free edition and a premium edition. This free edition includes these features:
 - Church News
 - Pastor's Notes
 - Staff Descriptions / Contact information
 - Church Information / Worship Times

The premium edition is available at chapelworks-church-themes.com. It includes these additional features: 
  - Church Events 
  - Sermons
    - Audio
	- Video
	- PDF
	- Text
  - Sermon Series
  - On-line Giving Link
  - Social Media
  - Google Analytics Option
  - Additional Sidebars
  - Additional customization options
  - Enhanced support (with current license)

This theme incorporates the latest web technologies:
 - SASS/SCSS
 - CSS3
 - HTML5
  
See: http://chapelworks-church-themes.com

Copyright (c) StructurWorks LLC 2014  Some Rights Reserved.
== Installation ==
See: 
http://chapelworks-church-themes.com
http://codex.wordpress.org/Using_Themes
http://www.wpbeginner.com/beginners-guide/how-to-install-a-wordpress-theme/

== Frequently Asked Questions ==

= What is the difference between the level of support for the Free and Premium Editions =

Requests for new function will be addressed in the premium version. Updates to the code will be 
made in the premium version first and then migrated to the free version as time permits. 
It is strongly suggested that you run the premium version in production environments to have 
access to enhanced support as well as additional functions.

= How do I make a Child Theme? =

To create a child theme for this theme, follow these steps:

1 - Create a subfolder in the themes folder named charis-church-child

2 - Make a copy of styles.css from the charis-church folder in the charis-church-child folder

3 - In the header of the new styles.css file make these changes:

Change the line: 
Theme Name: Charis Church
to
Theme Name: Charis Church Child

Change the line:
Text Domain: charistheme
to
Text Domain: charistheme-child

Add a line: 
Template: charis-church

4 - create a folder called css in the charis-church-child folder

5 - copy all the files from the parent's css directory to the child's library/css

After you activate the child theme, you may need to update the menu locations in the appearance->menus admin panel

The theme supports multiple color schemes and associated stylesheets. A stylesheet for your customization is provided. 
Make your css changes to the library/css/custom_styles.css file. They will take effect when the 
custom color scheme is selected in the Appearance->Customization->Color Schemes admin panel. A .sccs file is also provide
if you would like to use a SASS Preprocessor.

Refer to http://codex.wordpress.org/Child_Themes for additional information on child themes

== Screenshots ==

screenshot.png

== Changelog ==

= 1.0.9 =
15 Jul 2015
Added additional page templates to support shortcodes in updated ChapelWorks plugin
- No Title-Narrow page template
- No Title-Wide page template
Added additional sidebar area to new template
Added link to updated documentation page in dashboard notification box
Added more information to theme description
Added plugin recommendation code


= 1.0.8 =
28 Apr 2015
Fixed compatibility issue with versions of PHP prior to 5.3 "unexpected T_FUNCTION" - function signatures passed as parameters not supported

= 1.0.7 =
Added a dismiss link to the admin panel notification

= 1.0.6 =
Translation and performance enhancements

= 1.0.5 = 
18 Mar 2015
Changes to stucture of the Blog files and hooked functions to match guidelines

= 1.0.4 =
02 Mar 2015
Changes to functions.php and related files to match guidelines 


= 1.0.3 =
05 Feb 2015
Change to custom header text color code
Device responsive formatting improvements
Moved CPT functions into plugins


= 1.0.2 =
21 Dec 2014
Added check for background image set in Custom Header support code

= 1.0.1 = 
12 Nov 2014
Minor change to ministry taxonomy display formatting

= 1.0.0 =
Initial release

== Upgrade Notice ==

= 1.0.0 =
Initial release

= 1.0.1 =
Minor change to ministry taxonomy

= 1.0.2 = 
Added check for background image set in Custom Header support code

== PackageID ==
charis-church0715151700
