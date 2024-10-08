<?php

namespace Kovyakin\ParserDataProductWb\Providers;

use Illuminate\Support\ServiceProvider;
use Kovyakin\ParserDataProductWb\app\Console\Commands\InstallCommand;

class ParserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/parserWb.php', 'parserWb');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

//        Publishers

//config
        $this->publishes([
            __DIR__ . '/../config/parserWb.php' => config_path('parserWb.php'),
        ], 'laravel-assets');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class
            ]);
        }
    }
}
