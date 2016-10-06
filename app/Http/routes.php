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
        Route::get('/create', 'OrganizationController@create');
        Route::post('', 'OrganizationController@store');

        Route::group([
            'middleware' => 'member'
        ], function() {
            Route::get('/{organization}', 'OrganizationController@show');
            Route::get('/{organization}/onboard', 'AppsController@onBoardView');
        });

        Route::group(['middleware' => 'manager'], function() {
            Route::get('/{orgId}/manage', 'OrganizationController@manage');
            Route::get('/{orgId}/roles/create', 'RolesController@create');
            Route::post('/{orgId}/roles', 'RolesController@store');
            Route::get('/{orgId}/apps', 'AppsController@create');
            Route::post('/{orgId}/apps', 'AppsController@store');
        });

    });
});
