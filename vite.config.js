import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.jsx',
                'resources/sass/app.scss',
                'resources/sass/dashboard.scss',
            ],
            refresh: true,
        }),
        react(),
    ],
    build: { chunkSizeWarningLimit: 2000 },
});
