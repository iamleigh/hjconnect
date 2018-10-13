// Load packages
var fs           = require( 'fs' ),
	gulp         = require( 'gulp' ),
	watch        = require( 'gulp-watch' ),
	sass         = require( 'gulp-sass' ),
	sourcemaps   = require( 'gulp-sourcemaps' ),
	autoprefixer = require( 'gulp-autoprefixer' ),
	rename       = require( 'gulp-rename' ),
	notify       = require( 'gulp-notify' ),
	wpPot        = require( 'gulp-wp-pot' )
	;

// Get package.json file
var pckg = JSON.parse( fs.readFileSync( './package.json' ) );

// List of browsers
var browserlist = [
	'last 2 version',
	'> 1%'
];

// Paths
var paths = {
    src:      'admin/sass/',
	dist:     'admin/css/',
	distLang: 'languages/'
};

// Localized strings
var strings = [
    'hjconnect.php',
    'admin/*.php',
    'admin/**/*.php',
    'includes/*.php'
];

// ==================================================
// Tasks

// Task: Compress admin styles
gulp.task( 'admin-styles', function() {

	gulp.src( paths.src + '**/**/*.scss' )
		.pipe( sourcemaps.init() )
		.pipe( sass({ outputStyle: 'compressed' }) ).on( 'error', function( err ) {
			notify().write( err );
		} )
		.pipe( autoprefixer( browserlist ) )
		.pipe( sourcemaps.write( 'maps' ) )
		.pipe( rename({
			suffix: '.min'
		}) )
		.pipe( gulp.dest( paths.dist ) )
		.pipe( notify({
			message: 'Plugin styles are ready',
			onLast: true
		}) )
		;
} );

gulp.task( 'watch-admin-styles', function() {
	gulp.watch( paths.src + '**/**/*.scss', [ 'admin-styles' ] );
} );

// Task: Create language files
gulp.task( 'makepot', function() {

	return gulp.src( strings )
		.pipe( wpPot({
			domain:         'hjconnect',
			package:        'Hotjar Connect ' + pckg.version,
			bugReport:      'https://github.com/iamleigh/hjconnect/issues?q=is%3Aopen',
			lastTranslator: 'Leighton Sapir <leighton@pandamints.com>',
            team:           'Leighton Sapir <leighton@pandamints.com>'
		}) )
		.pipe( gulp.dest( paths.distLang + 'hustle-en_US.po' ) )
		.pipe( notify({
			message: 'Plugin translation file is ready.',
			onLast: true
		}) )
		;
});

// ==================================================
// Watch

// Watch all tasks
gulp.task( 'default', [ 'watch-admin-styles' ] );

// Watch admin tasks
gulp.task( 'admin', [ 'watch-admin-styles' ] );

// Build styles and scripts
gulp.task( 'build', [ 'admin-styles', 'makepot' ] );
