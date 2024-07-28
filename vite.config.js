import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { externalizeDeps } from 'vite-plugin-externalize-deps';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/js/app.js', 'resources/sass/app.scss'],
      refresh: true,
    }),
    externalizeDeps({
        deps: ['axios'],  // Specify the dependencies you want to externalize
    }),
  ],
});
