<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Repositories\Pricing\PricingRepositoryInterface;
use Modules\Core\Repositories\Pricing\PricingRepository;

use Modules\Core\Repositories\EloquentRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(PricingRepositoryInterface::class, PricingRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
