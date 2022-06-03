<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\MyClasses\MyService;
use Illuminate\Pagination\Paginator;

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
/*         if(config('singlton_flag')){
    
            echo 'AppServiceProvider[boot()] {<br>';
            $this->app->singleton(MyService::class,
            function($app){
                echo 'singleton(MyService::class,function($app){...} <br>';
                $myservice = new MyService();
                $myservice->setId(0);
                return $myservice;
            });
            echo '}<br>';
            
        } */    
        $this->app->singleton(MyService::class);
        Paginator::useBootstrapFive();    // Bootstrap 5
    }
}