<?php

declare(strict_types=1);

namespace Zekini\Generics\Tests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Orchestra\Testbench\TestCase as Orchestra;
use Zekini\Generics\GenericsServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->artisan('migrate', [
            '--database' => 'testbench',
        ])->run();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getPackageProviders($app): array
    {
        return [
            GenericsServiceProvider::class,
        ];
    }

    /**
     * Setup app environment
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {

       // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Inserts a user into the database
     */
    protected function createUser()
    {
        $faker = \Faker\Factory::create();
        DB::table('users')->insert([
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail,
            'password' => Hash::make($faker->word),
        ]);
    }
}
