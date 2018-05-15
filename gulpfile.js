var argv         = require('minimist')(process.argv.slice(2));
var gulp         = require('gulp');
var del          = require('del');
var rename       = require('gulp-rename');
var sass         = require('gulp-sass');
var postcss      = require('gulp-postcss');
var pixrem       = require('pixrem');
var autoprefixer = require('autoprefixer');
var flexibility  = require('postcss-flexibility');
var cssmin       = require('gulp-cssmin');
var browserSync  = require('browser-sync').create();

require('dotenv').config();

const DIST = [
    '**',
    '!.**',
    '!dist{,/**}',
    '!node_modules{,/**}',
    '!sass{,/**}',
    '!src{,/**}',
    '!gulpfile.js',
    '!package.json',
    '!package-lock.json'
];

gulp.task('clean', function() {
    return del(['css/', 'dist/']);
});

gulp.task('sass', function() {
    var postCSSplugins = [
        require('postcss-flexibility'),
        pixrem(),
        autoprefixer({browsers: ['> 1%', 'last 3 versions', 'ie 8-10', 'not ie <= 7']})
    ];
    return gulp.src('sass/*.scss')
    .pipe(sass({
        includePaths: 'sass',
        outputStyle: 'expanded'
    }).on('error', sass.logError))
    .pipe(postcss(postCSSplugins))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
});

gulp.task('css', gulp.series('sass', function() {
    return gulp.src(['css/*.css', '!css/*.min.css'])
    .pipe(cssmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
}));

gulp.task('dist', function() {
    return gulp.src(DIST)
    .pipe(gulp.dest('dist/'));
});

gulp.task('default', function() {
    browserSync.init({
        ui: false,
        notify: false,
        online: false,
        open: false,
        host: argv.URL || 'localhost',
        proxy: argv.URL || 'localhost',
    });

    gulp.watch('sass/**/*.scss', gulp.series('sass'));

    gulp.watch('**/*.php').on('change', browserSync.reload);
});

gulp.task('build', gulp.series('clean', (argv.production) ? gulp.series('css', 'dist') : gulp.series('sass')));
