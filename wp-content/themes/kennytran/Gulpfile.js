(() => {
    'use strict';

    const settings = {
        browserSync: false
    };

    const devBuild =
        (process.env.NODE_ENV || 'development').trim().toLowerCase() ===
        'development';

    const paths = {
        assets: 'assets',
        fonts: 'assets/fonts',
        images: 'assets/images',
        scripts: 'assets/scripts',
        styles: 'assets/styles',
        svgs: 'assets/svgs',
    };

    const gulp = require('gulp');
    const browserSync = require('browser-sync').create();
    const combineMedia = require('gulp-combine-media');
    const concat = require('gulp-concat');
    const del = require('del');
    const filter = require('gulp-filter');
    const flatmap = require('gulp-flatmap');
    const imagemin = require('gulp-imagemin');
    const jshint = require('gulp-jshint');
    const merge = require('merge-stream');
    const minify = require('gulp-minify');
    const newer = require('gulp-newer');
    const noop = require('gulp-noop');
    const postcss = require('gulp-postcss');
    const rename = require('gulp-rename');
    const sass = require('gulp-sass');
    const sassGlob = require('gulp-sass-glob');
    const size = require('gulp-size');
    const stylish = require('jshint-stylish');
    const sourcemaps = require('gulp-sourcemaps');
    const stripDebug = require('gulp-strip-debug');

    console.log('Gulp', devBuild ? 'development' : 'production', 'build');

    /***************************************************************************
    //
    // #CLEAN
    //
    ***************************************************************************/

    function clean() {
        return del([
            paths.images + '/compressed/*',
            paths.scripts + '/*.map',
            paths.scripts + '/*.min.js',
            paths.styles + '/*.map',
            paths.styles + '/*.min.css',
            paths.svgs + '/compressed/*',
        ]);
    }
    exports.clean = gulp.series(clean);

    /***************************************************************************
    //
    // #IMAGES
    //
    ***************************************************************************/

    function images() {
        const images = gulp
            .src(paths.images + '/*.{gif,jpg,png}')
            .pipe(newer(paths.images + '/compressed'))
            .pipe(
                imagemin({
                    optimizationLevel: 7,
                })
            )
            .pipe(
                size({
                    showFiles: true,
                })
            )
            .pipe(gulp.dest(paths.images + '/compressed'));

        const svgs = gulp
            .src(paths.svgs + '/*.svg')
            .pipe(newer(paths.svgs + '/compressed'))
            .pipe(
                imagemin([
                    imagemin.svgo({
                        plugins: [
                            { removeViewBox: true },
                            { cleanupIDs: false },
                        ],
                    }),
                ])
            )
            .pipe(
                size({
                    showFiles: true,
                })
            )
            .pipe(gulp.dest(paths.svgs + '/compressed'));

        return merge(images, svgs);
    }
    exports.images = gulp.series(images);

    /***************************************************************************
    //
    // #SCRIPTS
    //
    ***************************************************************************/

    function scripts() {
        const plugins = filter('!0-plugins', { restore: true });

        return gulp.src(paths.scripts + '/*').pipe(
            flatmap(function (stream, file) {
                if (file.isDirectory()) {
                    return gulp
                        .src(file.path + '/**/*.js')
                        .pipe(plugins)
                        .pipe(jshint())
                        .pipe(jshint.reporter(stylish))
                        .pipe(plugins.restore)
                        .pipe(!devBuild ? sourcemaps.init() : noop())
                        .pipe(concat(file.relative + '.js'))
                        .pipe(!devBuild ? stripDebug() : noop())
                        .pipe(devBuild ? rename({ suffix: '.min' }) : noop())
                        .pipe(!devBuild ? minify(
                            {
                                ext:{
                                    min:'.min.js'
                                },
                                noSource: true
                            }
                        ) : noop())
                        .pipe(!devBuild ? sourcemaps.write('.') : noop())
                        .pipe(gulp.dest(paths.scripts))
                        .pipe(!settings.browserSync ? browserSync.stream() : noop());
                }
                return stream;
            })
        );
    }
    exports.scripts = gulp.series(scripts);

    /***************************************************************************
    //
    // #STYLES
    //
    ***************************************************************************/

    function styles() {
        let postcssPlugins = [
            require('autoprefixer'),
            require('postcss-sort-media-queries'),
            !devBuild ? require('cssnano') : false,
        ].filter(Boolean);

        return gulp.src(paths.styles + '/*').pipe(
            flatmap(function (stream, file) {
                if (file.isDirectory()) {
                    return gulp
                        .src(file.path + '/*.scss')
                        .pipe(!devBuild ? sourcemaps.init() : noop())
                        .pipe(sassGlob())
                        .pipe(
                            sass({
                                errLogToConsole: true,
                                precision: 3,
                            }).on('error', sass.logError)
                        )
                        .pipe(combineMedia())
                        .pipe(postcss(postcssPlugins))
                        .pipe(rename({ suffix: '.min' }))
                        .pipe(!devBuild ? sourcemaps.write('.') : noop())
                        .pipe(size({ showFiles: true }))
                        .pipe(gulp.dest(paths.styles))
                        .pipe(!settings.browserSync ? browserSync.stream() : noop());
                }
                return stream;
            })
        );
    }
    exports.styles = gulp.series(styles);

    /***************************************************************************
    //
    // #RELOAD
    //
    ***************************************************************************/

    function reload(done) {
        browserSync.reload();
        done();
    }

    /***************************************************************************
    //
    // #WATCH
    //
    ***************************************************************************/

    function watch() {
        !settings.browserSync
            ?
                browserSync.init({
                    browser: 'google chrome',
                    proxy: 'dev.kennytran.com',
                })
            :
                noop();
        gulp.watch('**/*.php', reload);
        gulp.watch(paths.assets + '/**/*.scss', gulp.series(styles, reload));
        gulp.watch(
            [paths.assets + '/**/*.js', '!' + paths.assets + '/**/*.min.js'],
            gulp.series(scripts, reload)
        );
    }
    exports.watch = gulp.series(watch);

    /***************************************************************************
    //
    // #TASKS
    //
    ***************************************************************************/

    exports.build = gulp.series(clean, images, scripts, styles);
    exports.develop = gulp.series(images, scripts, styles, watch);
})();
