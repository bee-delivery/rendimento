<?php

namespace BeeDelivery\BancoRendimento\Services;

use BeeDelivery\BancoRendimento\Rendimento;
use Illuminate\Support\ServiceProvider;

class RendimentoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/rendimento.php' => config_path('rendimento.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/rendimento.php', 'rendimento');

        // Register the service the package provides.
        $this->app->singleton('rendimento', function ($app) {
            return new Rendimento;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['rendimento'];
    }
}
