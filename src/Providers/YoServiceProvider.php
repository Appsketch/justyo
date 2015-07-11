<?php

namespace M44rt3np44uw\Justyo\Providers;

use GuzzleHttp\Client;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use M44rt3np44uw\Justyo\Yo;

/**
 * Class YoServiceProvider
 *
 * @package App\Providers
 */
class YoServiceProvider extends ServiceProvider
{
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
        $this->app->bind('yo.client', function()
        {
            return new Client();
        });
    }

    /**
     * Register Yo.
     */
    private function registerYo()
    {
        $this->app->bind('yo', function($app)
        {
            return new Yo($app['yo.client']);
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
                \M44rt3np44uw\Justyo\Facades\Yo::class
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
}
