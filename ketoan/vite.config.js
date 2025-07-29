import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import vue from '@vitejs/plugin-vue';
import Components from 'unplugin-vue-components/vite';
import { AntDesignVueResolver } from 'unplugin-vue-components/resolvers';

export default defineConfig({
    server: {
        host: 'localhost',
        port: 5173,
        strictPort: false,
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
        Components({
            resolvers: [AntDesignVueResolver()],
        }),

    ],

});
