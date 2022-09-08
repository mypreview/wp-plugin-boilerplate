/**
 * External dependencies
 */
import forEach from 'lodash/forEach';

/**
 * WordPress dependencies
 */
import { registerBlockStyle } from '@wordpress/blocks';

/**
 * Function to register new block style variations for the given blocks.
 *
 * @param     {Array}    styles    List of project-level block styles to register.
 * @return    {void}
 */
export default ( styles ) => {
	forEach( styles, ( style ) => {
		if ( ! style ) {
			return;
		}

		const { block, ...otherProps } = style;

		registerBlockStyle( block, otherProps );
	} );
};
