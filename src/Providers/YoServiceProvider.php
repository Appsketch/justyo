<?php

namespace Appsketch\Justyo\Providers;

use GuzzleHttp\Client;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Appsketch\Justyo\Yo;

/**
 * Class YoServiceProvider
 *
 * @package App\Providers
 */
class YoServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config.
        $this->publishConfig();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge config.
        $this->mergeConfig();

        // Register bindings.
        $this->registerBindings();

        // Register Yo.
        $this->registerYo();

        // Alias Yo.
        $this->aliasYo();
    }

    /**
     * Register bindings.
     */
    private function registerBindings()
    {
        $this->app->singleton('GuzzleHttp\Client', function()
        {
            return new Client;
        });
    }

    /**
     * Register Yo.
     */
    private function registerYo()
    {
        $this->app->bind('Appsketch\Justyo\Yo', function($app)
        {
            return new Yo($app['GuzzleHttp\Client']);
        });
    }

    /**
     * Alias Yo.
     */
    private function aliasYo()
    {
        if(!$this->aliasExists('Yo'))
        {
            AliasLoader::getInstance()->alias(
                'Yo',
                \Appsketch\Justyo\Facades\Yo::class
            );
        }
    }

    /**
     * Publish config.
     */
    private function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/yo.php' => config_path('yo.php')
        ]);
    }

    /**
     * Merge config.
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/yo.php', 'yo'
        );
    }

    /**
     * Check if an alias already exists in the IOC.
     *
     * @param $alias
     *
     * @return bool
     */
    private function aliasExists($alias)
    {
        return array_key_exists($alias, AliasLoader::getInstance()->getAliases());
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'Appsketch\Justyo\Yo',
            'GuzzleHttp\Client'
        ];
    }
}
