<?php
/**
 * Helper functions.
 *
 * @link          https://www.upwork.com/fl/mahdiyazdani
 * @author        Mahdi Yazdani
 * @since         1.0.0
 *
 * @package       pluginname-customizer
 * @subpackage    pluginname-customizer/includes
 */

namespace PluginName_Customizer\Includes;

use const PluginName_Customizer\PLUGIN as PLUGIN;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'Utils' ) ) :

	/**
	 * The main helper-specific class.
	 */
	class Utils {

		/**
		 * Retrieve dependency extraction array for a given resource.
		 *
		 * @since     1.0.0
		 * @param     string $filename        Asset name (filename).
		 * @param     array  $dependencies    Array of asset dependencies.
		 * @return    array
		 */
		public static function get_file_asset( string $filename = '', array $dependencies = array( 'jquery' ) ): array {
			// Bail early, in case the filename is not provided.
			if ( empty( $filename ) ) {
				return array();
			}

			$file_path       = PLUGIN['dir_path'] . '/build/' . $filename . '.js';
			$file_asset_path = PLUGIN['dir_path'] . '/build/' . $filename . '.asset.php';
			$file_asset      = file_exists( $file_asset_path ) ? require $file_asset_path : array(
				'dependencies' => $dependencies,
				'version'      => filemtime( $file_path ),
			);

			return $file_asset;
		}

		/**
		 * Retrieve handle of the stylesheet or script to enqueue.
		 *
		 * @since     1.0.0
		 * @param     string $asset_name    Name of the asset.
		 * @param     string $type          Type of the asset, ex. style, script, font, etc.
		 * @return    string
		 */
		public static function get_asset_handle( string $asset_name = 'frontend', string $type = 'style' ): string {
			$identifiers = array( PLUGIN['slug'], $asset_name, $type );
			$handle      = implode( '-', $identifiers );
			return $handle;
		}

		/**
		 * Enqueue static resources.
		 *
		 * @since     1.0.0
		 * @param     string $asset_name    Name of the asset.
		 * @return    void
		 */
		public static function enqueue_resources( string $asset_name = '' ): void {
			// Bail early, in case the asset name is not provided.
			if ( empty( $asset_name ) ) {
				return;
			}

			$asset         = self::get_file_asset( $asset_name );
			$version       = $asset['version'] ?? '1.0';
			$style_handle  = self::get_asset_handle( $asset_name, 'style' );
			$script_handle = self::get_asset_handle( $asset_name, 'script' );

			wp_enqueue_style( $style_handle, PLUGIN['dir_url'] . '/build/' . $asset_name . '.css', array(), $version, 'screen' );
			wp_enqueue_script( $script_handle, PLUGIN['dir_url'] . '/build/' . $asset_name . '.js', $asset['dependencies'] ?? array(), $version, true );
		}

		/**
		 * Sanitizes and returns a single value from the given array.
		 *
		 * @since     1.0.0
		 * @param     array  $array       The array.
		 * @param     string $key         Array key.
		 * @param     string $fallback    Fallback value.
		 * @return    string
		 */
		public static function get_array_value( array $array = array(), string $key = '', string $fallback = '' ): string {
			if ( array_key_exists( $key, $array ) ) {
				return self::clean( $array[ $key ] );
			}

			return $fallback;
		}

		/**
		 * Returns whether the current user has the specified capability.
		 *
		 * @since     1.0.0
		 * @return    bool
		 */
		public static function rest_editor_permission_callback(): bool {
			return current_user_can( 'edit_posts' );
		}

		/**
		 * Returns a notice if there are no results to display from the query.
		 *
		 * @since     1.0.0
		 * @param     string $notice    Notice content.
		 * @return    string
		 */
		public static function notfound_notice( string $notice = '' ): string {
			// Placeholder notice content, in case not passed initially.
			if ( empty( $notice ) ) {
				$notice = __( 'No results found.', 'pluginname-customizer' );
			}

			return sprintf( '<div class="notice components-notice is-info"><div class="components-notice__content"><p>%s</p></div></div>', esc_html( $notice ) );
		}

		/**
		 * Converts a string (e.g. 'yes' or 'no') to a bool.
		 *
		 * @since     1.0.0
		 * @param     string $input    String to convert.
		 * @return    bool
		 */
		public static function string_to_bool( string $input ): bool {
			return is_bool( $input ) ? $input : ( 'yes' === $input || 1 === $input || 'true' === $input || 'TRUE' === $input || '1' === $input );
		}

		/**
		 * Titlifies every slug given to a human-friendly title string.
		 *
		 * @since     1.0.0
		 * @param     string $input        The value to titlify.
		 * @param     string $delimiter    Optional. The delimiter to be replaced with.
		 * @return    string
		 */
		public static function titlify( string $input, string $delimiter = ' ' ): string {
			$input = preg_replace( '/[\']/', '', iconv( 'UTF-8', 'ASCII//TRANSLIT', $input ) );
			$input = preg_replace( '/[&]/', 'and', $input );
			$input = preg_replace( '/[^A-Za-z0-9-]+/', $delimiter, $input );
			$input = preg_replace( '/[\s-]+/', $delimiter, $input );
			$input = trim( $input, $delimiter );
			$input = ucwords( $input );

			return $input;
		}

		/**
		 * Adds forward slash before each starting camelcase word.
		 *
		 * @since     1.0.0
		 * @param     string $input    The value to process.
		 * @return    string
		 */
		public static function normalize_namespace( string $input ): string {
			return preg_replace( '~[a-z]\K(?=[A-Z])~', '\\', $input );
		}

		/**
		 * Slugifies every string, even when it contains unicode!
		 *
		 * @since     1.0.0
		 * @param     string $input    The value to slugify.
		 * @return    string
		 */
		public static function slugify( string $input ): string {
			$input = preg_replace( '~[^\pL\d]+~u', '-', $input );
			$input = iconv( 'utf-8', 'us-ascii//TRANSLIT', $input );
			$input = preg_replace( '~[^-\w]+~', '', $input );
			$input = trim( $input, '-' );
			$input = preg_replace( '~-+~', '-', $input );
			$input = strtolower( $input );

			if ( empty( $input ) ) {
				return 'n-a';
			}

			return $input;
		}

		/**
		 * Underlinifies every string given.
		 *
		 * @since     1.0.0
		 * @param     string $input    Given string or filename.
		 * @return    string
		 */
		public static function underlinify( string $input ): string {
			return preg_replace( '/-/', '_', self::slugify( $input ) );
		}

		/**
		 * Determines whether the variable is a valid array and has at least one item within it.
		 *
		 * @since     1.0.0
		 * @param     array $input    The array to check.
		 * @return    bool
		 */
		public static function if_array( array $input ): bool {
			if ( is_array( $input ) && ! empty( $input ) ) {
				return true;
			}

			return false;
		}

		/**
		 * Query a third-party plugin activation.
		 * This statement prevents from producing fatal errors,
		 * in case the the plugin is not activated on the site.
		 *
		 * @since     1.0.0
		 * @param     string $slug        Plugin slug to check for the activation state.
		 * @param     string $filename    Optional. Plugin’s main file name.
		 * @return    bool
		 * @phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
		 */
		public static function is_plugin_activated( string $slug, string $filename = '' ): bool {
			$filename               = empty( $filename ) ? $slug : $filename;
			$plugin_path            = apply_filters( 'pluginname_customizer_third_party_plugin_path', sprintf( '%s/%s.php', esc_html( $slug ), esc_html( $filename ) ) );
			$subsite_active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
			$network_active_plugins = apply_filters( 'active_plugins', get_site_option( 'active_sitewide_plugins' ) );

			// Bail early in case the plugin is not activated on the website.
			// phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
			if ( ( empty( $subsite_active_plugins ) || ! in_array( $plugin_path, $subsite_active_plugins ) ) && ( empty( $network_active_plugins ) || ! array_key_exists( $plugin_path, $network_active_plugins ) ) ) {
				return false;
			}

			return true;
		}

		/**
		 * Query the "Polylang" plugin activation.
		 *
		 * @since     1.0.0
		 * @return    bool
		 */
		public static function is_polylang_activated(): bool {
			return self::is_plugin_activated( 'polylang' );
		}

		/**
		 * Determines if a post, identified by the specified ID,
		 * exist within the WordPress database.
		 *
		 * @since     1.0.0
		 * @param     null|string $post_id    Post ID.
		 * @return    bool
		 */
		public static function is_post_exists( ?string $post_id = '' ): bool {
			return ! empty( $post_id ) && is_string( get_post_type( $post_id ) );
		}

		/**
		 * Call a shortcode function by tag name.
		 *
		 * @param     string $tag        The shortcode whose function to call.
		 * @param     array  $atts       Optional. The attributes to pass to the shortcode function. Optional.
		 * @param     string $content    Optional. The shortcode's content. Default is null (none).
		 * @return    string|null
		 */
		public static function do_shortcode( string $tag, array $atts = array(), ?string $content = null ): ?string {
			global $shortcode_tags;

			if ( ! isset( $shortcode_tags[ $tag ] ) ) {
				return null;
			}

			return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
		}

		/**
		 * Retrieves a query of the latest posts, or posts matching the given criteria.
		 *
		 * @since     1.0.0
		 * @param     array $args    Value to merge with $defaults.
		 * @return    object
		 */
		public static function get_posts_query( array $args = array() ): object {
			$args  = wp_parse_args(
				$args,
				apply_filters(
					'pluginname_customizer_posts_query_args',
					array(
						'post_type'           => 'post',
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true,
						'suppress_filters'    => false,
						'posts_per_page'      => -1,
						'order'               => 'desc',
						'orderby'             => 'date',
					)
				)
			);
			$query = new \WP_Query( $args );

			// Reset the main query loop.
			wp_reset_postdata();

			return $query;
		}

		/**
		 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
		 * Non-scalar values are ignored.
		 *
		 * @since     1.0.0
		 * @param     string|array $var    Data to sanitize.
		 * @return    string|array
		 */
		public static function clean( $var ) {
			if ( is_array( $var ) ) {
				return array_map( 'self::clean', $var );
			} else {
				return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
			}
		}

		/**
		 * Recursive sanitation for an array.
		 * Returns the sanitized values of an array.
		 *
		 * @since     1.0.0
		 * @param     array $input    Array of values.
		 * @return    array
		 */
		public static function clean_array( array $input ): array {
			// Bail early, in case the input value is missing or not an array.
			if ( empty( $input ) || ! is_array( $input ) ) {
				return array();
			}

			// Loop through the array to sanitize each key/values recursively.
			foreach ( $input as $key => &$value ) {
				if ( is_array( $value ) ) {
					$value = self::clean_array( $value );
				} else {
					$value = self::clean( $value );
				}
			}

			return $input;
		}

		/**
		 * Sanitize multiple HTML classes in one pass.
		 *
		 * @param     array  $classes          Classes to be sanitized.
		 * @param     string $return_format    The return format, 'input', 'string', or 'array'.
		 * @return    array|string
		 */
		public static function sanitize_html_classes( array $classes, string $return_format = 'input' ) {
			if ( 'input' === $return_format ) {
				$return_format = is_array( $classes ) ? 'array' : 'string';
			}

			$classes           = is_array( $classes ) ? $classes : explode( ' ', $classes );
			$sanitized_classes = array_map( 'sanitize_html_class', $classes );

			if ( 'array' === $return_format ) {
				return $sanitized_classes;
			} else {
				return implode( ' ', $sanitized_classes );
			}
		}

		/**
		 * Implode and escape HTML attributes for output.
		 *
		 * @since     1.0.0
		 * @param     array $raw_attributes    Attribute name value pairs.
		 * @return    string
		 */
		public static function implode_html_attributes( array $raw_attributes ): string {
			$attributes = array();
			foreach ( $raw_attributes as $name => $value ) {
				$attributes[] = esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
			}
			return implode( ' ', $attributes );
		}

		/**
		 * Returns the template file name without extension being added to it.
		 *
		 * @since     1.0.0
		 * @param     string $file    Template file name (filename).
		 * @return    string
		 */
		public static function get_template_filename( string $file ): string {
			return preg_replace( '/\\.[^.\\s]{3,4}$/', '', $file );
		}

		/**
		 * Returns the template file directory and relative file path.
		 *
		 * @since     1.0.0
		 * @param     string $file    File path.
		 * @return    string
		 */
		public static function get_template_path( string $file ): string {
			return PLUGIN['dir_path'] . '/templates/' . self::get_template_filename( $file ) . '.php';
		}

		/**
		 * Returns the HTML template instead of outputting.
		 *
		 * @since     1.0.0
		 * @param     string $template_name    Template name.
		 * @param     array  $args             Arguments. (default: array).
		 * @return    string
		 */
		public static function get_template_html( string $template_name, array $args = array() ): string {
			ob_start();
			load_template( self::get_template_path( $template_name ), false, $args );
			return ob_get_clean();
		}

		/**
		 * Retrieves post id of given post-object or currently queried object id.
		 *
		 * @since     1.0.0
		 * @param     int|WP_Post|null $post    Post ID or post object.
		 * @return    int
		 */
		public static function get_post_id( $post = null ): ?int {
			$post_id  = null;
			$get_post = get_post( $post, 'OBJECT' );

			if ( is_null( $get_post ) ) {
				$post_id = (int) get_queried_object_id();
			} elseif ( property_exists( $get_post, 'ID' ) ) {
				$post_id = (int) $get_post->ID;
			}

			return $post_id;
		}

		/**
		 * Post id of the translation if exists, null otherwise.
		 *
		 * @since     1.0.0
		 * @param     string $post_id    The return format, 'input', 'string', or 'array'.
		 * @return    null|string
		 */
		public static function get_localized_post_id( ?string $post_id = '' ): ?string {
			$return = null;

			if ( self::is_post_exists( $post_id ) ) {
				$return = $post_id;
				if ( self::is_polylang_activated() ) {
					$pll_post_id = pll_get_post( $post_id );
					if ( $pll_page_id && ! is_null( $pll_page_id ) ) {
						$return = $pll_post_id;
					}
				}
			}

			return $return;
		}

		/**
		 * Adds wrapper tag around the block (content) output.
		 *
		 * @since     1.0.0
		 * @param     array  $content               Block content.
		 * @param     string $wrapper_attributes    String of HTML attributes.
		 * @return    array
		 */
		public static function add_block_wrapper( array $content, string $wrapper_attributes ): array {
			array_unshift( $content, self::get_template_html( 'general/block-wrapper-start', array( 'wrapper_attributes' => $wrapper_attributes ) ) );
			array_push( $content, self::get_template_html( 'general/block-wrapper-end' ) );

			return $content;
		}

	}
endif;
