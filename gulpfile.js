var gulp = require("gulp");
var sass = require("gulp-sass");
var autoprefixer = require("gulp-autoprefixer");
var plumber = require('gulp-plumber');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require("gulp-uglify");
var browser = require("browser-sync");
var comb = require("gulp-csscomb");
var gulpif = require('gulp-if');
var minimist = require('minimist');

var options = minimist(process.argv.slice(2), env);

var env = {
	string: 'env',
	default: { env: process.env.NODE_ENV || 'dev' }
};

var isProduction = (options.env === 'production') ? true : false;

gulp.task("browser-sync", function() {
	browser.init({
		server: {
			baseDir: "./"
		}
	});
});

gulp.task("js", function() {
	gulp.src("src/js/**/*.js")
		.pipe(plumber())
		.pipe(uglify())
		.pipe(gulp.dest("./dist/scripts/"))
		.pipe(browser.reload({ stream:true }))
});

gulp.task("sass", function() {
	gulp.src("src/sass/**/*.scss")
		.pipe(plumber())
		.pipe(gulpif(!isProduction, sourcemaps.init()))
		.pipe(gulpif(!isProduction, sass()))
		.pipe(gulpif(isProduction, sass({outputStyle: 'compressed'})))
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		//.pipe(gulpif(isProduction, comb()))
		.pipe(gulpif(!isProduction, sourcemaps.write()))
		.pipe(gulp.dest("./dist/styles/"))
		.pipe(browser.reload({ stream:true }))
});

gulp.task("html", function() {
	gulp.src(["**/*.html"])
		.pipe(browser.reload({ stream:true }))
});

gulp.task("default",['browser-sync'], function() {
	gulp.watch("src/js/**/*.js",["js"]);
	gulp.watch("src/sass/**/*.scss",["sass"]);
	gulp.watch(["**/*.html"],["html"]);
});
