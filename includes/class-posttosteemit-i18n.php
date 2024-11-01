<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.bwpsteam.com
 * @since      1.0.0
 *
 * @package    Posttosteemit
 * @subpackage Posttosteemit/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Posttosteemit
 * @subpackage Posttosteemit/includes
 * @author     Vũ Vương Vĩ <vuvuongvi@gmail.com>
 */
class Posttosteemit_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'posttosteemit',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
