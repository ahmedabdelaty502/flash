let gulpfile = require("gulp");
let livereload = require("gulp-livereload");
let autoprefixer = require("gulp-autoprefixer");
let rename = require("gulp-rename");
let sourcemaps = require("gulp-sourcemaps");
const sass = require("gulp-sass")(require("sass"));
async function styles() {
  return (
    gulpfile
      .src("scss/style.scss")
      // .src("scss/tables/views-table-styling.scss")
      .pipe(sourcemaps.init().on("error", sass.logError))
      .pipe(sass())
      .pipe(autoprefixer())
      .pipe(sourcemaps.write())
      // .pipe(rename("views-table-styling.css"))
      .pipe(rename("style.css"))
      // .pipe(gulpfile.dest("css/tables"))
      .pipe(gulpfile.dest("css"))
      .pipe(livereload())
  );
}

async function scripts() {
  gulpfile.src("js/priceTags/*.js").pipe(livereload());
}

async function twig() {
  gulpfile.src("templates/*.twig").pipe(livereload());
}

async function watch() {
  livereload.listen();
  gulpfile.watch("scss/**/*.scss", styles);
  gulpfile.watch("js/**/*.js", scripts);
  gulpfile.watch("templates/**/*.twig", twig);
}

exports.default = gulpfile.series(styles, scripts, watch);
