var gulp = require('gulp');
var	sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var	postcss = require('gulp-postcss');
var	autoprefixer = require('autoprefixer');
var mqpacker = require('css-mqpacker');
var csswring = require('csswring');
var concat = require('gulp-concat-sourcemap');
var uglify = require('gulp-uglify');


gulp.task('styles', function(){
	var postcssProcessors = [
		autoprefixer(),
		mqpacker,
		csswring
	];

	return gulp.src('./sass/main.sass')
		.pipe(sourcemaps.init())
		.pipe(sass({style: 'compressed'}).on('error', sass.logError))
		.pipe(postcss(postcssProcessors))
		.pipe(sourcemaps.write('./maps'))
		.pipe(gulp.dest('./css'));
});

gulp.task('scripts', function(){
	return gulp.src(['./js/thirdparty/*.js', './js/gdpr.js'])
		.pipe(sourcemaps.init())
		.pipe(concat('main.js'))
		.pipe(uglify())
		.pipe(sourcemaps.write('./maps'))
		.pipe(gulp.dest('./js/min'));
});


gulp.task('watch', function(){
	gulp.watch('sass/**/*.sass', ['styles']);
	gulp.watch('js/**/*.js', ['scripts']);
});

gulp.task('default', ['styles','scripts','watch']);
