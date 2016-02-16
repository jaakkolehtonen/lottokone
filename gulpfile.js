var gulp = require('gulp'),
    autoprefixer = require('gulp-autoprefixer'),
    connect = require('gulp-connect-php'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync');

gulp.task('serve', function() {
  connect.server({
    base: 'app'
  }, function (){
    browserSync({
      proxy: '127.0.0.1:8000'
    });
  });

  gulp.watch("app/scss/*.scss", ['sass']);
  gulp.watch('app/*.php').on('change', function () {
    browserSync.reload();
  });
});

gulp.task('sass', function() {
  return gulp.src("app/scss/*.scss")
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(gulp.dest("app/css"))
    .pipe(browserSync.stream());
});

gulp.task('default', ['serve']);
