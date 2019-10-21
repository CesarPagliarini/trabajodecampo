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

mix.styles([
    'resources/template/css/bootstrap.min.css',
    'resources/template/css/plugins/datatables/dataTables.css',
    'resources/template/css/animate.css',
    'resources/template/css/table-css/footable.core.css',
    'resources/template/css/style.css',
    'resources/template/css/plugins/toastr/toastr.min.css',



], 'public/css/panel.css').scripts([
    'resources/template/js/jquery-3.1.1.min.js',
    'resources/template/js/popper.min.js',
    'resources/template/js/bootstrap.min.js',
    'resources/template/js/plugins/metisMenu/jquery.metisMenu.js',
    'resources/template/js/plugins/slimscroll/jquery.slimscroll.min.js',
    'resources/template/js/plugins/table-js/footable.all.min.js',
    'resources/template/js/plugins/table-js/clipboard.min.js',
    'resources/template/js/inspinia.js',
    'resources/template/js/plugins/pace/pace.min.js',
    'resources/template/js/plugins/iCheck/icheck.min.js',
    'resources/template/js/plugins/table-js/common-table.js',
    'resources/template/js/plugins/toastr/toastr.min.js',
], 'public/js/panel.js');

mix.js('resources/js/ajax-forms/admin/users.js', 'public/js/requests/user-form.js');
