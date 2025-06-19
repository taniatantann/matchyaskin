<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart; 

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
        
        // register komponen blade buat header sm footer
        Blade::component('components.footer', 'footer');


        // pass jml item dlm cart ke nav view (percobaan notif di cart T^T)
        View::composer('layouts.navigation', function ($view) {
            $cartItemCount = 0;

            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->first();
    
                if ($cart) {
                    // jumlahin qty semua item dlm cart
                    $cartItemCount = $cart->items->sum('quantity');
                }
            }
    
            $view->with('cartItemCount', $cartItemCount);
        });
    }
}
