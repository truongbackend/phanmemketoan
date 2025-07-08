import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
            host: 'pnl-international.info.vn',
            port: 80,
            strictPort: true,
            https: false,
    },
    plugins: [
        laravel(['resources/js/app.js',
    ]),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },

        }),

    ],

});
