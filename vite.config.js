import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default ({ mode }) => {
    const env = { ...process.env, ...loadEnv(mode, process.cwd()) };

    return defineConfig({
        base: env.VITE_BASE_URL,
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
            tailwindcss(),
        ],
        server: {
            hmr: {
                host: 'localhost',
            },
        },
    });
};
