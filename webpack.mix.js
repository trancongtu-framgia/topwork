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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.scripts(
    [
        'resources/assets/admin/js/scripts.bundle.js',
        'resources/assets/admin/js/vendors.bundle.js',
    ], 'public/assets/admin/js/app_admin.js');

mix.scripts(
    'resources/assets/admin/fonts/webfont.js', 'public/assets/admin/fonts/webfont.js');

mix.styles(
    [
        'resources/assets/admin/css/style.bundle.css',
        'resources/assets/admin/css/vendors.bundle.css',
        'resources/assets/admin/css/admin_style.css'
    ], 'public/assets/admin/css/app_admin.css');

mix.copyDirectory('resources/assets/admin/image', 'public/assets/admin/images');
mix.copyDirectory('resources/assets/admin/fonts', 'public/assets/admin/fonts');
