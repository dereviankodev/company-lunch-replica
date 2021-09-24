const mix = require('laravel-mix');

mix
    .setPublicPath('public/build/main')
    .setResourceRoot('/build/main')
    .js('resources/js/main/app.js', '/main/js')
    .sass('resources/sass/main/app.scss', '/main/css')
    .sourceMaps()
    .version();