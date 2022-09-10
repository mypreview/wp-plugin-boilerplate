<?php
/**
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link          https://www.mahdiyazdani.com
 * @author        Mahdi Yazdani
 * @since         1.0.0
 *
 * @package       pluginname-customizer
 * @subpackage    pluginname-customizer/includes
 */

namespace PluginName_Customizer\Includes;

use const PluginName_Customizer\PLUGIN as PLUGIN;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'I18n' ) ) :

	/**
	 * Define the internationalization functionality.
	 */
	class I18n {

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @since     1.0.0
		 * @return    void
		 */
		public static function load_textdomain(): void {
			\load_plugin_textdomain( PLUGIN['slug'], false, dirname( PLUGIN['basename'] ) . '/languages/' );
		}
	}
endif;
