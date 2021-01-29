let mix = require('laravel-mix');

mix.options({
    processCssUrls: false
});

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app/app.scss', 'public/css')
    .copyDirectory('resources/fonts/','public/fonts')
    .copyDirectory('resources/images','public/images')
    .copy('node_modules/slider-pro/dist/css/images/*.cur', 'public/images')
    .sourceMaps();
