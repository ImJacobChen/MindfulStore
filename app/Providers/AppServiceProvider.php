<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Auth;
use DB;
use Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        view()->composer('*', function($view) {
          $view->with('user', Auth::user());
        });

        view()->composer('*', function($view) {
          $view->with('cartCount', Cart::count(false));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
