<?php

return [
    'routing' => [
        'prefix' => 'admin/seo-tools',
        'namespace' => 'Knash94\Seo\Http\Controllers',
        'middleware' => []
    ],

    'views' => [
        'template' => 'seo-tools::templates.default',
        'section' => 'content',
        'index' => 'seo-tools::bootstrap3.index',

        'errors' => [
            'edit' => 'seo-tools::bootstrap3.errors.edit'
        ],

        'redirects' => [
            'edit' => 'seo-tools::bootstrap3.redirects.edit',
            'delete' => 'seo-tools::bootstrap3.redirects.delete'
        ]
    ]
];