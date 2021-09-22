const mix = require('laravel-mix');

mix
    .setPublicPath('public/build/base')
    .setResourceRoot('/build/base')
    .js('resources/js/base/app.js', '/base/js')
    .postCss('resources/css/base/app.css', '/base/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .version();