let mix = require('laravel-mix');

mix.js('resources/js/admin.js', 'public/admin')
    .sass('resources/sass/admin/main.scss', 'public/admin/admin.css')
    .copyDirectory('resources/sass/admin/vendor/static/images','public/admin/vendor/images')
    .sourceMaps();