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
  .sass('resources/assets/sass/app.scss', 'public/css');
mix.sass('resources/assets/sass/site.scss', 'public/css');
mix.scripts([
  'resources/assets/js/components/app.js',
  'resources/assets/js/components/inscrit.js',
  "resources/assets/js/components/publication.js",
  "resources/assets/js/components/todo.js"
], 'public/js/all.js');
