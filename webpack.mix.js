let mix = require('laravel-mix');

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

 mix.js('resources/assets/js/app.js', 'public/js')
 .sass('resources/assets/sass/app.scss', 'public/css');

 // mix.styles([
 // 	'public/theme-style/css/core.css',
 // 	'public/theme-style/css/components.css',
 // 	'public/theme-style/css/menu.css',
 // 	'public/theme-style/css/responsive.css',
 // 	'public/theme-style/css/icons.css',
 // 	'public/theme-style/css/pages.css',
 // 	// Select boostrap
 // 	// 'node_modules/bootstrap-select/dist/css/bootstrap-select.css',
 // 	], 'public/css/all.css');

 // mix.js([
 // 	'public/theme-style/js/detect.js',
 // 	'public/theme-style/js/fastclick.js',
 // 	'public/theme-style/js/jquery.slimscroll.js',
 // 	'public/theme-style/js/jquery.blockUI.js',
 // 	'public/theme-style/js/waves.js',
 // 	// 
 // 	// 'node_modules/bootstrap-select/dist/js/bootstrap-select.js',
 // 	], 'public/js/all.js');