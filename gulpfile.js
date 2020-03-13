const gulp = require("gulp");
const sass = require("gulp-sass");
const uglify = require("gulp-uglify");
const webpackStream = require("webpack-stream");
const webpack = require("webpack");
const webpackConfig = require("./webpack.config");
const minifyImg = require("gulp-imagemin");
const minifyImg_JPG = require("imagemin-jpeg-recompress");
const minifyImg_PNG = require("imagemin-pngquant");
const minifyImg_GIF = require("imagemin-gifsicle");


gulp.task("watch", () => {
  return (gulp.watch("src/scss/*.scss", () => {
    return (
      gulp.src("src/scss/main.scss")
        .pipe(sass())
        .pipe(gulp.dest("dist"))
    );
  }));
});

gulp.task("minify-img", () => {
  return (
    gulp.src("src/img/*.+(jpg|jpeg|png|gif)")
      .pipe(minifyImg([minifyImg_JPG(), minifyImg_PNG(), minifyImg_GIF()]))
      .pipe(gulp.dest("dist"))
  );
});

gulp.task("webpack", () => {
  return webpackStream(webpackConfig, webpack)
    .pipe(gulp.dest("dist"));
});

gulp.task("default", gulp.series("webpack", "watch", function (done) {
  done();
}));