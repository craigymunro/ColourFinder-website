require('es6-promise').polyfill();

var gulp = require('gulp');
var path = require('path');
var less = require('gulp-less');
var autoprefix = require('gulp-autoprefixer');
var minify = require('gulp-minify-css');
var util = require('gulp-util');

gulp.task('default', function() {

    return gulp.src(['./static/less/**/*.less'])
        .pipe(less())
        .pipe(autoprefix())
        .pipe(minify())
        .pipe(gulp.dest('./static/css'));
});

gulp.task('watch', function() {
    gulp.watch('./static/less/**/*.less', gulp.series('default'));
});
