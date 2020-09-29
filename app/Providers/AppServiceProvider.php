<?php

namespace App\Providers;

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
//        $this->app->singleton(\HillelDerish\UAadapter\UserAgentParserInterface::class, function (){
//            return new \HillelDerish\UAadapter\HisorangeAdapter();
////            return new \HillelDerish\UAadapter\DonatjAdapter();
//        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}
