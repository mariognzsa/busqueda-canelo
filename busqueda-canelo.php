<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.lionintel.com
 * @since             1.0.0
 * @package           Busqueda_Canelo
 *
 * @wordpress-plugin
 * Plugin Name:       LS-Busqueda
 * Plugin URI:        www.ls-busqueda.com
 * Description:       Conexion y busqueda personalizada en la base de datos elcanelo
 * Version:           1.0.0
 * Author:            Lion Systems Solutions
 * Author URI:        www.lionintel.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       busqueda-canelo
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BUSQUEDA_CANELO_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-busqueda-canelo-activator.php
 */
function activate_busqueda_canelo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-busqueda-canelo-activator.php';
	Busqueda_Canelo_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-busqueda-canelo-deactivator.php
 */
function deactivate_busqueda_canelo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-busqueda-canelo-deactivator.php';
	Busqueda_Canelo_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_busqueda_canelo' );
register_deactivation_hook( __FILE__, 'deactivate_busqueda_canelo' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-busqueda-canelo.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_busqueda_canelo() {

	$plugin = new Busqueda_Canelo();
	$plugin->run();

}
run_busqueda_canelo();
