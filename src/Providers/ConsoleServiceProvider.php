<?php 

namespace Huasituo\Hook\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;

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
            $file = $this->app->make(Filesystem::class);
            return new \Huasituo\Hook\Console\Commands\HookCacheCommand($app['hooks'], $file);
        });
        $this->commands('command.hook.cache');

        $this->app->singleton('command.hook.list', function ($app) {
            return new \Huasituo\Hook\Console\Commands\HookListCommand($app['hooks']);
        });
        $this->commands('command.hook.list');
        
        $this->app->singleton('command.hook.manage', function ($app) {
            return new \Huasituo\Hook\Console\Commands\HookManageCommand($app['hooks']);
        });
        $this->commands('command.hook.manage');
    }
}
