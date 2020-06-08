const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .browserSync({
    proxy: "localhost:8080", // アプリの起動アドレス
    open: false, // ブラウザを自動で開かない
  })
  .js("resources/js/index.js", "public/assets/js");
