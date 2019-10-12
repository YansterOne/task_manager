const mix = require('laravel-mix');
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');
require('laravel-mix-sass-resources-loader');

mix.js('resources/js/app.js', 'public/js').
    sass('resources/sass/app.scss', 'public/css').
    sassResources('./resources/sass/_variables.scss').
    webpackConfig({
        plugins: [
            new VuetifyLoaderPlugin(),
        ],
    });
