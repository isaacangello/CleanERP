import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // 'resources/css/app.css',
                // 'resources/fa6/pro/css/all.css',
                'resources/js/app.js',
                // 'resources/fa6/pro/js/all.js',
            ],
            refresh: true,
        }),
    ],
});
