import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
//import pluginTailwindCssNesting from "tailwindcss/nesting";
import pluginTailwindCss from 'tailwindcss';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
  server: {
    hmr: {
      host: 'localhost',
    },
  },
  css: {
    postcss: {
      plugins: [
        //pluginTailwindCssNesting,
        pluginTailwindCss,
      ],
    },
  },
});
