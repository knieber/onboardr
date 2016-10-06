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

    Route::group([
        'prefix' => '/organization'
    ], function() {

        Route::get('/join', 'OrganizationController@pickOrg');
        Route::post('/join', 'OrganizationController@join');
        Route::get('/{orgId}/select-role', 'RolesController@select');
        Route::post('/{orgId}/select-role', 'RolesController@join');

        Route::group(['middleware' => 'manager'], function() {
            Route::get('/{orgId}/manage', 'OrganizationController@manage');
            Route::get('/{orgId}/roles/create', 'RolesController@create');
            Route::post('/{orgId}/roles', 'RolesController@store');
            Route::get('/{orgId}/apps', 'AppsController@create');
            Route::post('/{orgId}/apps', 'AppsController@store');
        });

    });

    Route::group([
        'middleware' => 'member'
    ], function() {
        Route::resource('/organization', 'OrganizationController');

    });
});
