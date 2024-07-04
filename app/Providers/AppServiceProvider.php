<?php

namespace App\Providers;

use App\Models\Customer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Listeners\CreateCustomerFromRegisteredUser;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share the authenticated user's photo with all views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $customer = Customer::where('customer_id', Auth::user()->customer_id)->first();
                $photo = $customer ? $customer->photo : null;
                $view->with('photo', $photo);
            }
        });
    }
}
