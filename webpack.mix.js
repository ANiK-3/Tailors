/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

const mix = require("laravel-mix");

mix.browserSync({
    proxy: "http://127.0.0.1:8000",
});

const Dotenv = require("dotenv-webpack");
// require('dotenv').config();

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/bootstrap.js", "public/js")
    .js("resources/js/echo.js", "public/js")
    .js("resources/js/home.js", "public/js")
    .js("resources/js/navbar.js", "public/js")
    .js("resources/js/register.js", "public/js")
    .js("resources/js/profile.js", "public/js")
    .js("resources/js/update_password.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/home.scss", "public/css")
    .sass("resources/sass/navbar.scss", "public/css")
    .sass("resources/sass/about_us.scss", "public/css")
    .sass("resources/sass/show_tailor.scss", "public/css")
    .sass("resources/sass/login.scss", "public/css")
    .sass("resources/sass/register.scss", "public/css")
    .sass("resources/sass/profile.scss", "public/css")
    .webpackConfig({
        stats: {
            children: true,
        },
        plugins: [
            new Dotenv({
                path: "./.env", // Path to .env file
            }),
        ],
    })
    .options({
        processCssUrls: false,
    });

if (mix.inProduction) {
    mix.version();
}
