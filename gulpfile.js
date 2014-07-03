// original source : https://github.com/iampeter/backbone-marionette-gulp-seed/blob/master/gulpfile.js

var gulp = require('gulp');
var gutil = require('gulp-util');
var sass = require('gulp-ruby-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minifycss = require('gulp-minify-css');
var imagemin = require('gulp-imagemin');
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
            bower: path.join(this.devFolder, 'components'),
            image: path.join(this.devFolder, 'images'),
        };

        this.dist = {
            js: path.join(this.distFolder, 'js'),
            css: path.join(this.distFolder, 'css'),
            font: path.join(this.distFolder, 'fonts'),
            image: path.join(this.distFolder, 'images'),
        };

        return this;
    }
}.init();

function handleError(err) {
    console.log(err.toString());
    notify({message: err.toString()});
    this.emit('end');
}

gulp.task('set:production', function() {
    environment = 'production';
});

gulp.task('clean:styles', function (cb) {
    rimraf(paths.dist.css, cb);
});

gulp.task('clean:fonts', function (cb) {
    rimraf(paths.dist.font, cb);
});

gulp.task('clean:images', function (cb) {
    rimraf(paths.dist.image, cb);
});

gulp.task('clean:scripts', function (cb) {
    rimraf(paths.dist.js, cb);
});

gulp.task('styles', ['clean:styles'], function () {
    var sourcemap = environment === 'production' ? false : true;
    var stream;

    if (environment == 'production') {
        stream = gulp.src(path.join(paths.src.sass, '*.scss'))
            .pipe(sass({
                style: 'expanded',
                loadPath: [paths.src.bower],
                sourcemap: sourcemap
            }))
            .on('error', handleError)
            .pipe(minifycss());
    } else {
        stream = gulp.src(path.join(paths.src.sass, '*.scss'))
            .pipe(sass({
                style: 'expanded',
                loadPath: [paths.src.bower],
                sourcemap: sourcemap
            }))
            .on('error', handleError);
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


gulp.task('images', ['clean:images'], function () {
    return gulp.src([
            path.join(paths.src.image, '**/*')
        ])
        .pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
        .pipe(gulp.dest(paths.dist.image))
        .pipe(size());
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

gulp.task('build:ghostScript', ['clean:scripts', 'jshint'], function () {
    var stream = gulp.src([
            path.join(paths.src.bower, 'lodash/dist/lodash.underscore.js'),
            path.join(paths.src.bower, 'showdown/src/showdown.js'),
            path.join(paths.src.js, 'ghost/lib/showdown/extensions/ghostgfm.js'),
            path.join(paths.src.js, 'ghost/lib/init.js'),
            path.join(paths.src.js, 'ghost/lib/editor/index.js'),
            path.join(paths.src.js, 'ghost/lib/editor/htmlPreview.js'),
        ])
        .pipe(concat("ghost.js"));

    if (environment == 'production') {
        stream.pipe(uglify());
    }

    return stream.pipe(gulp.dest(path.join(paths.dist.js)))
        .pipe(notify({message: 'ghostScripts task completed'}));
});


gulp.task('scripts', ['build:ghostScript'], function () {
    var stream = gulp.src([
            path.join(paths.src.bower, 'jquery/jquery.min.js'),
            path.join(paths.tmpFolder, 'bootstrap.js'),
            path.join(paths.src.bower, 'headroom.js/dist/headroom.js'),
            path.join(paths.src.bower, 'imagesloaded/imagesloaded.pkdd.js'),
            path.join(paths.src.bower, 'wookmark-jquery/jquery.wookmark.js'),
            path.join(paths.src.bower, 'velocity/jquery.velocity.js'),
            path.join(paths.src.bower, 'velocity/velocity.ui.js'),
            path.join(paths.src.bower, 'handlebars/handlebars.js'),
            path.join(paths.src.bower, 'spin.js/spin.js'),
            path.join(paths.src.bower, 'ladda-bootstrap/dist/ladda.js'),
            path.join(paths.src.bower, 'highlight/build/highlight.pack.js'),
            path.join(paths.src.bower, 'bootstrapValidator/dist/js/bootstrapValidator.js'),
            path.join(paths.src.bower, 'jquery-endpage/src/endpage.js'),
            path.join(paths.src.js, 'main.js'),
        ])
        .pipe(concat("app.js"));

    if (environment == 'production') {
        stream.pipe(uglify());
    }

    return stream.pipe(gulp.dest(path.join(paths.dist.js)))
        .pipe(notify({message: 'scripts task completed'}));
});

gulp.task('watch', function () {
    gulp.watch(path.join(paths.src.sass, '**/*.scss'), ['styles']);
    gulp.watch(path.join(paths.src.image, '**/*'), ['images']);
    gulp.watch(path.join(paths.src.js, '**/*.js'), ['scripts']);
});


gulp.task('default', ['styles', 'fonts', 'images', 'scripts']);
gulp.task('production', ['set:production', 'default']);
