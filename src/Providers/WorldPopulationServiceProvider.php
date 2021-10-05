<?php

namespace GetroXer\WorldPopulation\Providers;

use App\Services\Riak\Connection;
use Illuminate\Support\ServiceProvider;

class WorldPopulationServiceProvider extends ServiceProvider
{
    protected $commands = [
        'GetroXer\WorldPopulation\Console\Commands\WorldPopulationUpdate',
    ];

    public function boot()
    {
        $this->publishConfig();
        $this->publishMigrations();

        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register(){
        $this->mergeConfig();
        $this->commands($this->commands);
    }

    private function mergeConfig()
    {
        $path = $this->getConfigPath();
        $this->mergeConfigFrom($path, 'bar');
    }

    private function publishConfig()
    {
        $path = $this->getConfigPath();
        $this->publishes([$path => config_path('worldpopulation.php')], 'config');
    }

    private function publishMigrations()
    {
        $path = $this->getMigrationsPath();
        $this->publishes([$path => database_path('migrations')], 'migrations');
    }

    private function getConfigPath()
    {
        return __DIR__ . '/../../config/worldpopulation.php';
    }

    private function getMigrationsPath()
    {
        return __DIR__ . '/../../database/migrations/';
    }
}
