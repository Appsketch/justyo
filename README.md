# Yo Laravel

## Installation

First, pull in the package through Composer.

```js
composer require m44rt3np44uw/justyo
```

And then, if using Laravel 5.1, include the service provider within `app/config/app.php`.

```php
'providers' => [
    M44rt3np44uw\Justyo\Providers\YoServiceProvider::class,
]
```

Aliases will be automatically set in the service provider.

If using Laravel 5. Include this service provider.

```php
'providers' => [
   "M44rt3np44uw\Justyo\Providers\YoServiceProvider"
]
```

Publish the config file to the config folder with the following command.
`php artisan vendor:publish`

Fill out the config file.

## Usage

Within, for example the routes.php add this.

```php
Route::get('/yo/all', function()
{
    // Send a Yo to all subscribers.
    Yo::all();
    
    // Send a Yo with a link to all subscribers.
    Yo::all($link);
});

Route::get('/yo/m44rt3np44uw', function()
{
    // Send a Yo to me.
    Yo::user('m44rt3np44uw');
    
    // Send a Yo to me with a link.
    Yo::user('m44rt3np44uw', $link);
    
    // Send a Yo to me with a location.
    Yo::user('m44rt3np44uw', $location);
});

Route::get('/yo/subscribers', function()
{
    // Get the number of subscribers.
    $subscribers = Yo::subscribers();
    
    // Echo the number of subscribers.
    echo $subscribers;
});

Route::get('/yo/check/m44rt3np44uw', function()
{
    // Check if the username exists.
    $result = Yo::checkUsername('m44rt3np44uw');
    
    // Echo the result.
    echo $result;
});

Route::get('/yo/create', function()
{
    // Account data
    // See the full option list on http://docs.justyo.co/docs/accounts.

    // Create a new Yo user.
    Yo::createAccount('m44rt3np44uw', $account_data);
});
```