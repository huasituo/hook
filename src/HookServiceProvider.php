<?php 

namespace Huasituo\Hook;

use Huasituo\Hook\Contracts\Repository;
use Huasituo\Hook\Providers\RouteServiceProvider;
use Huasituo\Hook\Providers\RepositoryServiceProvider;

use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{ 

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        //注册包视图
        $this->loadViewsFrom(__DIR__.'/../views', 'hook');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->singleton('hooks', function ($app) {
            $repository = $app->make(Repository::class);
            return new Hook($app, $repository);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string
     */
    public function provides()
    {
        return ['hooks'];
    }
}
