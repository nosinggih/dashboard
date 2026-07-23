import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/modules/chart-loader.js', 'resources/js/modules/date-picker.js'],
            refresh: true,
        }),
    ],
});
