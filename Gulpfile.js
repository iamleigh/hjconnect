'use strict';

// Project paths
var paths = {
    src: 'admin/sass/',
    dist: 'admin/css/'
};

// Load packages
var gulp = require('gulp'),
    watch = require('gulp-watch'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    autoprefixer = require('gulp-autoprefixer'),
    notify = require('gulp-notify'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    wpPot = require('gulp-wp-pot')
;

// TASK admin-styles
gulp.task( 'admin-styles', function() {
    gulp.src( paths.src + '**/**/*.scss' )
        .pipe( sourcemaps.init() )
        .pipe( sass( {outputStyle: 'compressed'} ) ).on( 'error', function(err) {notify().write(err);} )
        .pipe( autoprefixer( 'last 2 version', '> 1%', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4' ) )
        .pipe( sourcemaps.write( "maps" ) )
        .pipe( gulp.dest( paths.dist ) )
		.pipe( notify( {message: 'Plugin styles are ready.', onLast: true} ) );
} );

// TASK makepot
var potSources = [
    'hjconnect.php',
    'admin/*.php',
    'admin/**/*.php',
    'includes/*.php'
];

gulp.task( 'makepot', function () {
    return gulp.src(potSources)
        .pipe( wpPot( {
            domain          : 'hjconnect',
            destFile        : 'languages/iamleigh.pot',
            package         : 'Hotjar Connect',
            bugReport       : 'https://github.com/iamleigh/hjconnect/issues?q=is%3Aopen',
            lastTranslator  : 'Leighton Sapir <leighton@pandamints.com>',
            team            : 'Leighton Sapir <leighton@pandamints.com>'
        } ) )
        .pipe( gulp.dest( 'languages/hjconnect-en_US.po' ) )
        .pipe( notify( { message: 'Plugin translation is ready.', onLast: true } ) );
} );

// TASK watch-css
gulp.task( 'watch-css', function() {
    gulp.watch( paths.src + '**/**/**/**/*.scss', ['styles'] );
} );

// Register tasks to 'gulp' command
gulp.task( 'default', ['admin-styles', 'watch-css'] );