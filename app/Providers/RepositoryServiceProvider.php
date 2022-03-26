<?php

namespace App\Providers;

use App\Repositories\Interfaces\PortfolioCategoryRepositoryInterface;
use App\Repositories\Interfaces\PortfolioRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

use App\Repositories\PortfolioCategoryRepository;
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
        $this->app->bind(PortfolioCategoryRepositoryInterface::class,PortfolioCategoryRepository::class);
        $this->app->bind(PortfolioRepositoryInterface::class,PortfolioRepository::class);
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
