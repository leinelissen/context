const { mix } = require("laravel-mix");
const FriendlyErrorsWebpackPlugin = require("friendly-errors-webpack-plugin");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/assets/js/app.js", "public/js")
    .extract(["vue", "axios", "laravel-echo"])
    .sass("resources/assets/sass/app.scss", "public/css")
    .copyDirectory("resources/assets/images", "public/images")
    .version();

mix.webpackConfig({
    plugins: [
        new FriendlyErrorsWebpackPlugin(),
    ],
    devServer: {
        stats: "minimal",
    },
});
