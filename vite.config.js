import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/panel.css',
                'resources/js/panel.js',
                'resources/css/web.css',
                'resources/js/web.js',
                'resources/css/auth.css',
                'resources/js/auth.js',
            ],
            refresh: true,
        }),
    ],
});
