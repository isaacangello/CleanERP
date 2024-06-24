import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                // 'node_modules/node-waves/dist/waves.min.css',
                // 'resources/web/materialize/css/materialize.css',
                // 'resources/web/jquery-ui/jquery-ui.css',
                // 'node_modules/animate.css/animate.css',
                // 'resources/web/systheme/css/themes/all-themes.css',
                // 'resources/web/custom/mobile.css',
                // 'resources/web/systheme/css/style.css',
                'resources/js/app.js',
                // 'resources/web/jquery/jquery-3.7.1.min.js',
                // 'resources/web/jquery-ui/jquery-ui.js',
                // 'resources/web/materialize/js/materialize.min.js',
                // 'node_modules/node-waves/dist/waves.min.js',
                // 'resources/web/systheme/plugins/jquery-slimscroll/jquery.slimscroll.js',
                // 'resources/web/systheme/plugins/jquery-validation/jquery.validate.js',
                // 'resources/web/systheme/plugins/jquery-steps/jquery.steps.js',
                // 'node_modules/sweetalert2/dist/sweetalert2.all.min.js',
                // 'resources/web/systheme/js/admin.js',
                // 'resources/web/systheme/js/pages/index.js',
                // 'resources/web/systheme/js/pages/forms/form-validation.js',
                // 'resources/web/systheme/js/demo.js',
                // 'resources/web/systheme/js/systheme.js',
                // 'node_modules/moment/min/moment.min.js',
                // 'resources/web/custom/service_cad.js',
                // 'resources/web/custom/field_change.js',
                // 'resources/web/custom/modalPush.js',
            ],
            refresh: true,
        }),
    ],
});
