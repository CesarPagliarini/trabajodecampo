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

/*
*
* For admin template
*
* */
mix.styles([
    'resources/template/css/bootstrap.min.css',
    'resources/template/css/plugins/datatables/dataTables.css',
    'resources/template/css/animate.css',
    'resources/template/css/table-css/footable.core.css',
    'resources/template/css/style.css',
    'resources/template/css/plugins/toastr/toastr.min.css',
    'resources/template/css/plugins/daterangepicker/dateranger.css',
    'resources/template/css/plugins/select2/select2.css',
    'resources/template/css/plugins/steps/jquery.steps.css',
    'resources/template/css/plugins/touchspin/jquery.bootstrap-touchspin.css',
    'resources/template/css/plugins/switchery/switchery.css',
    'resources/template/css/plugins/timepicker/jquery.timepicker.css',

], 'public/css/panel.css')

.scripts([
    'resources/template/js/plugins/moment/moment.js',
    'resources/template/js/jquery-3.1.1.min.js',
    'resources/template/js/popper.min.js',
    'resources/template/js/bootstrap.min.js',
    'resources/template/js/plugins/jquery-ui/jquery-ui.min',
    'resources/template/js/plugins/metisMenu/jquery.metisMenu.js',
    'resources/template/js/plugins/slimscroll/jquery.slimscroll.min.js',
    'resources/template/js/plugins/table-js/footable.all.min.js',
    'resources/template/js/plugins/table-js/clipboard.min.js',
    'resources/template/js/inspinia.js',
    'resources/template/js/plugins/pace/pace.min.js',
    'resources/template/js/plugins/iCheck/icheck.min.js',
    'resources/template/js/plugins/table-js/common-table.js',
    'resources/template/js/plugins/toastr/toastr.min.js',
    'resources/template/js/plugins/datepicker/bootstrap-datepicker.js',
    'resources/template/js/plugins/summernote/summernote-bs4.js',
    'resources/template/js/plugins/chartJs/Chart.min.js',
    'resources/template/js/plugins/daterangepicker/daterangepicker.js',
    'resources/template/js/plugins/select2/select2.js',
    'resources/template/js/plugins/steps/jquery.steps.js',
    'resources/template/js/plugins/touchspin/jquery.bootstrap-touchspin.js',
    'resources/template/js/plugins/switchery/switchery.js',
    'resources/template/js/plugins/timepicker/jquery.timepicker.js',
], 'public/js/panel.js');

mix.js([
    'resources/js/ajax-forms/admin/bulk-delete.js',
], 'public/js/requests/bulk-delete.js');


mix.js([
    'resources/js/ajax-forms/professional-settings/settings-tab.js',
], 'public/js/professional/settings-tab.js');
mix.js([
    'resources/js/ajax-forms/professional-settings/specialty-tab.js',
], 'public/js/professional/specialty-tab.js');

mix.js([
    'resources/js/ajax-forms/professional-settings/schedules-tab.js',
], 'public/js/professional/schedules-tab.js');








mix.js([
        'resources/js/miscellaneous.js',
        'resources/js/ajax-forms/admin/order-reporter.js'
    ], 'public/js/general.js');
mix.js('resources/js/ajax-forms/admin/rejection-handler.js', 'public/js/reject.js');

mix.styles([
    'resources/template/css/plugins/datepicker/datepicker3.css',
    'resources/template/css/plugins/iCheck/custom.css'
], 'public/css/general.css');


/*
* for front end template
* */

mix.styles([
    'resources/template/css/bootstrap.min.css',
    'resources/template/css/animate.css',
    'resources/template/css/style.css',
    'resources/template/css/plugins/toastr/toastr.min.css',
    'resources/template/css/plugins/datatables/dataTables.css',



], 'public/css/front/front-layout.css')
    .scripts([
        'resources/template/js/jquery-3.1.1.min.js',
        'resources/template/js/popper.min.js',
        'resources/template/js/bootstrap.min.js',
        'resources/template/js/plugins/metisMenu/jquery.metisMenu.js',
        'resources/template/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'resources/template/js/plugins/jquery-ui/jquery-ui.min',
        'resources/template/js/plugins/table-js/footable.all.min.js',
        'resources/template/js/inspinia.js',
        'resources/template/js/plugins/pace/pace.min.js',
        'resources/template/js/plugins/wow/wow.min.js',
        'resources/template/js/plugins/toastr/toastr.min.js',
        'resources/template/js/plugins/iCheck/icheck.min.js',


    ], 'public/js/front/front-layout.js');
mix.js([
    'resources/js/frontend/miscellaneous.js',
    'resources/js/frontend/register-form.js'
] ,'public/js/general-front.js');

mix.js([
    'resources/js/frontend/sales-cart.js',
] ,'public/js/front/sales-cart.js');




