<?php 

namespace Huasituo\Hook\Providers;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('command.hook.cache', function ($app) {
            return new \Huasituo\Hook\Console\Commands\HookCacheCommand($app['hooks']);
        });
        $this->commands('command.hook.cache');
        $this->app->singleton('command.hook.list', function ($app) {
            return new \Huasituo\Hook\Console\Commands\HookListCommand($app['hooks']);
        });
        $this->commands('command.hook.list');
    }
}
