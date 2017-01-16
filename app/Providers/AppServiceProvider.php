<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Notification;
use App\User;
use Auth;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        if (Schema::hasTable('notifications')) {

            view()->composer('*', function ($view) 
            {
                if (Auth::user()) {

                    $notifs = Notification::where('user_id', Auth::user()->id)->take(10)->latest()->get();
                    // dd($notifs->get());
                    $view->with('notifs', $notifs);    

                }
            });  

        }
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
