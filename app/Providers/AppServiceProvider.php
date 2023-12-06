<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
     
     /**
      * Bootstrap any application services.
      * 
      * @return void
      */
    public function boot()
    {
       Paginator::useBootstrap(); 
       \URL::forceScheme('https'); 
    }
    public function register()
{
    $this->app->singleton(MatchingService::class, function ($app) {
        return new MatchingService(/* コンストラクタに必要な引数を追加 */);
    });
}
}