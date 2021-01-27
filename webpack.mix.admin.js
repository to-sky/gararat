let mix = require('laravel-mix');

mix.js('resources/js/admin.js', 'public/dashboard')
    .sass('resources/sass/admin/main.scss', 'public/dashboard/admin.css')
    .copyDirectory('resources/sass/admin/vendor/static/images','public/dashboard/vendor/images')
    .copy('node_modules/tinymce/skins', 'public/dashboard/vendor/tinymce/skins')
    .sourceMaps();
