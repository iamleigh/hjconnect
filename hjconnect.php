<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              iamleigh.com
 * @since             1.0.0
 * @package           Hjconnect
 *
 * @wordpress-plugin
 * Plugin Name:       Hotjar Connection
 * Plugin URI:        https://github.com/iamleigh/hjconnect
 * Description:       Connect your WordPress site with Hotjar fast and easy in matter of seconds.
 * Version:           1.0.0
 * Author:            Leighton Sapir
 * Author URI:        iamleigh.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hjconnect
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hjconnect-activator.php
 */
function activate_hjconnect() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hjconnect-activator.php';
	Hjconnect_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hjconnect-deactivator.php
 */
function deactivate_hjconnect() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hjconnect-deactivator.php';
	Hjconnect_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hjconnect' );
register_deactivation_hook( __FILE__, 'deactivate_hjconnect' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-hjconnect.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hjconnect() {

	$plugin = new Hjconnect();
	$plugin->run();

}
run_hjconnect();
