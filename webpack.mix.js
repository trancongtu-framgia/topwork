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
        'node_modules/jquery/dist/jquery.js',
        'node_modules/jquery-ui-dist/jquery-ui.js',
        'resources/assets/client/js/bootstrap.js',
        'node_modules/jquery-confirm/dist/jquery-confirm.min.js',
        'resources/views/asset/js/jquery.menu-aim.js',
        'resources/assets/client/js/jquery.countTo.js',
        'resources/assets/client/js/jquery.inview.min.js',
        'resources/assets/client/js/owl.carousel.js',
        'resources/assets/client/js/modernizr.js',
        'resources/assets/client/js/jquery.magnific-popup.js',
        'resources/assets/client/js/custom_II.js',
    ] , 'public/js/app_client.js');

mix.styles(
    [
        'resources/assets/client/css/bootstrap.css',
        'resources/assets/client/css/animate.css',
        'node_modules/font-awesome/css/font-awesome.css',
        'resources/assets/client/css/fonts.css',
        'resources/assets/client/css/reset.css',
        'resources/assets/client/css/owl.carousel.css',
        'resources/assets/client/css/owl.theme.default.css',
        'resources/assets/client/css/flaticon.css',
        'resources/assets/client/css/style_II.css',
        'resources/assets/client/css/responsive2.css',
        'resources/assets/client/css/nav_client.css'
    ], 'public/css/app_client.css');

mix.copyDirectory('resources/assets/client/images', 'public/assets/clients/images');
mix.copyDirectory('node_modules/font-awesome/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/client/fonts', 'public/fonts');

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
