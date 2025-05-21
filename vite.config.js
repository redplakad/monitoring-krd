import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                //'resources/css/filament/admin/theme.css',
                //'resources/js/filament-chart-js-plugins.js', // Include the new file in the `input` array so it is built
            ],
            refresh: [
                'resources/views/**',
                'resources/js/**',
                'resources/css/**',
                'app/Livewire/**',
                'app/View/Components/**',
                'routes/**',
                'app/Livewire/**',
            ],
        }),
        tailwindcss(),
    ],
});
