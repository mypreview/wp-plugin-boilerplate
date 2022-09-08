<?php
/**
 * The admin-facing functionality of the plugin.
 *
 * @link          https://www.mahdiyazdani.com
 * @author        Mahdi Yazdani
 * @since         1.0.0
 *
 * @package       pluginname-customizer
 * @subpackage    pluginname-customizer/dashboard
 */

namespace PluginName_Customizer\Dashboard;

use PluginName_Customizer\Includes\Utils as Utils;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'Core' ) ) :

	/**
	 * The main admin-facing class.
	 */
	class Core {

		/**
		 * Initialize the class and set its properties.
		 *
		 * @since     1.0.0
		 * @return    void
		 */
		public function __construct() {}

		/**
		 * Extend REST-API endpoint and routes.
		 *
		 * @since     1.0.0
		 * @return    void
		 */
		public function rest_api(): void {}

		/**
		 * Registers block types from metadata stored in the `block.json` files.
		 *
		 * @since     1.0.0
		 * @return    void
		 */
		public function register_blocks(): void {
			$dir_path  = untrailingslashit( plugin_dir_path( __DIR__ ) );
			$manifests = glob( $dir_path . '/build/editor/*/*.json' );

			foreach ( $manifests as $fully_qualified_path ) {
				$args = array();

				if ( is_readable( $fully_qualified_path ) ) {
					$metadata = wp_json_file_decode( $fully_qualified_path, array( 'associative' => true ) );

					if ( isset( $metadata['category'] ) && 'widgets' === $metadata['category'] ?? '' ) {
						$args['render_callback'] = 'PluginName_Customizer\Frontend\Core::render_' . Utils::underlinify( basename( $metadata['name'] ) );
					}

					// Registers a block type from the metadata file.
					register_block_type_from_metadata( $fully_qualified_path, $args );
				}
			}
		}

		/**
		 * Register the static resources for the Gutenberg editor area.
		 *
		 * @since     1.0.0
		 * @return    void
		 */
		public function editor_enqueue(): void {
			// Enqueue editor specific static resources.
			Utils::enqueue_resources( 'editor' );

			do_action( 'pluginname_customizer_enqueue_editor' );
		}

	}
endif;
