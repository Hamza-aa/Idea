import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    build: {
        // lightningcss (Vite/Tailwind v4's default CSS minifier) doesn't support
        // CSS custom properties inside @media conditions, which Tailwind v4 generates
        // for responsive breakpoints (e.g. @media (min-width: var(--breakpoint-md))).
        // esbuild is no longer bundled in Vite 8 (replaced by Rolldown/Oxc), so we
        // can't switch minifiers — instead, disable CSS minification entirely.
        cssMinify: false,
    },
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
