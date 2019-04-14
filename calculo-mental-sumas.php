<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.bexandyrodriguez.com.ve
 * @since             1.0.0
 * @package           Calculo_Mental_Sumas
 *
 * @wordpress-plugin
 * Plugin Name:       Calculo Mental Sumas
 * Plugin URI:        https://github.com/developer-bexandy/calculo-mental-sumas
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Bexandy Rodriguez
 * Author URI:        https://www.bexandyrodriguez.com.ve
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       calculo-mental-sumas
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
define( 'CALCULO_MENTAL_SUMAS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-calculo-mental-sumas-activator.php
 */
function activate_calculo_mental_sumas() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-calculo-mental-sumas-activator.php';
	Calculo_Mental_Sumas_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-calculo-mental-sumas-deactivator.php
 */
function deactivate_calculo_mental_sumas() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-calculo-mental-sumas-deactivator.php';
	Calculo_Mental_Sumas_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_calculo_mental_sumas' );
register_deactivation_hook( __FILE__, 'deactivate_calculo_mental_sumas' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-calculo-mental-sumas.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_calculo_mental_sumas() {

	$plugin = new Calculo_Mental_Sumas();
	$plugin->run();

}
run_calculo_mental_sumas();
