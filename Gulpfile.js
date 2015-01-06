var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var rev = require('gulp-rev');
var del = require('del');
var filename = require('gulp-asset-manifest');
var minifycss = require('gulp-minify-css');

// Paths to your asset files
var paths = {
    frontend: {
        scripts: [
            'app/assets/js/jquery.min.js',
            'app/assets/js/bootstrap.min.js',
            'app/assets/js/moment.min.js',
            'app/assets/js/zh-cn.min.js',
            'app/assets/js/emojify.min.js',
            'app/assets/js/jquery.scrollUp.js',
            'app/assets/js/jquery.pjax.js',
            'app/assets/js/nprogress.js',
            'app/assets/js/jquery.autosize.min.js',
            'app/assets/js/prism.js',
            'app/assets/js/jquery.textcomplete.js',
            'app/assets/js/emoji.js',
            'app/assets/js/marked.min.js',
            'app/assets/js/ekko-lightbox.js',
            'app/assets/js/localforage.min.js',
            'app/assets/js/jquery.inline-attach.min.js',
            'app/assets/js/snowfall.jquery.min.js',
            'app/assets/js/main.js'
        ],
        styles: [
            'app/assets/css/bootstrap.min.css',
            'app/assets/css/font-awesome.min.css',
            'app/assets/css/dist/main.css',
            'app/assets/css/dist/markdown.css',
            'app/assets/css/dist/nprogress.css',
            'app/assets/css/dist/prism.css'
        ]
    }
}

// CSS task
gulp.task('css', function() {

    // Convert scss first
    gulp.src('app/assets/sass/**/*.scss')
        .pipe(sass())
        .pipe(autoprefixer('last 10 version'))
        .pipe(gulp.dest('app/assets/css/dist'));

    // Cleanup old assets
    del(['public/assets/css/styles-*.css'], function (err) {});

    // Prefix, compress and concat the CSS assets
    // Afterwards add the MD5 hash to the filename
    return gulp.src(paths.frontend.styles)
        .pipe(concat('styles.css'))
        .pipe(rev())
        .pipe(filename({ bundleName: 'frontend.styles' })) // This will create/update the assets.json file
        .pipe(minifycss())
        .pipe(gulp.dest('public/assets/css'));
});

// JavaScript task
gulp.task('js', function() {
    // Cleanup old assets
    del(['public/assets/js/scripts-*.js'], function (err) {});

    // Concat and uglify the JavaScript assets
    // Afterwards add the MD5 hash to the filename
    return gulp.src(paths.frontend.scripts)
        .pipe(concat('scripts.js'))
        .pipe(uglify())
        .pipe(rev())
        .pipe(filename({ bundleName: 'frontend.scripts' })) // This will create/update the assets.json file
        .pipe(gulp.dest('public/assets/js'));
});

gulp.task('build', ['css', 'js']);

gulp.task('watch', ['build'],  function(){
    gulp.watch('app/assets/sass/**/*.scss', ['css']);
    gulp.watch('app/assets/css/**/*.css', ['css']);
    gulp.watch('app/assets/js/**/*.js', ['js']);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['watch']);
