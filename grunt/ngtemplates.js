module.exports = {
	dev: {
		options: {
			append: true,
			module: 'uhlu'
		},
		cwd: '<%= config.src.app %>',
		src: [
			'**/*.html',
			'!*.html'
		],
		dest: '<%= config.dist.root %>uhlu.js'
	},
	dist: {
		options: {
			append: true,
			module: 'uhlu',
			htmlmin: {
				removeComments: true,
				collapseWhitespace: true,
				collapseBooleanAttributes: true
			}
		},
		cwd: '<%= config.src.app %>',
		src: [
			'**/*.html',
			'!*.html'
		],
		dest: '<%= config.dist.root %>uhlu.js'
	}
};
