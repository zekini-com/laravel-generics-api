<?php

declare(strict_types=1);

namespace Zekini\Generics\Helpers;

class StringHelper extends BaseHelper
{
    public static function getFileNameFromPathOrUrl(string $url): string
    {
        return collect(array_slice(explode('/', $url), -1, 1, true))->last();
    }
}
