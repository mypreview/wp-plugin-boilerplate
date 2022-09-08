const { resolve } = require( 'path' );
const defaultConfig = require( './node_modules/@wordpress/scripts/config/webpack.config.js' );
const WebpackNotifierPlugin = require( 'webpack-notifier' );

module.exports = {
	...defaultConfig,
	entry: {
		editor: resolve( process.cwd(), 'src', 'editor/index.js' ),
		frontend: resolve( process.cwd(), 'src', 'frontend/index.js' ),
	},
	performance: {
		hints: false,
	},
	plugins: [
		...defaultConfig.plugins,
		new WebpackNotifierPlugin( {
			emoji: true,
			alwaysNotify: true,
			skipFirstNotification: true,
		} ),
	],
};
