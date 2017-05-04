<?php

namespace Zizaco\Entrust;

/*
 * This file is part of Entrust,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Zizaco\Entrust
 */

use Illuminate\Support\ServiceProvider;

class EntrustServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('entrust.php'),
        ]);

        // Register commands
        $this->commands('command.entrust.migration');
        $this->commands('command.entrust.classes');

        $this->loadViewsFrom(__DIR__.'/../views', 'entrust');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerEntrust();

        $this->registerCommands();

        $this->mergeConfig();
    }

    /**
     * Register the application bindings.
     */
    private function registerEntrust()
    {
        $this->app->bind('entrust', function ($app) {
            return new Entrust($app);
        });
    }

    /**
     * Register the artisan commands.
     */
    private function registerCommands()
    {
        $this->app->singleton('command.entrust.migration', function ($app) {
            return new MigrationCommand($app['config'], $app['view'], $app['composer'], $app['files']);
        });
        $this->app->singleton('command.entrust.classes', function ($app) {
            return new ClassCreatorCommand($app['config']);
        });
    }

    /**
     * Merges user's and entrust's configs.
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'entrust');
    }

    /**
     * Get the services provided.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.entrust.migration',
            'command.entrust.classes',
        ];
    }
}
