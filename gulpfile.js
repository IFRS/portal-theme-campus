const argv         = require('minimist')(process.argv.slice(2));
const autoprefixer = require('autoprefixer');
const browserSync  = require('browser-sync').create();
const csso         = require('gulp-csso');
const del          = require('del');
const gulp         = require('gulp');
const pixrem       = require('pixrem');
const postcss      = require('gulp-postcss');
const sass         = require('gulp-sass')(require('sass'));
const sourcemaps   = require('gulp-sourcemaps');

const proxyURL = argv.URL || argv.url || 'localhost';

gulp.task('clean', async function() {
    return await del(['css/', 'dist/']);
});

gulp.task('sass', function() {
    var postCSSplugins = [
        require('postcss-flexibility'),
        pixrem(),
        autoprefixer()
    ];
    return gulp.src('sass/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({
        includePaths: ['sass', 'node_modules'],
        outputStyle: 'expanded',
        precision: 6
    }).on('error', sass.logError))
    .pipe(postcss(postCSSplugins))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
});

gulp.task('styles', gulp.series('sass', function css() {
    return gulp.src(['css/*.css'])
    .pipe(csso())
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
}));

gulp.task('dist', function() {
    return gulp.src([
        '**',
        '!.**',
        '!dist{,/**}',
        '!node_modules{,/**}',
        '!sass{,/**}',
        '!src{,/**}',
        '!gulpfile.js',
        '!package.json',
        '!package-lock.json'
    ])
    .pipe(gulp.dest('dist/'));
});

if (argv.production) {
    gulp.task('build', gulp.series('clean', 'styles', 'dist'));
} else {
    gulp.task('build', gulp.series('clean', 'sass'));
}

gulp.task('default', gulp.series('build', function watch() {
    browserSync.init({
        ghostMode: false,
        notify: false,
        online: false,
        open: false,
        host: proxyURL,
        proxy: proxyURL,
    });

    gulp.watch('sass/**/*.scss', gulp.series('sass'));

    gulp.watch('**/*.php').on('change', browserSync.reload);
}));
