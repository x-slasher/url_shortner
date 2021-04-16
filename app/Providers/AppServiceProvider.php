<?php

namespace App\Providers;

use App\Repositories\Click\ClickRepository;
use App\Repositories\Click\EloquentClick;
use App\Repositories\Url\EloquentUrl;
use App\Repositories\Url\UrlRepository;
use App\Repositories\User\EloquentUser;
use App\Repositories\User\UserRepository;
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
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(UrlRepository::class, EloquentUrl::class);
        $this->app->singleton(ClickRepository::class, EloquentClick::class);
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
