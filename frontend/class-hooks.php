<?php
/**
 * Hooks.
 *
 * @link          https://www.mahdiyazdani.com
 * @author        Mahdi Yazdani
 * @since         1.0.0
 *
 * @package       pluginname-customizer
 * @subpackage    pluginname-customizer/frontend
 */

namespace PluginName_Customizer\Frontend;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'Hooks' ) ) :

	/**
	 * The template hooks class.
	 */
	class Hooks {

		/**
		 * Register template specific hooks.
		 *
		 * @since     1.0.0
		 * @return    void
		 */
		public static function run(): void {}
	}
endif;
