/* var gulp = require('gulp'); */
var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.sass([
        'app.scss',
        '!components/*.scss'
    ]);

    //mix.browserify('base.js');

    mix.browserify([
        'filter.js'
    ]);

    /*mix.scripts([
        'dragndrop.js',
        'filter.js'
    ]);*/

});
