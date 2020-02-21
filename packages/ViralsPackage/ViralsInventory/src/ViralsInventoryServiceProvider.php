<?php

namespace ViralsPackage\ViralsInventory;

use Illuminate\Support\ServiceProvider;
use ViralsPackage\ViralsInventory\app\Console\Commands\AddSidebarContent;

class ViralsInventoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AddSidebarContent::class,
            ]);
        }

        $this->loadRoutesFrom(__DIR__.'/routes/inventory.php');

        $this->loadRoutesFrom(__DIR__.'/routes/inventoryApi.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'virals-inventory');

        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'virals-inventory');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->mergeConfigFrom(
            __DIR__.'/config/app.php',
            'app.providers'
        );
        $this->mergeConfigFrom(
            __DIR__.'/config/alias.php',
            'app.aliases'
        );

        $this->publishesFile();
    }

    private function publishesFile()
    {
        $this->publishes([
            __DIR__.'/resources/views' => base_path('resources/views/vendor/virals-inventory'),
        ], 'views');

        $this->publishes([
            __DIR__.'/resources/lang' => base_path('resources/lang/vendor/virals-inventory'),
        ], 'lang');

        $this->publishes([__DIR__.'/public' => public_path('vendor/virals')], 'public');
    }
}
