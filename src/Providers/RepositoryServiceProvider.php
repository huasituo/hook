<?php 

namespace Huasituo\Hook\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $namespace = 'Huasituo\Hook\Repositories\Repository';
        $this->app->bind('Huasituo\Hook\Contracts\Repository', $namespace);
    }
}
