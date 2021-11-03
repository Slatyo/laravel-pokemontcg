<?php

namespace Slatyo\LaravelPokemontcg;

use Illuminate\Support\ServiceProvider;
use Slatyo\LaravelPokemontcg\Models\Card;
use Slatyo\LaravelPokemontcg\Models\Rarity;
use Slatyo\LaravelPokemontcg\Models\Set;
use Slatyo\LaravelPokemontcg\Models\Subtype;
use Slatyo\LaravelPokemontcg\Models\Supertype;
use Slatyo\LaravelPokemontcg\Models\Type;

class LaravelPokemontcgServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-pokemontcg');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-pokemontcg');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/pokemontcg.php' => config_path('pokemontcg.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-pokemontcg'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-pokemontcg'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-pokemontcg'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/pokemontcg.php', 'pokemontcg');

        // Register the main class to use with the facade
        $this->app->singleton('pokemontcg', function () {
            return new Pokemontcg;
        });

        // Register the card class to use with the facade
        $this->app->singleton('pokemontcg-card', function () {
            return new Card;
        });

        // Register the rarity class to use with the facade
        $this->app->singleton('pokemontcg-rarity', function () {
            return new Rarity;
        });

        // Register the set class to use with the facade
        $this->app->singleton('pokemontcg-set', function () {
            return new Set;
        });

        // Register the subtype class to use with the facade
        $this->app->singleton('pokemontcg-subtype', function () {
            return new Subtype;
        });

        // Register the supertype class to use with the facade
        $this->app->singleton('pokemontcg-supertype', function () {
            return new Supertype;
        });

        // Register the type class to use with the facade
        $this->app->singleton('pokemontcg-type', function () {
            return new Type;
        });
    }
}
