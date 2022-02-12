<?php

namespace App\Providers;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

use App\Repositories\PcategoryRepository;
use App\Repositories\PortfolioRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class,PcategoryRepository::class);
        $this->app->bind(RepositoryInterface::class,PortfolioRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
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
