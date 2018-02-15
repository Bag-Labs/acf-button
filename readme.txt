=== Advanced Custom Fields: Button Field ===
Contributors: circlecube, brownbagmarketing
Tags: acf, button, link, custom, custom post type, page, post, posts, pages, url
Requires at least: 4.5
Tested up to: 4.8
Stable tag: 1.7.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
GitHub Plugin URI: https://github.com/Bag-Labs/acf-button

Generates a button to an external url or an internal post type. Integrates with custom post types too. 

== Description ==

NOTE: **This is an extension for the popular [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) plugin. By itself, this plugin does NOTHING.** ENDNOTE

Generates a nice button/link to an external url or an internal post type, similar to the page_link field but allows you to override the link text and link to any post type or a custom url.

What makes this great is reducing multiple ACF rows into just one (see screenshots for a clear visual walkthrough). The internal link also uses a dropdown which is populated from all your post types so the button can link to a media file or a Custom Post Type, or of course to a page or post.

There are many advanced options as well. This will simply add classes to the button link which line up nicely with Zurb Foundation, but can easily be styled by any theme or developer to make these buttons shine. Options for color, size, style as well allowing the button to open in a new window and add custom classes on the fly.

NOTE: (*I know it was already mentioned, but just to be sure there's no confusion...*) **This is an extension for the popular [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) plugin. By itself, this plugin does NOTHING.** ENDNOTE

= Compatibility =

This ACF field type is compatible with:
 * ACF 5

= Roadmap =

* Add option to add bootstrap styles to buttons
* Add some button styles for users that don't have any and give an opt out of using button css
* Easily link to media library items for download

== Installation ==

1. Copy the `acf-button` folder into your `wp-content/plugins` folder
2. Activate the plugin via the plugins admin page
3. Create a new field via ACF and select the Button type
4. Please refer to the description for more info regarding the field type settings

== Changelog ==

= 1.7.1 =
* Fix bug that when loading a content link to a button in the admin the value didn't select and display the saved value.

= 1.7.0 =
* Add anchor value.
* Add rel attribute.
* Update PHP to WordPress Coding Standards.

= 1.6.3 =
* SVN woes.

= 1.6.1 =
* Include a missing asset files, since they were in the assets dir. Add thumbnail and banner assets.

= 1.6 =
* Combine all internal post types into one grouped select list.
* Fix collapse bug. Hides some fields when button is collapsed (in admin).
* Fix bug where selecting a different link type alters all buttons on page.
* Other minor issues.

= 1.5.1 =
* Fix bug - now not messing with the global post or loop on setting up the internal links select list.

= 1.5.0 =
* Update to display posts, pages & all custom post types in same select list segmented by post type.

= 1.4.0 =
* Further develop advanced settings and allow field group to fine tune the button field and default values and fields to display.

= 1.3.0 =
* Add custom settings for link type and custom post type support.

= 1.2.0 =
* Add custom settings for target, color and size.

= 1.1.0 =
* Add support for ACF 5. (and drop for ACF4)

= 1.0.0 =
* Initial Release.
