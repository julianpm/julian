var gulp = require('gulp');
		styles = require('gulp-sass');
		clean = require('gulp-clean-css');
		autoprefixer = require('gulp-autoprefixer');
		sourcemaps = require('gulp-sourcemaps');
		rename = require('gulp-rename');
		concat = require('gulp-concat');
		uglify = require('gulp-uglify');
		livereload = require('gulp-livereload');

var paths = {
	src: {
		js: 'src/js/**/*.js',
		php: './**/*.php',
		scss: 'src/scss/app.scss',
		scssWatch: 'src/scss/**/*.scss'
	},
	dest: {
		js: 'assets/js/',
		scss: 'assets/css/'
	}
}

gulp.task('php', function() {
	return gulp.src(paths.src.php)
		.pipe(livereload())
});

gulp.task('styles', function() {
	return gulp.src(paths.src.scss)
		.pipe(sourcemaps.init())
		.pipe(styles({
			errLogToConsole: true
		}))
		.pipe(clean())
		.pipe(autoprefixer())
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest(paths.dest.scss))
		.pipe(livereload())
});

gulp.task('js', function() {
	return gulp.src(paths.src.js)
		.pipe(concat('app.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(paths.dest.js))
		.pipe(livereload())
});

gulp.task('watch', function() {
	livereload.listen();
	gulp.watch(paths.src.js, gulp.series(['js']));
	gulp.watch(paths.src.php, gulp.series(['php']));
	gulp.watch(paths.src.scssWatch, gulp.series(['styles']));
});

gulp.task('default', gulp.series(['php', 'styles', 'js', 'watch']));

// 'use strict';

// var gulp    = require('gulp'),
// 	plugins = require('gulp-load-plugins')({ camelize: true });
// var browserSync = require('browser-sync').create();

// var paths = {
// 	src: {
// 		php: '../**/*.php',
// 		img: 'src/img/**/*.{png,jpg,gif,svg}',
// 		js: 'src/js/*.js',
// 		angular: 'src/js/angular/**/*.js',
// 		vendor: 'src/js/vendor/**/*.js',
// 		scss: 'src/scss/app.scss',
// 		scssWatch: 'src/scss/**/*.scss'
// 	},
// 	dest: {
// 		img: '../assets/img/',
// 		js: '../assets/js/',
// 		scss: '../assets/css/'
// 	}
// }

// function errorLog(error) {
//     console.log(error.message);
//     this.emit('end');
// }

// gulp.task('browser-sync', function() {
//     browserSync.init( {
//         proxy: "julian.dev",
//     } );
// });

// gulp.task('browser-reload', function() {
// 	browserSync.reload();
// });

// gulp.task('sass', function() {
// 	return gulp.src( paths.src.scss )
// 		.pipe( plugins.sass( { outputStyle: 'compressed' } ) )
// 		.on('error', errorLog)
//         .pipe( plugins.autoprefixer( 'last 4 versions' ) )
// 		.pipe( gulp.dest( paths.dest.scss ) )
// 		.pipe( browserSync.stream() )
// 		.pipe( plugins.notify( { message: 'Styles task complete' } ) );
// });

// gulp.task('vendor', function(){
// 	return gulp.src( paths.src.vendor )
// 		.pipe( plugins.concat( 'vendor.min.js' ) )
// 		.pipe( plugins.uglify() )
// 		.on('error', errorLog)
// 		.pipe( gulp.dest( paths.dest.js ) )
// 		.pipe( plugins.notify( { message: 'Vendor Scripts task complete' } ) );
// });

// gulp.task('angular', function(){
// 	return gulp.src( paths.src.angular )
// 		.pipe( plugins.concat('angular.min.js'))
// 		.pipe( plugins.uglify())
// 		.on('error', errorLog)
// 		.pipe( gulp.dest( paths.dest.js ) )
// 		.pipe( plugins.notify( { message: 'Angular Scripts task complete' } ) );
// });

// gulp.task('js', function() {
// 	return gulp.src( paths.src.js )
// 		.pipe( plugins.concat( 'app.min.js' ) )
// 		.pipe( plugins.uglify() )
// 		.on('error', errorLog)
// 		.pipe( gulp.dest( paths.dest.js ) )
// 		.pipe( plugins.notify( { message: 'JS task complete' } ) );
// });

// gulp.task('img', function() {
// 	return gulp.src( paths.src.img )
// 		.pipe( plugins.cache( plugins.imagemin( { optimizationLevel: 7, progressive: true, interlaced: true } ) ) )
// 		.on('error', errorLog)
// 		.pipe( gulp.dest( paths.dest.img ) )
// 		.pipe( browserSync.stream() )
// 		.pipe( plugins.notify( { message: 'Images task complete' } ) );
// });

// gulp.task('clearCache', function(done) {
// 	return plugins.cache.clearAll(done);
// });

// gulp.task('watch', function(){
// 	gulp.watch( paths.src.php, ['browser-reload']);
// 	gulp.watch( paths.src.scssWatch, ['sass']);
// 	gulp.watch( paths.src.js, ['js']);
// 	gulp.watch( paths.src.angular, ['angular']);
// 	gulp.watch( paths.src.vendor, ['vendor']);
// 	gulp.watch( paths.src.img, ['img', 'browser-reload']);
// });

// gulp.task('default', ['sass', 'js', 'angular', 'vendor', 'img', 'watch', 'browser-sync']);
