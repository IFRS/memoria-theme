const argv         = require('minimist')(process.argv.slice(2));
const autoprefixer = require('autoprefixer');
const babel        = require('gulp-babel');
const browserSync  = require('browser-sync').create();
const cssmin       = require('gulp-cssmin');
const concat       = require('gulp-concat');
const del          = require('del');
const gulp         = require('gulp');
const imagemin     = require('gulp-imagemin');
const path         = require('path');
const pixrem       = require('pixrem');
const PluginError  = require('plugin-error');
const postcss      = require('gulp-postcss');
const sass         = require('gulp-sass');
const through2     = require('through2');
const uglify       = require('gulp-uglify');
const webpack      = require('webpack');

const dist = [
    '**',
    '!dist{,/**}',
    '!node_modules{,/**}',
    '!sass{,/**}',
    '!src{,/**}',
    '!.**',
    '!docker-compose.override.yml',
    '!docker-compose.yml',
    '!Dockerfile',
    '!gulpfile.js',
    '!package-lock.json',
    '!package.json'
];

const postCSSplugins = [
    pixrem(),
    autoprefixer()
];

const webpackMode = argv.production ? 'production' : 'development';

var webpackPlugins = [];
argv.bundleanalyzer ? webpackPlugins.push(new BundleAnalyzerPlugin()) : null;

gulp.task('clean', function() {
    return del(['css/', 'js/', 'dist/']);
});

gulp.task('sass', function() {
    return gulp.src('sass/*.scss')
    .pipe(sass({
        includePaths: 'sass',
        outputStyle: 'expanded'
    }).on('error', sass.logError))
    .pipe(postcss(postCSSplugins))
    .pipe((argv.debug) ? debug({title: 'SASS:'}) : through2.obj())
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
});

gulp.task('vendor-css', function() {
    return gulp.src(['node_modules/@fancyapps/fancybox/dist/jquery.fancybox.css', 'node_modules/animate.css/animate.css'])
    .pipe(concat('vendor.css'))
    .pipe(postcss(postCSSplugins))
    .pipe((argv.debug) ? debug({title: 'CSS:'}) : through2.obj())
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
});

gulp.task('styles', gulp.series('sass', 'vendor-css', function css() {
    return gulp.src(['css/*.css'])
    .pipe(cssmin())
    .pipe((argv.debug) ? debug({title: 'CSS:'}) : through2.obj())
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
}));

gulp.task('webpack', function(done) {
    webpack({
        mode: webpackMode,
        entry: {
            ie: './src/ie.js',
            memoria: './src/memoria.js'
        },
        output: {
            path: path.resolve(__dirname, 'js'),
            filename: '[name].js',
        },
        resolve: {
            alias: {
                jquery: 'jquery/src/jquery',
                bootstrap: 'bootstrap/dist/js/bootstrap.bundle'
            }
        },
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery'
            })
        ],
        optimization: {
            minimize: false
        },
        plugins: webpackPlugins,
    }, function(err, stats) {
        if (err) throw new PluginError('webpack', {
            message: stats.toString({
                colors: true
            })
        });
        browserSync.reload();
        done();
    });
});

gulp.task('scripts', gulp.series('webpack', function js() {
    return gulp.src(['js/*.js'])
    .pipe(babel({
        presets: ['@babel/env']
    }))
    .pipe(uglify({
        ie8: true
    }))
    .pipe((argv.debug) ? debug({title: 'JS:'}) : through2.obj())
    .pipe(gulp.dest('js/'))
    .pipe(browserSync.stream());
}));

gulp.task('images', function() {
    return gulp.src('img/*.{png,jpg,gif}')
    .pipe(imagemin())
    .pipe((argv.debug) ? debug({title: 'Images:'}) : through2.obj())
    .pipe(gulp.dest('img/'));
});

gulp.task('dist', function() {
    return gulp.src(dist)
    .pipe((argv.debug) ? debug({title: 'Dist:'}) : through2.obj())
    .pipe(gulp.dest('dist/'));
});

if (argv.production) {
    gulp.task('build', gulp.series('clean', gulp.parallel('styles', 'scripts', 'images'), 'dist'));
} else {
    gulp.task('build', gulp.series('clean', gulp.parallel('sass', 'vendor-css', 'webpack')));
}

gulp.task('default', gulp.series('build', function watch() {
    browserSync.init({
        ghostMode: false,
        notify: false,
        online: false,
        open: false,
        host: argv.URL || 'localhost',
        proxy: argv.URL || 'localhost',
    });

    gulp.watch('sass/**/*.scss', gulp.series('sass'));

    gulp.watch('src/**/*.js', gulp.series('webpack'));

    gulp.watch('**/*.php').on('change', browserSync.reload);
}));
