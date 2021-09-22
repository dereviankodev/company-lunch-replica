const mix = require('laravel-mix');

mix
    .setPublicPath('public/build/main')
    .setResourceRoot('/build/main')
    .js('resources/js/main/app.js', '/main/js')
    .css('resources/css/main/app.css', '/main/css')
    .version();