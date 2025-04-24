import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
<<<<<<< HEAD
import tailwindcss from '@tailwindcss/vite';
=======
>>>>>>> 5636c5d13ba2b4d9ccada4d832aebbe4053e63f7

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
<<<<<<< HEAD
        tailwindcss(),
=======
>>>>>>> 5636c5d13ba2b4d9ccada4d832aebbe4053e63f7
    ],
});
