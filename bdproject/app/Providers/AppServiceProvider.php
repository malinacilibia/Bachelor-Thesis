<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap ZZZany application services.
     *
     * @return void
     */

    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $notifications = Auth::user()->unreadNotifications;
                $view->with('notifications', $notifications);
                $view->with('unreadCount', $notifications->count());
            } else {
                $view->with('notifications', collect());
                $view->with('unreadCount', 0);
            }
        });
    }

}
