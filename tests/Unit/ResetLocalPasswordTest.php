<?php

declare(strict_types=1);

namespace Zekini\Generics\Tests\Unit;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Zekini\Generics\Tests\TestCase;

class ResetLocalPasswordTest extends TestCase
{
    /**
     * test_we_can_reset_local_password
     */
    public function testWeCanResetLocalPassword()
    {
        // insert a user into the database
        $this->createUser();

        //run the password reset command
        $password = \Faker\Factory::create()->word();
        $this->artisan('local:password-reset', [
            '--password' => $password,
        ]);

        // Verify that password hash matches
        $hashedPassword = DB::table('users')->get()->first()->password;
        $this->assertTrue(Hash::check($password, $hashedPassword));
    }

    /**
     * We cant reset password when not in local environment
     */
    public function testWeCantResetLocalPasswordWhenEnvIsNotLocal()
    {
        // set app environment
        //$this->app['config']->set('app.env', 'production');
        app()['env'] = 'prod';

        // insert a user into the database
        $this->createUser();

        //run the password reset command
        $password = \Faker\Factory::create()->word();
        $this->artisan('local:password-reset', [
            '--password' => $password,
        ]);

        // Verify that password hash matches
        $hashedPassword = DB::table('users')->get()->first()->password;
        $this->assertFalse(Hash::check($password, $hashedPassword));
    }
}
