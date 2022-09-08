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
 * @phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
 */

namespace PluginName_Customizer\Templates\General;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

?>
<div <?php echo $args['wrapper_attributes']; ?>>

<?php
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
