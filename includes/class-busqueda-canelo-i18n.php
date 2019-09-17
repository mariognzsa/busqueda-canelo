<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.lionintel.com
 * @since      1.0.0
 *
 * @package    Busqueda_Canelo
 * @subpackage Busqueda_Canelo/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Busqueda_Canelo
 * @subpackage Busqueda_Canelo/includes
 * @author     Lion Systems Solutions <soporte@lionintel.com>
 */
class Busqueda_Canelo_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'busqueda-canelo',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
