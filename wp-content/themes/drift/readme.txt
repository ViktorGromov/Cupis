== Think Up Themes ==

- By Think Up Themes, http://www.thinkupthemes.com/

Requires at least:	4.0.0
Tested up to:		4.7.2

Drift is the free version of the multi-purpose professional theme (Drift Pro) ideal for a business or blog website. The theme has a responsive layout, HD retina ready and comes with a powerful theme options panel with can be used to make awesome changes without touching any code. The theme also comes with a full width easy to use slider. Easily add a logo to your site and create a beautiful homepage using the built-in homepage layout.

-----------------------------------------------------------------------------
	Support
-----------------------------------------------------------------------------

- For support for Drift (free) please post a support ticket over at the https://wordpress.org/support/theme/drift.

-----------------------------------------------------------------------------
	Frequently Asked Questions
-----------------------------------------------------------------------------

- None Yet


-----------------------------------------------------------------------------
	Limitations
-----------------------------------------------------------------------------

- Sub-menus in the Primary Header Menu should have a maximum depth of 4 to ensure content does not overflow viewport. The depth will be less if sub-menu pages have long names.


-----------------------------------------------------------------------------
	Copyright, Sources, Credits & Licenses
-----------------------------------------------------------------------------

Drift WordPress Theme, Copyright 2017 Think Up Themes Ltd
Drift is distributed under the terms of the GNU GPL

The following opensource projects, graphics, fonts, API's or other files as listed have been used in developing this theme. Thanks to the author for the creative work they made. All creative works are licensed as being GPL or GPL compatible.

    [1.01] Item:        Underscores (_s) starter theme - Copyright: Automattic, automattic.com
           Item URL:    http://underscores.me/
           Licence:     GPLv2 or later
           Licence URL: http://www.gnu.org/licenses/gpl.html

    [1.02] Item:        TRT Customizer Pro
           Item URL:    https://github.com/justintadlock/trt-customizer-pro
           Licence:     GPLv2 or later
           Licence URL: http://www.gnu.org/licenses/gpl.html

    [1.03] Item:        PrettyPhoto
           Item URL:    http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
           Licence:     GPLv2
           Licence URL: http://www.gnu.org/licenses/gpl-2.0.html

    [1.04] Item:        ResponsiveSlides
           Item URL:    https://github.com/viljamis/ResponsiveSlides.js
           Licence:     MIT
           Licence URL: http://opensource.org/licenses/mit-license.html

    [1.05] Item:        ScrollUp
           Item URL:    https://github.com/markgoodyear/scrollup
           Licence:     MIT
           Licence URL: http://opensource.org/licenses/mit-license.html

    [1.06] Item:        Modernizr
           Item URL:    https://github.com/Modernizr/Modernizr
           Licence:     MIT
           Licence URL: http://opensource.org/licenses/mit-license.html

    [1.07] Item:        Font Awesome
           Item URL:    http://fortawesome.github.io/Font-Awesome/#license
           Licence:     SIL Open Font &  MIT
           Licence OFL: http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL
           Licence MIT: http://opensource.org/licenses/mit-license.html

    [1.08] Item:        Twitter Bootstrap (including images)
           Item URL:    https://github.com/twitter/bootstrap/wiki/License
           Licence:     Apache 2.0
           Licence URL: http://www.apache.org/licenses/LICENSE-2.0

    [1.09] Item:        transparent.png, slide_demo1.png, slide_demo2.png, slide_demo3.png, screenshot.png
           Item URL:    /images
           Licence:     CC0
           Licence URL: These items have been produced specifically for Drift and are owned by Think Up Themes. Released under CC0.

    [1.10] Item:        Various images for use in theme options.
           Item URL:    /admin/main/assets/img & /admin/main/inc/controls/upgrade
           Licence:     CC0
           Licence URL: These items have been produced by Think Up Themes. Released under CC0.

    [1.11] Item:        image shown in mobile device on screenshot.png.
           Item URL:    https://unsplash.com/photos/p-rN-n6Miag
           Licence:     CC0
           Licence URL: https://creativecommons.org/publicdomain/zero/1.0/

    [1.12] Item:        image shown in background.
           Item URL:    https://unsplash.com/photos/3MNzGlQM7qs
           Licence:     CC0
           Licence URL: https://creativecommons.org/publicdomain/zero/1.0/

-----------------------------------------------------------------------------
	Changelog
-----------------------------------------------------------------------------

Version 1.1.1
- New:     Documentation link added to customizer.
- New:     Theme information page added under Appearance in admin area.
- Updated: Customizer upgrade section changed to button_link section.

Version 1.1.0
-  New:    Page slider migrated to be easy to use image slider.

Version 1.0.7
- Updated: "test" classes from thinkup-customizer.js.
- Updated: All instances of "..." changed to "&hellip;".
- Updated: echo removed from get_search_form() in 404.php.
- Updated: Escaping removed from header_image() in header.php.
- Updated: Image names output to user end are now translation ready.
- Updated: echo removed from drift_thinkup_input_stylelayout() in archive.php.
- Updated: wp_link_pages() added following the_content() in content-single.php.
- Updated: readme file updated to include image url of the background image used in screenshot.png.
- Updated: drift_thinkup_customizer_select_array_sidebar() now checks for footer sidebars by id instead of name.
- Removed: "featured-image-header" tag removed from style.css.

Version 1.0.6
- Updated: Anchors for stylesheets / scripts changed to "drift-thinkup-" from "thinkup-".

Version 1.0.5
- Fixed:   Non translatable strings now translation ready.
- Fixed:   "excerpt_more" filter updated in line with default WordPress 2017 theme.
- Updated: Custom header now supports "flex-height" feature.
- Updated: Anchor for "scrollup" changed to "jquery-scrollup".
- Updated: wp_link_pages() added following the_content() in content.php and content-page.php.
- Updated: Prefix changed from "thinkup_" to "drift_thinkup_" where required. (e.g. functions, classes, globals, image sizes, etc...)
- Removed: "editor-style" tag removed from style.css.
- Removed: Function thinkup_check_ishome() no longer required, as related issue is now fixed in core.

Version 1.0.4
- Updated: Slight adjustment to screenshot.
- Updated: Upgrade information changed to reflect latest price.

Version 1.0.3
- Updated: Various updated to improve escaping and translation.
- Updated: Slider title and description escaped using wp_kses_post().
- Updated: Translations wrappers removed from non-translatable strings.
- Updated: style-shortcodes.css updated to be consistent with all themes.
- Updated: All instances of HTML "..." changed to use ascii code "&#8230;".
- Updated: Function thinkup_var_cookie() removed as it's not used in the theme.
- Updated: Function thinkup_check_ishome() improved to use native wp_unslash() function.
- Updated: Argument for custom-header filter changed from $args to $thinkup_header_args.
- Updated: Post media class now output if "full content" option is selected in post section of themes.
- Updated: All references to ".rslides1_on" changed to ".rslides > [class*="_on"]" to improve slider styling.
- Updated: Function thinkup_frontscripts() updated to better organise scripts / stylesheets used in the theme.

Version 1.0.2
- Updated: Font Awesome updated to v4.7.0.
- Updated: Custom css option removed as it's a core option in WP v4.7.
- Updated: Theme renamed from Consulting to Drift. Consulting never publicly released.

Version 1.0.1
- Updated: Fully compatible with WordPress v4.7.

Version 1.0.0
- Initial release.