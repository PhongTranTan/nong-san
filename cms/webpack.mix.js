let mix = require('laravel-mix');

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

/**
 * Admin css and style
  */
/*
mix.sass('resources/assets/admin/scss/style.scss', 'public/assets/admin/css');
mix.sass('resources/assets/admin/scss/themes/_all-themes.scss', 'public/assets/admin/css');

mix.styles([
    'public/assets/plugins/bootstrap/css/bootstrap.css',
    'public/assets/plugins/node-waves/waves.css',
    'public/assets/plugins/animate-css/animate.css',
    'public/assets/plugins/toastr/toastr.min.css',
    'public/assets/admin/css/style.css',
    'public/assets/admin/css/_all-themes.css',
], 'public/assets/admin/css/app.css');


mix.scripts([
    'public/assets/plugins/jquery/jquery.min.js',
    'public/assets/plugins/bootstrap/js/bootstrap.js',
    'public/assets/plugins/toastr/toastr.min.js',
    'public/assets/plugins/jquery-slimscroll/jquery.slimscroll.js',
    'public/assets/plugins/node-waves/waves.js',
    'public/assets/admin/js/admin.js',
    'public/assets/admin/js/demo.js',
    'public/assets/admin/js/helpers.js',
], 'public/assets/admin/js/app.js');
*/

/*
Nếu cập nhật css auth thì mở nó ra
//ADMIN AUTH
mix.styles([
    'public/assets/plugins/bootstrap/css/bootstrap.css',
    'public/assets/plugins/node-waves/waves.css',
    'public/assets/plugins/animate-css/animate.css',
    'public/assets/admin/css/style.css',
], 'public/assets/admin/css/auth.css');

mix.scripts([
    'public/assets/plugins/jquery/jquery.min.js',
    'public/assets/plugins/bootstrap/js/bootstrap.js',
    'public/assets/plugins/node-waves/waves.js',
    'public/assets/plugins/jquery-validation/jquery.validate.js',
    'public/assets/admin/js/admin.js'
], 'public/assets/admin/js/auth.js');
*/


/**
 * frontend
 */
mix.scripts([
    /** core */
    'public/assets/js/jquery.min.js',
    'public/assets/js/bootstrap.min.js',
    'public/assets/js/plugins.js',
    'public/assets/js/main.js',
    /** end core */
], 'public/assets/js/all.js');