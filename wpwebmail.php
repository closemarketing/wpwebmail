<?php
/**
 * Plugin Name: WPWebmail
 * Plugin URI:  https://plugins.org/wpwebmail
 * Description: Integrates Webmail in WordPress Admin.
 * Version:     1.0
 * Author:      closemarketing
 * Author URI:  https://www.closemarketing.es
 * Text Domain: wpwebmail
 * Domain Path: /languages
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package     WordPress
 * @author      closemarketing
 * @copyright   2020 Closemarketing
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 *
 * Prefix:      wpw
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );


add_action( 'plugins_loaded', 'wpw_plugin_init' );
/**
 * Load localization files
 *
 * @return void
 */
function wpw_plugin_init() {
	load_plugin_textdomain( 'wpwebmail', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

// * Includes Libraries for WPWebmail
require_once dirname( __FILE__ ) . '/includes/class-wpwebmail.php';