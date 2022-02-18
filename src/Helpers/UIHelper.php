<?php

declare(strict_types=1);

namespace App\Helpers;

class UIHelper
{
    public static function displayBooleanAsTrueFalse($int): string
    {
        return $int ? 'True' : 'False';
    }
}
