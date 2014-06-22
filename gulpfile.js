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
    tmpFolder: './.tmp/',
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
        .pipe(rename({ suffix: '.min' }));

    if (environment == 'production') {
        stream.pipe(minifycss());
    }

    return stream.pipe(gulp.dest(paths.dist.css))
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

gulp.task('build:bootstrapScript', function () {
    var stream = gulp.src([
        'affix.js',
        'alert.js',
        'button.js',
        'carousel.js',
        'collapse.js',
        'dropdown.js',
        'tab.js',
        'transition.js',
        'scrollspy.js',
        'modal.js',
        'tooltip.js',
        'popover.js'
    ], {cwd: path.join(paths.src.bower, 'bootstrap-sass-official/vendor/assets/javascripts/bootstrap')})
        .pipe(concat('bootstrap.js'));

    if (environment === 'production') {
        stream.pipe(uglify());
    }

    return stream.pipe(gulp.dest(paths.tmpFolder))
        .pipe(size());
});

gulp.task('jshint', ['build:bootstrapScript'], function () {
    return gulp.src([
            'gulpfile.js',
            path.join(paths.src.js, '**/*.js')
        ])
        .pipe(jshint())
        .pipe(jshint.reporter(stylish, { verbose: true }));
});

gulp.task('scripts', ['clean:scripts', 'jshint'], function () {
    var stream = gulp.src([
            path.join(paths.src.bower, 'jquery/jquery.min.js'),
            path.join(paths.tmpFolder, 'bootstrap.js'),
            path.join(paths.src.bower, 'headroom.js/dist/headroom.js'),
        ])
        .pipe(concat("app.js"));

    if (environment == 'production') {
        stream.pipe(uglify());
    }

    return stream.pipe(gulp.dest(path.join(paths.dist.js)));
});


gulp.task('watch', function () {
    gulp.watch(path.join(paths.src.sass, '**/*.scss'), ['styles']);
    gulp.watch(path.join(paths.src.js, '**/*.js'), ['scripts']);
});


gulp.task('default', ['styles', 'fonts', 'scripts']);
gulp.task('production', ['set:production', 'default']);
