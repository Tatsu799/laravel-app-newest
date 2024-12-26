import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/bootstrap.js",
                "resources/js/deletePost.js",
                "resources/js/getPostsData.js",
                "resources/js/likeHandler.js",
                "resources/js/login.js",
                "resources/js/logout.js",
                "resources/js/postData.js",
                "resources/js/registerUser.js",
                "resources/js/updateData.js",
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true, // 必須: 本番環境でアセットを参照するため
    },
});
