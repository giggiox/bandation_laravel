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

mix.sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'public/css/scripts/bootstrap.min.css',
    'public/css/scripts/slick.css',
    'public/css/scripts/slick-theme.css',
    'public/css/scripts/jquery.fancybox.css',
    'public/css/scripts/tagsinput.css',

    'public/css/mycss/welcome.css',
    'public/css/mycss/group.css',
    'public/css/mycss/user.css'
],'public/css/app.css');

mix.scripts([
    'resources/js/scripts/jquery.min.js',
    'resources/js/scripts/jquery-ui.min.js',
    'resources/js/scripts/popper.min.js',
    'resources/js/scripts/bootstrap.min.js',
    'resources/js/scripts/slick.min.js',
    'resources/js/scripts/sweetalert2.all.js',
    'resources/js/scripts/jquery.fancybox.js',
    'resources/js/scripts/tagsinput.js',

    'resources/js/myjs/welcome.js',
    'resources/js/myjs/group.js',
    'resources/js/myjs/user.js'

],'public/js/app.js');
