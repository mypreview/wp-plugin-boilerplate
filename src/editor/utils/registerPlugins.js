/**
 * External dependencies
 */
import forEach from 'lodash/forEach';

/**
 * WordPress dependencies
 */
import { registerPlugin } from '@wordpress/plugins';

/**
 * Function to register each plugin individually.
 *
 * @param     {Array}    plugins    List of plugins to register.
 * @return    {void}
 */
export default ( plugins ) => {
	forEach( plugins, ( plugin ) => {
		if ( ! plugin ) {
			return;
		}

		const { name, settings } = plugin;

		registerPlugin( name, settings );
	} );
};
