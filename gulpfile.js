var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
    mix.scripts('table.js');
    mix.scripts('congestionDataTable.js');
    mix.scripts('eventDataTable.js');
    mix.scripts('reload.js');
    mix.scripts('dataTablesColumnFilter.js');
});
