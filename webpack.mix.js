const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'js')
   .js('resources/js/backend/js/all.js', 'js')
   .sass('resources/sass/backend/css/all.scss', 'css')
   .sass('resources/sass/backend/css/login.scss', 'css')
   .sass('resources/sass/app.scss', 'css')
   .version()
   .sourceMaps();