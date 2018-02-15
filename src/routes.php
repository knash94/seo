<?php

Route::group([
    'prefix' => config('seo-tools.routing.prefix'),
    'namespace' => config('seo-tools.routing.namespace'),
    'middleware' => config('seo-tools.routing.middleware')
], function() {
    Route::get('/', [
        'uses' => 'SeoRedirectController@index',
        'as' => 'seo-tools.index'
    ]);

    Route::get('/error/{id}', [
        'uses' => 'ErrorsController@view',
        'as' => 'seo-tools.error.view'
    ]);

    Route::get('/error/{id}/edit', [
        'uses' => 'ErrorsController@edit',
        'as' => 'seo-tools.error.edit'
    ]);

    Route::post('/error/{id}', [
        'uses' => 'ErrorsController@update',
        'as' => 'seo-tools.error.update'
    ]);

    Route::post('/redirect', [
        'uses' => 'RedirectController@store',
        'as' => 'seo-tools.redirect.store'
    ]);

    Route::get('/redirect/{id}/delete', [
        'uses' => 'RedirectController@delete',
        'as' => 'seo-tools.redirect.remove'
    ]);

    Route::get('/redirect/{id}/destroy', [
        'uses' => 'RedirectController@destroy',
        'as' => 'seo-tools.redirect.destroy'
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
