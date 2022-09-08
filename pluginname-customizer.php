<?php
/**
 * The plugin bootstrap file.
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * You can redistribute this plugin/software and/or modify it under
 * the terms of the GNU General Public License as published by the
 * Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * @link                 https://www.upwork.com/fl/mahdiyazdani
 * @author               Mahdi Yazdani <hi@mahdiyazdani.com>
 * @since                1.0.0
 * @package              pluginname-customizer
 *
 * @wordpress-plugin
 * Plugin Name:          Plugin Name - Customizer
 * Plugin URI:           https://www.pluginname.com
 * Description:          Describe the functionality or value that your plugin provides.
 * Version:              1.0.0
 * Requires at least:    6.0
 * Requires PHP:         7.4
 * Author:               Mahdi Yazdani
 * Author URI:           https://www.mahdiyazdani.com
 * License:              GPL-3.0+
 * License URI:          http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:          pluginname-customizer
 * Domain Path:          /languages
 */

namespace PluginName_Customizer;

use PluginName_Customizer\Includes\Core as Core;

define(
	__NAMESPACE__ . '\PLUGIN',
	array(
		'basename'   => plugin_basename( __FILE__ ),
		'dir_path'   => untrailingslashit( plugin_dir_path( __FILE__ ) ),
		'dir_url'    => untrailingslashit( plugin_dir_url( __FILE__ ) ),
		'slug'       => 'pluginname-customizer',
	)
);

/**
 * Loads the PSR-4 autoloader implementation.
 *
 * @since     1.0.0
 * @return    void
 */
require_once PLUGIN['dir_path'] . '/autoloader.php';

/**
 * The code that runs during plugin activation.
 *
 * @since     1.0.0
 * @return    void
 */
register_activation_hook( __FILE__, array( __NAMESPACE__ . '\Includes\Activator', 'run' ) );

/**
 * The code that runs during plugin deactivation.
 *
 * @since     1.0.0
 * @return    void
 */
register_activation_hook( __FILE__, array( __NAMESPACE__ . '\Includes\Deactivator', 'run' ) );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since     1.0.0
 * @return    void
 */
function run(): void {
	$plugin = new Core();
	$plugin->run();
}
run();

/**
 * Note: Do not add any custom code here!
 * Please use a custom plugin or child theme so that your customizations aren't lost during updates.
 */
