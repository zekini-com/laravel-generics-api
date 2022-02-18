<?php

declare(strict_types=1);

namespace Zekini\Generics;

use Illuminate\Support\ServiceProvider;

class GenericsServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../stubs/ecs.php' => base_path('ecs.php'),
            __DIR__ . '/../stubs/phpstan.neon' => base_path('phpstan.neon'),
            __DIR__ . '/../stubs/psalm.xml' => base_path('psalm.xml'),
        ], 'zekini-config');

        // register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\ResetLocalPassword::class,
                Commands\MakeGenericCommand::class,
                Commands\MakeHelperCommand::class,
            ]);
        }
    }

    public function register()
    {
    }
}
