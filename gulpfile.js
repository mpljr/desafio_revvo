const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const uglify = require('gulp-uglify');
const browserSync = require('browser-sync').create();

// Diretórios
const paths = {
  styles: {
    src: 'src/assets/scss/**/*.scss',
    dest: 'src/assets/css'
  },
  scripts: {
    src: ['src/assets/js/*.js', '!src/assets/js/*.min.js'], // Exclui arquivos já minificados
    dest: 'src/assets/js/dist' // Novo diretório para arquivos minificados
  }
};

// Compile SCSS
function styles() {
  return gulp.src(paths.styles.src)
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(cleanCSS())
    .pipe(gulp.dest(paths.styles.dest))
    .pipe(browserSync.stream());
}

// Minify JS
function scripts() {
  return gulp.src(paths.scripts.src)
    .pipe(uglify())
    .pipe(gulp.dest(paths.scripts.dest))
    .pipe(browserSync.stream());
}

// Watch files
function watch() {
  browserSync.init({
    proxy: "localhost:8080",
    notify: false
  });

  gulp.watch(paths.styles.src, styles);
  gulp.watch(paths.scripts.src, scripts);
  gulp.watch('src/**/*.php').on('change', browserSync.reload);
}

// Build task
const build = gulp.parallel(styles, scripts);

// Default task
exports.default = gulp.series(build, watch);
exports.build = build;