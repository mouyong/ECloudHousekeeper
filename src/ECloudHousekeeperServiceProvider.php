<?php

namespace MouYong\ECloudHousekeeper;

use Illuminate\Support\ServiceProvider;

class ECloudHousekeeperServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__."/../config/e-cloud-housekeeper.php", 'e-cloud-housekeeper');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
