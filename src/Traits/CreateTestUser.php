<?php

declare(strict_types=1);

namespace Zekini\Generics\Traits;

use App\Models\User;

trait CreateTestUser
{
    public function createUser(?array $array = [])
    {
        $user = User::factory()->create($array);

        return User::findOrFail($user->id);
    }
}
