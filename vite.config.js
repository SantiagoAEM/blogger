import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
        host: 'blogger.tester', 

        hmr: {
            host: 'blogger.tester', // Importante para la recarga en caliente
            // Si usas HTTPS, asegúrate de que el protocolo sea el correcto
            // protocol: 'wss', 
        },
    },
});