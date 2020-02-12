<?php

namespace ViralsPackage\ViralsInventory;

use Illuminate\Support\ServiceProvider;

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
        $this->loadRoutesFrom(__DIR__.'/routes/inventory.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'virals-inventory');

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
    }
}
