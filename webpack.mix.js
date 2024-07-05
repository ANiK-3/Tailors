const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/register.js", "public/js")
    .js("resources/js/profile.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/login.scss", "public/css")
    .sass("resources/sass/register.scss", "public/css")
    .sass("resources/sass/profile.scss", "public/css")
    .options({
        processCssUrls: false,
    });

if (mix.inProduction) {
    mix.version();
}
