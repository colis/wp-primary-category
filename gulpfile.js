// Load dependancies
const gulp         = require('gulp'),
      babel        = require('gulp-babel'),
      sass         = require('gulp-ruby-sass'),
      autoprefixer = require('gulp-autoprefixer'),
      cleanCSS     = require('gulp-clean-css'),
      sourcemaps   = require('gulp-sourcemaps'),
      jshint       = require('gulp-jshint'),
      uglify       = require('gulp-uglify'),
      imagemin     = require('gulp-imagemin'),
      rename       = require('gulp-rename'),
      concat       = require('gulp-concat'),
      cache        = require('gulp-cache'),
      livereload   = require('gulp-livereload'),
      notify       = require('gulp-notify'),
      del          = require('del');

// Process JS
gulp.task('scripts', () =>
  gulp.src('assets/scripts/*.js')
  .pipe(babel({presets: ['env']}))
  .pipe(concat('scripts.js'))
  .pipe(rename({ suffix: '.min' }))
  .pipe(uglify())
  .pipe(jshint())
  .pipe(gulp.dest('dist/scripts'))
  .pipe(notify({ message: 'Scripts completed' }))
);

// Set default task order
gulp.task('default', () => {
	gulp.start( 'scripts' );
});

// Watch for changing files
gulp.task('watch', () => {
	// Watch JS files
	gulp.watch('assets/scripts/*.js', ['scripts']);
});
