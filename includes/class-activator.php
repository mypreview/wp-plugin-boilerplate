<?php
/**
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @link          https://www.mahdiyazdani.com
 * @author        Mahdi Yazdani
 * @since         1.0.0
 *
 * @package       pluginname-customizer
 * @subpackage    pluginname-customizer/includes
 */

namespace PluginName_Customizer\Includes;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'Activator' ) ) :

	/**
	 * Fired during plugin activation.
	 */
	class Activator {

		/**
		 * Set the activation hook for a plugin.
		 *
		 * @since     1.0.0
		 * @return    void
		 */
		public static function run(): void {
			// Remove rewrite rules and then recreate rewrite rules.
			flush_rewrite_rules();
		}

	}
endif;
