const mix = require('laravel-mix');

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

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'window.jQuery': 'jquery',
                Popper: ['popper.js', 'default'],
            })
        ]
    };
});

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin.js', 'public/admin')
    .sass('resources/sass/admin.scss', 'public/admin')
    .sass('resources/sass/app.scss', 'public/css')
    .copyDirectory('resources/sass/admin/vendor/static/images','public/images')
    .copyDirectory('resources/images','public/images')
    .sourceMaps();

