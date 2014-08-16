var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('css', function(){
	gulp.src('app/assets/sass/**/*.scss')
		.pipe(sass())
		.pipe(autoprefixer('last 10 version'))
		.pipe(gulp.dest('public/css'));
});

gulp.task('js', function(){
	gulp.src('app/assets/js/**/*.js')
		.pipe(gulp.dest('public/js'));
});

gulp.task('watch', function(){
	gulp.watch('app/assets/sass/**/*.scss', ['css']);
	gulp.watch('app/assets/js/**/*.js', ['js']);
});

gulp.task('default', ['watch']);