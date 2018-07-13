var gulp = require('gulp');
var elixir = require('laravel-elixir');
require('laravel-elixir-vue-2');
require('laravel-elixir-webpack-official');

gulp.task('default', function() {
    // place code for your default task here
});

elixir(function(mix) {
    var bpath = 'node_modules/bootstrap-sass/assets';
    var jqueryPath = 'resources/assets/vendor/jquery';
    var vuePath = 'node_modules/vue/dist/vue.js';
    var vueScrollPath = 'node_modules/vue-chat-scroll/dist/vue-chat-scroll.js';
    mix.sass('app.scss', 'public_html/css');
    mix.sass('main.scss','public_html/css');
    mix.sass('chat.scss','public_html/css')
        .copy(jqueryPath + '/dist/jquery.min.js', 'public_html/js')
        .copy(bpath + '/fonts', 'public_html/fonts')
        .copy(vuePath, 'public_html/js')
        .copy(vueScrollPath, 'public_html/js')
        .copy('resources/assets/js/*.js', 'public_html/js')
        .copy('resources/assets/js/chat/*.js', 'public_html/js/chat')
        .copy('node_modules/@fortawesome/fontawesome-free/css/*.css', 'public_html/css/fontawesome')
        .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public_html/css/webfonts')
});