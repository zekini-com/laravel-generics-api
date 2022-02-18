<?php

declare(strict_types=1);

namespace App\Helpers;

class ArrayToObjectHelper
{
    public function __construct(array $array)
    {
        foreach ($array as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
