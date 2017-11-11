let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .copy([
        'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
        'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css'
    ], 'public/js/libs/bootstrap-datepicker/')
    .copy([
        'node_modules/timepicker/jquery.timepicker.min.js',
        'node_modules/timepicker/jquery.timepicker.min.css'
    ], 'public/js/libs/timepicker/')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/**','public/fonts/vendor/bootstrap-sass/bootstrap');