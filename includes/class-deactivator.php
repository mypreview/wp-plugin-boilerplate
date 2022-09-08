<?php
/**
 * This class defines all code necessary to run during the plugin's deactivation.
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

if ( ! class_exists( 'Deactivator' ) ) :

	/**
	 * Fired during plugin deactivation.
	 */
	class Deactivator {

		/**
		 * Set the deactivation hook for the plugin.
		 *
		 * @since    1.0.0
		 * @return   void
		 */
		public static function run(): void {}

	}
endif;
