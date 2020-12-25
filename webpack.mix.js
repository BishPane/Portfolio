const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
// mix.js('resources/js/jquery.min.js', 'public/js');
// mix.js('resources/js/adminlte.min.js', 'public/js');

mix.js([
            'resources/js/app.js', 'resources/js/jquery.min.js'
        ],
        'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);

// mix.js(['resources/js/app.js', 'resource/js/bootstrap.js', 'resource/js/adminlte.min.js'], 'public/js');

mix.styles([

    'public/css/adminlte.min.css',
    'public/css/all.min.css',




], 'public/css/all.css');