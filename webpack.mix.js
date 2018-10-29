let mix = require('laravel-mix');

require('laravel-mix-tailwind');

mix.js('resources/js/app.js', 'public/js')
  .sass('resources/sass/homepage.scss', 'public/css')
  .sass('resources/sass/app.scss', 'public/css')
  .tailwind();
