<?php
/**
 * The template part for displaying the start of the posts wrapper tag.
 *
 * @link          https://www.mahdiyazdani.com
 * @author        Mahdi Yazdani
 * @since         1.0.0
 *
 * @package       pluginname-customizer
 * @subpackage    pluginname-customizer/templates/general
 * @phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
 */

namespace PluginName_Customizer\Templates\General;

use PluginName_Customizer\Includes\Utils as Utils;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

?>
<div class="<?php echo esc_attr( $args['class_name'] . '__posts' ); ?>" <?php echo Utils::implode_html_attributes( $args['attributes'] ?? array() ); ?>>

<?php
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
