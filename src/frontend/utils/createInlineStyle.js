/**
 * Function to insert the resulting style node into the DOM tree before the closing `head` tag.
 *
 * @param     {Array}     id     Id associated with the style tag.
 * @param     {string}    css    CSS styles in string.
 * @return    {void}
 */
export default ( id, css ) => {
	document.head.insertAdjacentHTML( 'beforeend', `<style id="${ id }">${ css }</style>` );
};
