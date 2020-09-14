/* eslint-disable */
const { src, dest, series, parallel } = require('gulp')
const babel = require('gulp-babel')
const uglify = require('gulp-uglify')
const sass = require('gulp-sass')
const rename = require('gulp-rename')
const cleanCSS = require('gulp-clean-css')

sass.compiler = require('node-sass')

function compileJS() {
  return src('src/*.js')
    .pipe(babel())
    .pipe(dest('dist'))
    .pipe(uglify())
    .pipe(rename({ extname: '.min.js' }))
    .pipe(dest('dist'))
}

function compileCSS() {
  return src('src/*.sass')
    .pipe(sass().on('error', sass.logError))
    .pipe(dest('css'))
    .pipe(cleanCSS({ compatibility: 'ie8' }))
    .pipe(rename({ extname: '.min.css' }))
    .pipe(dest('css'))
}

exports.default = parallel(compileCSS, compileJS)
