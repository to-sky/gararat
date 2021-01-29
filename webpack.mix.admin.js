let mix = require('laravel-mix');

mix.js('resources/js/admin.js', 'public/js')
    .sass('resources/sass/admin/admin.scss', 'public/css')
    .sourceMaps();
