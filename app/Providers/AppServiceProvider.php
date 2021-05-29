<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Share category
        view()->composer(['product.index', 'product.create', 'product.edit'], function ($view) {
            $categories = Category::all();
            
            $view->with('categories', $categories);
        });
    }
}
