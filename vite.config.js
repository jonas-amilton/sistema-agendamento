import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/app.js", "resources/css/app.css"],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js"),
        },
    },
    server: {
        host: "mary-help.local",
        port: 5173,
        strictPort: true,
        hmr: {
            host: "mary-help.local",
        },
    },
});
