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
    mix.sass('app.scss', 'public_html/css');
    mix.sass('main.scss','public_html/css')
        .copy(jqueryPath + '/dist/jquery.min.js', 'public_html/js')
        .copy(bpath + '/fonts', 'public_html/fonts')
        .copy(bpath + '/javascripts/bootstrap.min.js', 'public_html/js')
        .copy('resources/assets/js/homepage.js', 'public_html/js');
});