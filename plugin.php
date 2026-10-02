<?php
/**
 * Plugin Name: Disable Attachment Pages - DEV
 * Description: Development wrapper, loads public/disable-attachment-pages.php. Never deployed.
 * Version: X.X.X
 * Author: Palasthotel <webmaster@palasthotel.de>
 * Author URI: https://palasthotel.de
 * License: GPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/public/disable-attachment-pages.php';
