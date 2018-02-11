# [WIP] Laravel SEO Tools

A laravel 5 package that adds the ability to log 404 errors and to action these with redirects via a user interface. This has several benefits over creating redirect in a .htaccess (Or your web servers equivalent) as the main laravel application will run and then 404 if a page cannot be found, this is where the package will determine whether there is a redirect available. This prevents scenarios where a redirect may be hit before laravel and limiting access to your application. On top of this, it gives SEO members the ability to track 404 errors and action them with ease.

The package is currently work in progress and will only currently log 404 errors and only redirect if one has been manually created via database

## Installation
Install the package with composer
```php
composer require knash94\seo
```

Once installed, add the following line into your `config/app.php` service providers
```php
'Knash94\Seo\SeoServiceProvider'
```

Then open your `\App\Exceptions\Handler.php` file and insert the following code under the render method
```php
$redirect = $this->reportNotFound($e);

if ($redirect && $redirect instanceof RedirectResponse) {
    return $redirect;
}
````
Also add the `LogsMissingPages` trait to `\App\Exceptions\Handler.php`
```php
use LogsMissingPages;
````

## Todo
- Redirect manager screen
- Testing suite
- Ability to test if a redirect works as intended before applying the change
- Config file with middleware permissions, so only authorised members can access the manager