<?php 

namespace Huasituo\Hook;

use Huasituo\Hook\Contracts\Repository;
use Huasituo\Hook\Providers\RouteServiceProvider;
use Huasituo\Hook\Providers\HelperServiceProvider;
use Huasituo\Hook\Providers\ConsoleServiceProvider;
use Huasituo\Hook\Providers\RepositoryServiceProvider;

use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        //发布配置文件
        $this->publishes([
            __DIR__.'/../config/hook.php' => config_path('hook.php'),
        ], 'config');
        //注册包视图
        $this->loadViewsFrom(__DIR__.'/../views', 'hook');
        //注册数据迁移
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        //注册翻译文件
        $this->loadTranslationsFrom(__DIR__.'/../translations', 'hook');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/hook.php', 'hook'
        );
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(HelperServiceProvider::class);
        $this->app->register(ConsoleServiceProvider::class);
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
