let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');

require('laravel-mix-tailwind');
require('laravel-mix-purgecss');

mix.js('resources/js/app.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css', [
    tailwindcss('./tailwind.js'),
  ])
  .tailwind()
  .purgeCss();
