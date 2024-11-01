<?php


/**
 *
 * @link              www.preventdirectaccess.com
 * @since             1.0.2
 * @package           Posttosteemit
 *
 * @wordpress-plugin
 * Plugin Name:       WP to Steemit
 * Plugin URI:        https://preventdirectaccess.com/
 * Description:       Sync Wordpress posts or pages to steemit
 * Version:           1.0.3
 * Author:            Nina1204
 * Author URI:        https://preventdirectaccess.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-to-steemit
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.3' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-posttosteemit-activator.php
 */
function activate_posttosteemit() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-posttosteemit-activator.php';
	Posttosteemit_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-posttosteemit-deactivator.php
 */
function deactivate_posttosteemit() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-posttosteemit-deactivator.php';
	Posttosteemit_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_posttosteemit' );
register_deactivation_hook( __FILE__, 'deactivate_posttosteemit' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-posttosteemit.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_posttosteemit() {

	$plugin = new Posttosteemit();
	$plugin->run();

}

if (! defined('ABSPATH') ) {
	exit;
}

run_posttosteemit();
