const mix = require('laravel-mix');

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

// admins dashboard app
mix.js('resources/js/usersDashboards/admin/app.js', 'public/js/dashboards/admin')
.vue({
    options: {
      compilerOptions: {
        isCustomElement: (tag) => ['md-linedivider'].includes(tag),
      },
    },
});

// // recorded users dashboard app
// mix.js('resources/js/usersDashboards/recorded/app.js', 'public/js/dashboards/recorded')
// .vue();

// // ietls users dashboard app
// mix.js('resources/js/usersDashboards/ietls/app.js', 'public/js/dashboards/ietls')
// .vue();

// // zoom users dashboard app
// mix.js('resources/js/usersDashboards/zoom/app.js', 'public/js/dashboards/zoom')
// .vue();
