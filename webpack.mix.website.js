let mix = require('laravel-mix');

mix.options({
    processCssUrls: false
});

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app/main.scss', 'public/css/app.css')
    .copyDirectory('resources/fonts/','public/fonts')
    .copyDirectory('resources/images','public/images')
    .sourceMaps();