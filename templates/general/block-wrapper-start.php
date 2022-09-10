<?php
/**
 * The template part for displaying the start of the block render callback wrapper tag.
 *
 * @link          https://www.mahdiyazdani.com
 * @author        Mahdi Yazdani
 * @since         1.0.0
 *
 * @package       pluginname-customizer
 * @subpackage    pluginname-customizer/templates/general
 */

namespace PluginName_Customizer\Templates\General;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

?>
<div <?php echo \wp_kses( $args['wrapper_attributes'], \wp_kses_allowed_html( 'data' ) ); ?>>

<?php
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
