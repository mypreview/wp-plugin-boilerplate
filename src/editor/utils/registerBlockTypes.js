/**
 * External dependencies
 */
import forEach from 'lodash/forEach';

/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Function to register each block individually.
 *
 * @param     {Array}    blocks    List of project-level blocks to register.
 * @return    {void}
 */
export default ( blocks ) => {
	forEach( blocks, ( block ) => {
		if ( ! block ) {
			return;
		}

		const { name, settings } = block;

		registerBlockType( name, settings );
	} );
};
