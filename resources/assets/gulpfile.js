var gulp = require('gulp');
var concat = require('gulp-concat');

let dir = __dirname + '/../..';

gulp.task('default', function () {
    gulp.src([
        './node_modules/gentelella/vendors/jquery/dist/jquery.min.js',
        './node_modules/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js',
        './node_modules/gentelella/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js',
        './node_modules/gentelella/build/js/custom.min.js',
        './node_modules/lightbox2/dist/js/lightbox.min.js',
        './node_modules/gentelella/vendors/pnotify/dist/pnotify.js',
        './node_modules/gentelella/vendors/pnotify/dist/pnotify.buttons.js',
        './node_modules/gentelella/vendors/pnotify/dist/pnotify.nonblock.js'
    ])
        .pipe(concat('lib.min.js'))
        .pipe(gulp.dest(`${dir}/public/vendor/` + 'js/'));

    gulp.src([
        './node_modules/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css',
        './node_modules/gentelella/vendors/font-awesome/css/font-awesome.min.css',
        './node_modules/gentelella/vendors/animate.css/animate.min.css',
        './node_modules/gentelella/build/css/custom.min.css',
        './node_modules/gentelella/vendors/pnotify/dist/pnotify.css',
        './node_modules/gentelella/vendors/pnotify/dist/pnotify.buttons.css',
        './node_modules/gentelella/vendors/pnotify/dist/pnotify.nonblock.css',
        './node_modules/lightbox2/dist/css/lightbox.min.css'
    ])
        .pipe(concat('lib.min.css'))
        .pipe(gulp.dest(`${dir}/public/vendor/` + 'css/'));

    gulp.src('./node_modules/lightbox2/dist/images/*.*', {base:'./node_modules/lightbox2/dist'}).pipe(gulp.dest(`${dir}/public/vendor/`));
    gulp.src('./node_modules/gentelella/vendors/font-awesome/fonts/*.*', {base:'./node_modules/gentelella/vendors/font-awesome'}).pipe(gulp.dest(`${dir}/public/vendor/`));
    gulp.src('./node_modules/gentelella/vendors/bootstrap/fonts/*.*', {base:'./node_modules/gentelella/vendors/bootstrap'}).pipe(gulp.dest(`${dir}/public/vendor/`));

});
