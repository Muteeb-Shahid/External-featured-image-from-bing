<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       xaraar.com
 * @since      1.0.0
 *
 * @package    External_Featured_Image
 * @subpackage External_Featured_Image/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    External_Featured_Image
 * @subpackage External_Featured_Image/includes
 * @author     xaraartech <xaraartech@gmail.com>
 */
class External_Featured_Image_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'external-featured-image',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
