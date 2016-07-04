var gulp = require('gulp');
var gutil = require('gulp-util');
var bower = require('bower');
var concat = require('gulp-concat');
var sass = require('gulp-sass');
var minifyCss = require('gulp-minify-css');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var sh = require('shelljs');

function swallowError (error) {

  // If you want details of the error in the console
  gutil.log(error.messageFormatted)

  this.emit('end')
}

var paths = {
    sass: ['./resources/assets/scss/*.scss'
    ],
    js: ['./vendor/bower_components/jquery/dist/jquery.js'
                , './vendor/bower_components/Materialize/dist/js/materialize.js'
    ],
    fonts: ['./vendor/bower_components/Materialize/fonts/**/*.*'
                , './vendor/bower_components/Materialize/dist/font/**/*.*'
    ]
};

gulp.task('default', ['sass', 'js', 'fonts', 'watch']);

gulp.task('build', ['sass', 'js']);

gulp.task('sass', function (done) {
    gulp.src(paths.sass)
            .pipe(sass())
            .on('error', swallowError)
            .pipe(concat('app.css'))
            .pipe(gulp.dest('./public/css/'))
            .pipe(minifyCss({
                keepSpecialComments: 0
            }))
            .pipe(rename({extname: '.min.css'}))
            .pipe(gulp.dest('./public/css/'))
            .on('end', done);
});

gulp.task('js', function (done) {
    gulp.src('./vendor/bower_components/livereload-js/dist/livereload.js')
            .pipe(gulp.dest('./public/js'));
    gulp.src(paths.js)
            .pipe(concat('app.js'))
            .pipe(gulp.dest('./public/js/'))
            .pipe(uglify())
            .on('error', swallowError)
            .pipe(rename({extname: '.min.js'}))
            .pipe(gulp.dest('./public/js/'))
            .on('end', done);
});

gulp.task('fonts', function (done) {
    gulp.src(paths.fonts)
            .pipe(gulp.dest('./public/fonts'))
            .on('end', done);
});

gulp.task('watch', function () {
    gulp.watch(paths.sass, ['sass']);
    gulp.watch(paths.js, ['js']);
});

gulp.task('install', ['git-check'], function () {
    return bower.commands.install()
            .on('log', function (data) {
                gutil.log('bower', gutil.colors.cyan(data.id), data.message);
            });
});

gulp.task('git-check', function (done) {
    if (!sh.which('git')) {
        console.log(
                '  ' + gutil.colors.red('Git is not installed.'),
                '\n  Git, the version control system, is required to download Ionic.',
                '\n  Download git here:', gutil.colors.cyan('http://git-scm.com/downloads') + '.',
                '\n  Once git is installed, run \'' + gutil.colors.cyan('gulp install') + '\' again.'
                );
        process.exit(1);
    }
    done();
});
