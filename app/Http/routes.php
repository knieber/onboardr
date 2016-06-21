<?php

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::group([
    'middleware' => 'auth',
    'prefix' => '/app'
], function() {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::resource('/roles', 'RolesController');

    Route::get('/roles/{roleId}/apps', 'AppsController@create');
    Route::post('/roles/{roleId}/apps', 'AppsController@store');
});
