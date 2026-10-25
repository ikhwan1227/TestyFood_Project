import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        // Ganti dari 'esbuild' ke 'oxc' (default Vite 8)
        minify: 'oxc',
        target: 'es2020',
        chunkSizeWarningLimit: 1000,
        sourcemap: false,
        cssCodeSplit: true,
    },
});