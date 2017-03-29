var gulp = require('gulp');
var less = require('gulp-less');

gulp.task('less', function() {
    gulp.src('src/AppBundle/Resources/public/less/*.less')
        .pipe(less())
        .pipe(gulp.dest('web/bundles/app/css'));
});

gulp.task('watchless', function(){
    gulp.watch('src/AppBundle/Resources/public/less/*.less', ['less']);
});

gulp.task('default', ['watchless']);