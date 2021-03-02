const elixir = require('laravel-elixir');
const gulp  =require('gulp');


elixir(function(mix){

    mix.sass('app.scss').
    styles([
        'adminlte.css'
    ],'./public/css/adminlte.css')
});

gulp.task('default', gulp.series('server', 'watch'));
