// original source : https://github.com/iampeter/backbone-marionette-gulp-seed/blob/master/gulpfile.js

var gulp = require('gulp');
var gutil = require('gulp-util');
var sass = require('gulp-ruby-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minifycss = require('gulp-minify-css');
var rename = require('gulp-rename');
var size = require('gulp-size');
var watch = require('gulp-watch');
var autoprefixer = require('gulp-autoprefixer');
var notify = require('gulp-notify');
var replace = require('gulp-replace');
var jshint = require('gulp-jshint');
var debug = require('gulp-debug');
var stylish = require('jshint-stylish');
var fs = require('fs');
var path = require('path');
var rimraf = require('rimraf');

var environment = 'development';
var paths = {
    devFolder: './app/assets/',
    distFolder: './public/assets/',

    init: function() {
        this.src = {
            js: path.join(this.devFolder, 'js'),
            sass: path.join(this.devFolder, 'sass'),
            bower: path.join(this.devFolder, 'components')
        };

        this.dist = {
            js: path.join(this.distFolder, 'js'),
            css: path.join(this.distFolder, 'css'),
            font: path.join(this.distFolder, 'fonts')
        };

        return this;
    }
}.init();

gulp.task('set:production', function() {
    environment = 'production';
});

gulp.task('clean:styles', function (cb) {
    rimraf(paths.dist.css, cb);
});

gulp.task('clean:fonts', function (cb) {
    rimraf(paths.dist.font, cb);
});

gulp.task('clean:scripts', function (cb) {
    rimraf.sync(paths.tmpFolder);
    rimraf(paths.dist.js, cb);
});

gulp.task('styles', ['clean:styles'], function () {
    var sourcemap = environment === 'production' ? false : true;

    var stream = gulp.src(path.join(paths.src.sass, '*.scss'))
        .pipe(sass({
            style: 'expanded',
            loadPath: [paths.src.bower],
            sourcemap: sourcemap
        }))
        .pipe(autoprefixer("last 3 version", "safari 5", "ie 8", "ie 9"))
        .pipe(rename({ suffix: '.min' }))
        .pipe(minifycss())
        .pipe(gulp.dest(paths.dist.css))
        .pipe(size())
        .pipe(notify({message: 'styles task completed'}));
});


gulp.task('fonts', ['clean:fonts'], function () {
    return gulp.src([
            path.join(paths.src.bower, '/bootstrap-sass-official/vendor/assets/fonts/bootstrap/*'),
            path.join(paths.src.bower, '/fontawesome/fonts/*')
        ])
        .pipe(gulp.dest(paths.dist.font));
});

gulp.task('default', ['styles', 'fonts']);
gulp.task('production', ['set:production', 'default']);
