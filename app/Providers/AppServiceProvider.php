<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('category', function ($value) {
            $routeName = request()->route()->getName();

            if (in_array($routeName, ['category.update', 'category.destroy'])) {
                return \App\Models\Category::findOrFail($value);
            }

            return \App\Models\Category::where('slug', $value)->firstOrFail();
        });

        Route::bind('product', function ($value) {
            $routeName = request()->route()->getName();

            if (in_array($routeName, ['product.update', 'product.destroy'])) {
                return \App\Models\Product::findOrFail($value);
            }

            return \App\Models\Product::where('slug', $value)->firstOrFail();
        });

        Blade::component('layouts.auth', 'auth');
        Blade::component('layouts.guest', 'guest');
        Blade::component('layouts.admin', 'admin');
        Blade::component('components.navbar', 'navbar');
        Blade::component('components.footer', 'footer');

        Paginator::useBootstrapFive();
    }
}
