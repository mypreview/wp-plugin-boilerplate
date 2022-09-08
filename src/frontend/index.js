/**
 * WordPress dependencies
 */
import domReady from '@wordpress/dom-ready';

/**
 * Stylesheet dependencies.
 */
import './index.scss';

/**
 * Internal dependencies
 */
import { registerScripts } from './utils';

/**
 * Blocks
 */
// import blockName from '../editor/block-name/view';

/**
 * Execute the `ready` method from each component when the DOM is loaded.
 */
domReady( () => {
	registerScripts( [] );
} );
