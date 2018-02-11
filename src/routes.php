<?php

Route::group([
    'prefix' => config('seo-tools.routing.prefix'),
    'namespace' => config('seo-tools.routing.namespace')
], function() {
    Route::get('/', 'SeoRedirectController@index');
});
