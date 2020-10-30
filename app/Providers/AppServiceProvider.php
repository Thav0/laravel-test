<?php

namespace App\Providers;

use App\Repositories\Order\Interfaces\IOrderRepository;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Product\Interfaces\IProductRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\User\Interfaces\IUserRegisterRepository;
use App\Repositories\User\UserRegisterRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRegisterRepository::class, UserRegisterRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
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
