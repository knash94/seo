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
});
