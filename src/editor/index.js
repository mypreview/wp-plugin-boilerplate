/**
 * Stylesheet dependencies.
 */
import './index.scss';

/**
 * Internal dependencies
 */
import { collections, styles } from './enhancements';
import { registerBlockCollections, registerBlockStyles, registerBlockTypes } from './utils';

/**
 * Group all blocks registered from this plugin.
 */
registerBlockCollections( collections );

/**
 * Register block styles.
 */
registerBlockStyles( styles );

/**
 * Blocks
 */
// import * as blockName from './block-name';

/**
 * Function to register blocks provided by this plugin.
 */
registerBlockTypes( [] );
