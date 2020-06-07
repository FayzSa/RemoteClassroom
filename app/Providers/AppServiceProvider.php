<?php

namespace App\Providers;

use App\Http\Controllers\AdminController;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       
        view()->composer(
            'layouts.admin', 
            function ($view) {
                $admin= new AdminController();
                $data=$admin->myProfile(session('uid'));
                $view->with('data',$data);
            }
        );
    }
}
