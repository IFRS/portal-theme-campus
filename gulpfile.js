var gulp         = require('gulp');
var gutil        = require('gulp-util');
var del          = require('del');
var rename       = require('gulp-rename');
var sass         = require('gulp-sass');
var postcss      = require('gulp-postcss');
var pixrem       = require('pixrem');
var autoprefixer = require('autoprefixer');
var flexibility  = require('postcss-flexibility');
var cssmin       = require('gulp-cssmin');
var imagemin     = require('gulp-imagemin');
var runSequence  = require('run-sequence');
var browserSync  = require('browser-sync').create();

require('dotenv').config();

var dist = [
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

gulp.task('default', function() {
    browserSync.init({
        ui: false,
        notify: false,
        online: false,
        open: false,
        host: process.env.BROWSERSYNC_URL,
        proxy: process.env.BROWSERSYNC_URL,
    });

    gulp.watch('sass/**/*.scss', ['sass']);

    gulp.watch('src/**/*.js', ['webpack']);

    gulp.watch('**/*.php').on('change', browserSync.reload);
});

gulp.task('build', ['clean'], function(done) {
    if (gutil.env.production) {
        runSequence(['css', 'images'], 'dist', done);
    } else {
        runSequence(['sass'], done);
    }
});

gulp.task('clean', function() {
    return del(['css/', 'js/', 'dist/']);
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

gulp.task('css', ['sass'], function() {
    return gulp.src(['css/*.css', '!css/*.min.css'])
    .pipe(cssmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
});

gulp.task('images', function() {
    return gulp.src('img/*.{png,jpg,gif}')
    .pipe(imagemin())
    .pipe(gulp.dest('img/'));
});

gulp.task('dist', function() {
    return gulp.src(dist)
    .pipe(gulp.dest('dist/'));
});
