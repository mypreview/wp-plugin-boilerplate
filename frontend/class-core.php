<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link          https://www.mahdiyazdani.com
 * @author        Mahdi Yazdani
 * @since         1.0.0
 *
 * @package       pluginname-customizer
 * @subpackage    pluginname-customizer/frontend
 */

namespace PluginName_Customizer\Frontend;

use PluginName_Customizer\Includes\Utils as Utils;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'Core' ) ) :

	/**
	 * The main public-specific class.
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
		 * Register the static resources for the public-facing side of the site.
		 *
		 * @since     1.0.0
		 * @return    void
		 */
		public function enqueue(): void {
			// Enqueue public-facing static resources.
			Utils::enqueue_resources( 'frontend' );

			wp_localize_script(
				Utils::get_asset_handle( 'frontend', 'script' ),
				Utils::underlinify( PLUGIN['slug'] ),
				apply_filters(
					'pluginname_customizer_l10n_args',
					array(
						'ajaxurl'  => admin_url( 'admin-ajax.php', 'relative' ),
						'isRTL'    => is_rtl(),
						'isMobile' => wp_is_mobile(),
					)
				)
			);

			do_action( 'pluginname_customizer_enqueue_frontend' );
		}

	}
endif;
