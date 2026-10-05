=== Disable Attachment Pages ===
Contributors: palasthotel, greatestview, janaeggebrecht
Donate link: https://palasthotel.de/
Tags: redirect, attachments, attachment, images, seo
Requires at least: 4.0
Tested up to: 7.1
Requires PHP: 7.0
Stable tag: 1.1.1
License: GPL-3.0-or-later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Redirects attachment pages to the post, where they are placed, and hides backend option to link images to attachment page (if not default).

== Description ==
This plugin redirects attachment pages to the post, where they are placed (via 301). If there is no parent page, it redirects back to the WordPress home URL (via 302).

Further, when editing a post, the option to link images to their attachment page is hidden via CSS (except it is selected by default).

== Installation ==
1. Upload `disable-attachment-pages.zip` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. You’re done! Try following an attachment link, the browser should redirect back to the post, where this link is placed.

== Frequently Asked Questions ==

= WordPress 6.4 disables attachment pages itself. Do I still need this plugin? =
Since WordPress 6.4, new sites have attachment pages switched off (option `wp_attachment_pages_enabled`), and their URLs redirect to the media file itself. Sites that existed before keep their attachment pages. This plugin redirects to the post or page the file belongs to instead, on old and new sites alike, and hides the option to link images to their attachment page. If a redirect to the file is what you want, you do not need it.

== Changelog ==

= 1.1.1 =
**Bug Fixes**
* only redirect to a parent a visitor can actually reach (213b013)

= 1.1 =
* Added Gutenberg support.

= 1.0 =
* First release
