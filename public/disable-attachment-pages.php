<?php
/**
 * Plugin Name:       Disable Attachment Pages
 * Plugin URI:        https://wordpress.org/plugins/disable-attachment-pages/
 * Description:       Redirects attachment pages to the post, where they are placed, and hides backend option to link images to attachment page (if not default).
 * Version:           1.1.1
 * Requires at least: 4.0
 * Tested up to:      7.1.2
 * Requires PHP:      7.0
 * Author:            Palasthotel <webmaster@palasthotel.de>
 * Author URI:        https://palasthotel.de
 * License:           GPL-3.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 */

defined( 'ABSPATH' ) || exit;

add_action( 'template_redirect', 'disable_attachment_pages_redirect_attachments', 1 );

/**
 * Send visitors of an attachment page to the content the file belongs to.
 */
function disable_attachment_pages_redirect_attachments() {
	if ( ! is_attachment() ) {
		return;
	}

	$attachment = get_queried_object();
	$parent_id  = $attachment instanceof WP_Post ? (int) $attachment->post_parent : 0;

	if ( $parent_id > 0 ) {
		$parent = get_post( $parent_id );

		// Only follow a parent a visitor can actually reach. Redirecting to a
		// draft, pending or trashed parent would just land on a 404.
		if ( $parent instanceof WP_Post && 'publish' === get_post_status( $parent ) ) {
			$permalink = get_permalink( $parent );

			if ( $permalink ) {
				// Permanent redirect to post/page, where the image or document was placed.
				wp_safe_redirect( $permalink, 301 );
				exit;
			}
		}
	}

	// Temporary redirect to WordPress home URL for images or documents not associated to any post/page.
	wp_safe_redirect( home_url( '/' ), 302 );
	exit;
}

add_action( 'admin_head', 'disable_attachment_pages_disable_linkto' );

/**
 * Hide the 'attachment page' option for the link-to part when editing or
 * inserting images.
 *
 * Printed on every admin screen on purpose: the media modal that carries the
 * option can be opened from anywhere in the backend.
 */
function disable_attachment_pages_disable_linkto() {
	echo <<<EOT
<style>
.setting select.link-to option[value="post"],
.setting select[data-setting="link"] option[value="post"],
.components-select-control__input option[value="attachment"] {
	display: none;
}
</style>
EOT;
}
