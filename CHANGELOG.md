# Slate Changelog

- 5.0.0 [2016-10-04]
  - Forked Slate from Array (https://arraythemes.com/)
  - Removed 'Getting Started' nag
  - Refactored 'Getting Started' page

4.2.7 - 9/5/15

    Updated widgets due to WordPress 4.3. changes.

4.2.6 - 6/15/15

    Added fix for responsive videos in the post content.

4.2.5 - 4/22/15

    Updated Font Awesome to the latest version.
    Fixed an issue where the homepage customizer settings didn't work properly under certain conditions.

4.2.4 - 3/9/15

    Updated for the latest Array Toolkit.

4.2.3 - 3/6/15

    Fixed next/previous post translation strings.

4.2.2 - 1/27/15

    Fixed an issue with a missing HTML tag in the author archives.

4.2.1 - 6/03/14

    Changes to the Latest Updates screen.
    Removed changelog.txt and moved change log information to readme.txt
    Minor housekeeping.
    Modified - style.css, readme.txt, inc/admin/getting-started/getting-started.php, inc/admin/getting-started/getting-started.css

4.2 - 4/18/14

    Added portfolio category template back in.
    Added fix for the theme name display in child themes.

4.1 - 4/1/14

    Fixed bug in customizer preview.

4.0 - 3/29/14

    Prepared for Array
    Massive cleanup of all files
    Added Getting Started page
    Note: If your sidebar or footer widgets disappear, you simply need to go into Appearance -> Widgets and drag them back into the appropriate widget area.
    Modified - Please update your entire theme.

3.6 - 12/25/13

    Updated FontAwesome icons to match the new icon naming. You can now use the new icons from the FontAwesome page. (fa-check, fa-heart, etc.)
    Modified - style.css, header.php, includes/updates/EDD_SL_Setup.php, includes/widgets/recent-widgets.php, includes/js/custom/custom.js, includes/fonts/font-awesome

3.5 - 10/20/13

    Note: You will either have to download and upload this update manually from ThemeForest, or to get this in-dash update you need to rename your theme folder to 'slate' instead of 'Slate-UploadToWP' in your wp-content/themes folder. Once you rename the folder, you may have to reactivate Slate. This is normal and should not interfere with your site or it's content. You should also be able to grab the update from within you dashboard.
    Fixed homepage slider which was broken in last update. You can now add slides as per usual.
    Modified - style.css, homepage.php, includes/updates/EDD_SL_Setup.php

3.4 – 10/10/13

    Added in-dash theme update support. You will now be able to quickly and seamlessly update your themes from within your dashboard. Visit Appearance -> Themes to check for an update. If there is one, you'll see a notice at the top of the screen.
    Reformatted functions.php to be more standards compliant.
    Cleaned up each file, fixing spacing, formatting, etc.

3.3 - 8/3/13

    Added fix for hidden header toggle. Plus and minus now displays properly. Files update: header.php, style.css, custom.js

3.2 - 5/8/13

    Replaced the homepage portfolio slider. The theme now has a Slider Item post type, which you can use to create slider items with images and custom links. See the help file for step by step instructions on how to create a slider. Affected files: functions.php, homepage.php, added includes/metabox/ directory.
    Requires Okay Toolkit v1.8 update! Available in your WordPress dashboard or at the plugin site (http://wordpress.org/extend/plugins/okay-toolkit/).

3.1 - 4/10/13

    Added localization to customizer.php.
    Updated Contact Form 7 styles.
    Added theme-wide form styling.

3.0 - 3/9/13

    Recoded entire theme to sit on the new Okay Themes framework.
    Removed Options Framework plugin in favor of the WordPress Theme Customizer. Settings are now handled in Appearance → Customize.
    Separated posts and portfolio items. Portfolio items now use a custom post type, which is provided by the Okay Toolkit Plugin.
    Added support for new, awesome galleries. Use the new WordPress 3.5 media manager to create galleries, rearrange them, and display them in your portfolio items.
    Reworked the responsive media queries to accomodate more devices. The theme is now 100% flexible, versus the fixed breakpoints it was using before.
    Twitter widget and social media icons have been moved to the Okay Toolkit plugin. Toolkit also provides several other widgets.
    Removed shortcode functionality from the theme and moved them into a plugin. If you are updating from 2.3 and want to keep your shortcodes, you'll have to install the shortcode plugin located here: http://cl.ly/NT2N. Tons of little changes here and there. Check out the demo to see the theme in action, and be sure to check out the install video and instructions (http://array.is/articles/slate/) which will walk you through setting up Slate v3.0.
    Slate v3.0 Upgrade Notice: Slate was recoded from the ground up to fit the current framework of Okay Themes. Several major changes in the architecture, features and settings have taken place in this update. Because of this, if you are upgrading from version 2.3, you will have to set up the theme again, as if it were a new theme. While this is kind of a bummer, the upside is you get this huge and awesome update for free. Slate 3.0 has really slick galleries, a better responsive layout, more white space, more attention to detail, and it's much easier to setup and maintain. See the install video and instructions (http://array.is/articles/slate/) to get your theme updated and setup on Slate 3.0.
    A Note About Shortcodes: The shortcodes that came with Slate originally have been removed in version 3.0. This was for several reasons, but mostly because they are more trouble than they're worth. However, if you absolutely must have the shortcodes from your last install, I have transferred them into a plugin, which you can download here (http://cl.ly/NT2N). They will not be supported going forward, but feel free to use the plugin.

2.3 - 12/19/12

    Important Change: Removed slider functionality on homepage portfolio thumbs, homepage blog posts, and portfolio page thumbs. Sliders are flashy, but not entirely user friendly, particularly on touch devices and mobile. This is a fairly big change, so if you don't want to lose the slider functionality on your current version of Slate (v 2.2 or before), do not update your theme. Please be aware that this means that you will not be able to update going forward. We don't like removing features once implemented, but these particular features became more of an inconvenience than a benefit.
    Modified styles based on slider changes.
    Fixed shortcode column widths and naming conventions. Column widths are now percentage based, rather than fixed widths at breakpoints.
    Modified media-queries.css to reflect slider and column changes.
    Fixed auto-height bug in Flexslider.

2.2 - 11/24/12

    Fixed bug that prevented scrolling on iPhone.

2.1 - 11/14/12

    Added wp_reset_postdata to tabbed widget to reset post query.
    Added class and ID identifiers to widget registration.
    Added option to autoplay sliders.

2.0 - 10/25/12

    Added a fix for popular posts widget to only show published posts.

1.9 - 9/11/12

    Added a fix for the shortcode button breaking the editor.

1.8 - 8/17/12

    Changed social links to open in a new window.

1.7 - 8/16/12

    Many CSS modifications including font-size adjustments (mostly making fonts bigger), fine tuning colors, more whitespace, etc.
    Changed localization textdomain from 'slate' to 'okay' as with the rest of the Okay themes.
    Fine tuned media queries.
    Regenerated .mo and .po files.
    Fixed scrolling bug for iPad sidebar.
    Removed update notifier in lieu of an upcoming solution.

1.6 - 5/10/12

    Fixed a bug in media-queries.css.
    (Beta) Added a theme update notifier. When the theme is updated, you will receive a small notification in your dashboard menu, which will tell you what exactly has changed and how to update the theme.

1.5 - 4/19/12

    Fixed a bug with localization.

1.4 - 4/12/12

    Added template tag to home.php
    Updated fitvid.js which was causing an odd caching issue when browsing back and forth between pages.

1.3 - 4/7/12

    Added Support tab to theme options. Provides direct links to install video, help file, forum and customizations request.
    Changed the Google Analytics theme option to allow any kind of tracking code. Users updating will have to grab the full tracking code from Google now, versus just the UA code.

1.2 - 3/24/12

    Added descriptive classes to sections on homepage to allow for easier customization.

1.1 - 3/22/12

    Added new Twitter widget to alleviate issues some users were having
    Reorganized code functions.php
    Added descriptive prefixes to theme functions
    Moved javascript calls to external file. Now located in includes/js/custom.js
    Now using WordPress's default wp_enqueue_script('jquery'); to load the latest version of jQuery.

1.0 - 3/22/12

    Initial release.

