# Yo Laravel

[![Latest Stable Version](https://poser.pugx.org/appsketch/justyo/v/stable)](https://packagist.org/packages/appsketch/justyo) [![Total Downloads](https://poser.pugx.org/appsketch/justyo/downloads)](https://packagist.org/packages/appsketch/justyo) [![Latest Unstable Version](https://poser.pugx.org/appsketch/justyo/v/unstable)](https://packagist.org/packages/appsketch/justyo) [![License](https://poser.pugx.org/appsketch/justyo/license)](https://packagist.org/packages/appsketch/justyo)
## Installation

First, pull in the package through Composer.

```js
composer require appsketch/justyo
```

And then, if using Laravel 5.1, include the service provider within `app/config/app.php`.

```php
'providers' => [
    Appsketch\Justyo\Providers\YoServiceProvider::class,
]
```

Aliases will be automatically set in the service provider.

If using Laravel 5. Include this service provider.

```php
'providers' => [
   "Appsketch\Justyo\Providers\YoServiceProvider"
]
```

Publish the config file to the config folder with the following command.
`php artisan vendor:publish`

Fill out the config file. Set the api_token to the default api token.
If you want to use multiple accounts fill out the accounts array with as
key the account name (uppercase) and as value the api_token.

## Usage

Within, for example the routes.php add this.

```php

Route::get('/button', function()
{
    // Button.
    $button = Yo::button('m44rt3np44uw', 'When he like to Yo');
    
    // Render the Yo button.
    $button->render();
    
    // Only render the HTML.
    $button->html();
    
    // Only render the javascript.
    $button->javascript();
});

Route::get('/yo/all', function()
{
    // Link
    $link = "http://www.google.com/";
    
    // Account
    $account = "m44rt3np44uw";

    // Send a Yo to all subscribers.
    Yo::all();
    
    // Send a Yo from a specific account to all subscribers.
    Yo::account($account)->all();
    
    // Send a Yo with a link to all subscribers.
    Yo::all($link);
    
    // Send a Yo from a specific account with a link to all subscribers.
    Yo::account($account)->all($link);
});

Route::get('/yo/m44rt3np44uw+pizza', function()
{
    // Link
    $link = "http://www.google.com/";
    
    // Location
    $location = "54;4";
    
    // Account
    $account = "m44rt3np44uw";
    
    // Users
    $users = ["m44rt3np44uw", "pizza"];
    
    // Send a yo to multiple users.
    Yo::users($users);
    
    // Send a yo to multiple users from a specific account.
    Yo::account($account)->users($users);
    
    // Send a yo to multiple users with a link.
    Yo::users($users, $link);
    
    // Send a yo to multiple users with a link from a specific account.
    Yo::account($account)->users($users, $link);
    
    // Send a yo to multiple users with a location.
    Yo::users($users, $location);
    
    // Send a yo to multiple users with a location from a specific account.
    Yo::account($account)->users($users, $location);
});

Route::get('/yo/m44rt3np44uw', function()
{
    // Link
    $link = "http://www.google.com/";
    
    // Location
    $location = "54;4";
    
    // Account
    $account = "m44rt3np44uw";
    
    // Send a Yo to me.
    Yo::user('m44rt3np44uw');
    
    // Send a Yo from a specific account to me.
    Yo::account($account)->user('m44rt3np44uw');
    
    // Send a Yo to me with a link.
    Yo::user('m44rt3np44uw', $link);
    
    // Send a Yo from a specific account to me with a link.
    Yo::account($account)->user('m44rt3np44uw', $link);
    
    // Send a Yo to me with a location.
    Yo::user('m44rt3np44uw', $location);
    
    // Send a Yo from a specific account to me with a location.
    Yo::account($account)->user('m44rt3np44uw', $location);
});

Route::get('/yo/subscribers', function()
{
    // Account
    $account = "m44rt3np44uw";
    
    // Get the number of subscribers.
    $subscribers = Yo::subscribers();
    
    // Get the number of subscribers from a specific account.
    $subscribers = Yo::account($account)->subscribers();
    
    // Echo the number of subscribers.
    echo $subscribers;
});

Route::get('/yo/check/m44rt3np44uw', function()
{
    // Check if the username exists.
    $result = Yo::checkUsername('m44rt3np44uw');
    
    // Alias
    $result = Yo::check('m44rt3np44uw');
    
    // Echo the result.
    echo $result;
});

Route::get('/yo/create', function()
{
    // Account data
    // See the full option list on http://docs.justyo.co/docs/accounts.

    // Create a new Yo user.
    Yo::createAccount('m44rt3np44uw', $account_data);
    
    // Alias
    Yo::create('m44rt3np44uw', $account_data);
});

Route::get('/yo/followers', function()
{
    // Followers
    $followers = Yo::get_followers('m44rt3np44uw');
    
    // Echo the followers.
    echo $followers;
});

Route::get('/yo/contacts', function()
{
    // Contacts
    $contacts = Yo::get_contacts('m44rt3np44uw');
    
    // Echo the contacts.
    echo $contacts.
});
```