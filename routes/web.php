<?php

use Illuminate\Support\Facades\Route;


Route::get('/clear-all', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('clear-compiled');
    return "Cache of config, view, route, optimize Cleared!";
});

Route::get('/','DashboardController@index');
Route::resource('/groups', 'GroupsController')->except(['show']);


