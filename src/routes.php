<?php

Route::group([
    'prefix' => config('seo-tools.routing.prefix'),
    'namespace' => config('seo-tools.routing.namespace')
], function() {
    Route::get('/', [
        'uses' => 'SeoRedirectController@index',
        'as' => 'seo-tools.index'
    ]);

    Route::get('/error/{id}', [
        'uses' => 'ErrorsController@edit',
        'as' => 'seo-tools.error.edit'
    ]);

    Route::post('/error/{id}', [
        'uses' => 'ErrorsController@update',
        'as' => 'seo-tools.error.update'
    ]);

    Route::get('/redirect/{id}', [
        'uses' => 'RedirectController@edit',
        'as' => 'seo-tools.redirect.edit'
    ]);

    Route::post('/redirect/{id}', [
        'uses' => 'RedirectController@update',
        'as' => 'seo-tools.redirect.update'
    ]);
});
