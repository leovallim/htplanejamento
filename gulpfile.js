const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const concat = require('gulp-concat');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const concatCss = require('gulp-concat-css');
const cleanCSS = require('gulp-clean-css');

function gulpSass(){
    return  gulp
            .src('src/scss/*.scss')
            .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError) )
            .pipe(autoprefixer({ cascade: false }))
            .pipe(gulp.dest('./'));
}
function gulpJs(){
    return  gulp 
            .src('src/js/*js')
            .pipe(concat('script.js'))
            .pipe(babel({presets: ['@babel/env']}))
            .pipe(uglify())
            .pipe(gulp.dest('./dist/js/'));
}
function gulpPluginsJS(){
    return  gulp 
            .src([
                'node_modules/swiper/swiper-bundle.min.js',
                'node_modules/lightgallery/lightgallery.min.js',
                'node_modules/lightgallery/plugins/thumbnail/lg-thumbnail.min.js',
            ])
            .pipe(concat('plugins.js'))
            .pipe(uglify())
            .pipe(gulp.dest('./dist/js/'));
}
function gulpPluginsCSS(){
    return  gulp 
            .src([
                'node_modules/swiper/swiper-bundle.min.css',
                'node_modules/lightgallery/css/lightgallery-bundle.min.css',
                'node_modules/lightgallery/css/lg-thumbnail.css',
            ])
            .pipe(concatCss('plugins.css'))
            .pipe(cleanCSS({compatibility: 'ie8'}))
            .pipe(gulp.dest('./dist/css/'));
}
function watch(){
    gulp.watch('src/scss/*.scss', gulpSass);
    gulp.watch('src/js/*js', gulpJs);
}

gulp.task('watch', watch);
gulp.task('js', gulpJs);
gulp.task('pluginsJs', gulpPluginsJS);
gulp.task('pluginsCss', gulpPluginsCSS);
gulp.task('sass', gulpSass);
gulp.task('default', gulp.parallel('watch', 'sass', 'js', 'pluginsJs','pluginsCss'));

