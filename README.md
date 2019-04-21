# Laravel SEO Tools
<a href="https://packagist.org/packages/knash94/seo"><img src="https://poser.pugx.org/knash94/seo/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/knash94/seo"><img src="https://poser.pugx.org/knash94/seo/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/knash94/seo"><img src="https://poser.pugx.org/knash94/seo/license.svg" alt="License"></a>
[![Build Status](https://travis-ci.org/knash94/seo.svg?branch=master)](https://travis-ci.org/knash94/seo)

A laravel 5 package that adds the ability to log 404 errors and to action these with redirects via a user interface. This has several benefits over creating redirect in a .htaccess (Or your web servers equivalent) as the main laravel application will run and then 404 if a page cannot be found, this is where the package will determine whether there is a redirect available. This prevents scenarios where a redirect may be hit before laravel and limiting access to your application. On top of this, it gives SEO members the ability to track 404 errors, tracking where they have come from and then action them with ease.

## Installation
Install the package with composer
```php
composer require knash94\seo
```

Once installed, add the following line into your `config/app.php` service providers
```php
'Knash94\Seo\SeoServiceProvider'
```

Then open your `\App\Exceptions\Handler.php` file and insert the following code under the render method, be sure not to change any existing code on the method
```php
$redirect = $this->reportNotFound($exception);

if ($redirect && $redirect instanceof RedirectResponse) {
    return $redirect;
}
````
Also add the `LogsMissingPages` trait to `\App\Exceptions\Handler.php`
```php
use LogsMissingPages;
````

Also import the `Illuminate\Http\RedirectResponse;` in `App\Exceptions\Handler.php`


Finally, publish the vendor files and run the migrations by running these commands

```
php artisan vendor:publish --provider=Knash94\Seo\SeoServiceProvider
php artisan migrate
```

## Configuration
There are various configuration options to choose from, I'd recommend setting the `middleware`, `template` and `section` values. Simply open seo-tools.php and set the new values. Below is an example setup using your own template

```php
<?php

return [
    'routing' => [
        'prefix' => 'admin/seo-tools',
        'namespace' => 'Knash94\Seo\Http\Controllers',
        'middleware' => ['auth']
    ],

    'views' => [
        'template' => 'layout.admin',
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
```

If you want to link the redirect manager into your admin panel, then create a link to the `seo-tools.index` route

## Todo
- Testing suite
- Ability to test if a redirect works as intended before applying the change
- To mass insert redirects
- Ability to add regex into redirects
