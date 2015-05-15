var gulp = require('gulp'),
    //_ = require('lodash'),
    gulpLoadPlugins = require('gulp-load-plugins'),
    gulpLoadPlugins = require('gulp-load-plugins'),
    plugins = gulpLoadPlugins({
        rename: {
            'gulp-minify-css': 'minifyCss'
        }
    }),
    env = 'dev',
    minify = false;

/**
 * help!
 */
if (plugins.util.env.help) {
    plugins.util.log(plugins.util.colors.cyan('--------------------------------------------------'));
    plugins.util.log('parameters:');
    plugins.util.log(plugins.util.colors.yellow('--help'), '        shows this help');
    plugins.util.log(plugins.util.colors.yellow('--env=<env>'), '   environment to create files for [dev]');
    plugins.util.log(plugins.util.colors.cyan('--------------------------------------------------'));

    return;
}

/**
 * check for commandline params and define defaults
 */
if (plugins.util.env.env) {
    env = plugins.util.env.env;
}

if (plugins.util.env.env && (plugins.util.env.env == 'prod' || plugins.util.env.env == 'stage')) {
    minify = true;
}

var files = {
    css: {
        core: {
            files: [
                './src/CoreBundle/Resources/public/css/bootstrap.css',
                './vendor/npm-asset/bootstrap/dist/css/bootstrap-theme.css',
                './src/CoreBundle/Resources/stylus/core.default.styl',
                './src/CoreBundle/Resources/stylus/*.default.styl'
            ],
            name: 'core.css',
            dest: './web/assets'
        },
        bootstrap: {
            src: './src/CoreBundle/Resources/less/bootstrap.less',
            dest: './src/CoreBundle/Resources/public/css/'
        }
    },
    js: {
        core: {
            files: [
                './vendor/bower-asset/jquery/dist/jquery.js',
                './vendor/bower-asset/jquery-ui/jquery-ui.js',
                './vendor/npm-asset/bootstrap/dist/js/bootstrap.js',
                './src/CoreBundle/Resources/public/js/holder.js',
                './src/CoreBundle/Resources/js/*.default.js'
            ],
            name: 'core.js',
            dest: './web/assets'
        }
    }
};

gulp.task('build:assets', ['build:js', 'build:css']);

gulp.task('default', ['build:assets']);

gulp.task('watch', ['build:assets'], function () {
    gulp.watch(files.css.core.files, ['build:css:core']);
    gulp.watch(files.js.bootstrap,['build:js:core']);
});

/** general task bundlers **/
gulp.task('build:js', ['build:js:core']);
gulp.task('build:css', ['bootstrap:compile:less', 'build:css:core']);

gulp.task('build:css:core', function () {
    gulp.src(files.css.core.files)
        .pipe(plugins.plumber())
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.stylus({compress: minify}))
        .pipe(plugins.concat(files.css.core.name))
        .pipe(plugins.sourcemaps.write('./'))
        .pipe(gulp.dest(files.css.core.dest));
});

gulp.task('build:js:core', function() {
    gulp.src(files.js.core.files)
        .pipe(plugins.plumber())
        .pipe(plugins.concat(files.js.core.name))
        .pipe(plugins.if(minify, plugins.uglify()))
        .pipe(plugins.sourcemaps.write('./'))
        .pipe(gulp.dest(files.js.core.dest));
});

gulp.task('bootstrap:compile:less', function () {
    gulp.src(files.css.bootstrap.src)
        .pipe(plugins.plumber())
        .pipe(plugins.less({compress: minify}))
        .pipe(plugins.if(minify, plugins.minifyCss({
            keepBreaks: false,
            keepSpecialComments: 0
        })))
        .pipe(gulp.dest(files.css.bootstrap.dest));
});
