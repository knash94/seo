<?php

return [
    'routing' => [
        'prefix' => 'admin/seo-tools',
        'namespace' => 'Knash94\Seo\Http\Controllers',
        'middleware' => ['web', 'auth']
    ],

    'views' => [
        'template' => 'seo-tools::templates.default',
        'section' => 'content',
        'index' => 'seo-tools::bootstrap3.index',

        'errors' => [
            'edit' => 'seo-tools::bootstrap3.errors.edit',
            'view' => 'seo-tools::bootstrap3.errors.view'
        ],

        'redirects' => [
            'edit' => 'seo-tools::bootstrap3.redirects.edit',
            'delete' => 'seo-tools::bootstrap3.redirects.delete'
        ]
    ],

    // Filters what URLs to not record using regex
    'filters' => [
        '/(\.png)|(\.jpg)|(\.gif)/',
        '/wp\-login\.php/'
    ]
];
