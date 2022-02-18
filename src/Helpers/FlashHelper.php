<?php

declare(strict_types=1);

namespace Zekini\Generics\Helpers;

class FlashHelper extends BaseHelper
{
    // Deprecated. Leave here for backward compatibilty
    public static function success(string $msg, ?object $object = null): void
    {
        session()->flash('message', $msg);
    }

    public static function successRedirect(string $msg): void
    {
        session()->flash('message', $msg);
    }
}
