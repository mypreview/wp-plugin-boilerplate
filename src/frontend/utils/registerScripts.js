/**
 * External dependencies
 */
import forEach from 'lodash/forEach';

/**
 * Function to execute each script individually when DOM is ready.
 *
 * @param     {Array}    scripts    List of project-level scripts to execute.
 * @return    {void}
 */
export default ( scripts ) => {
	forEach( scripts, ( script ) => {
		if ( ! script ) {
			return;
		}

		script.ready();
	} );
};
