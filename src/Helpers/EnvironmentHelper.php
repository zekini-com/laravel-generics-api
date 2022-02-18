<?php

declare(strict_types=1);

namespace Zekini\Generics\Helpers;

use Illuminate\Support\Facades\App;

class EnvironmentHelper extends BaseHelper
{
    public static function isLocal(): bool
    {
        return App::environment('local') ? true : false;
    }

    public static function isStaging(): bool
    {
        return App::environment('staging') ? true : false;
    }

    public static function isTesting(): bool
    {
        return App::environment('testing') ? true : false;
    }

    public static function isProd(): bool
    {
        return App::environment('production') ? true : false;
    }

    public static function isNotLocal(): bool
    {
        return ! self::isLocal();
    }

    public static function isNotProd(): bool
    {
        return ! self::isProd();
    }

    public static function isNotStaging(): bool
    {
        return ! self::isStaging();
    }

    public static function isNotTesting(): bool
    {
        return ! self::isTesting();
    }

    public static function exitIfLocal(string $class, int $line, string $message = null): void
    {
        if (self::isLocal()) {
            logger($class . ' @ ' . $line . ' ' . $message ?? 'Dont run on Local');

            exit;
        }
    }

    public static function exitIfProd(string $class, int $line, string $message = null): void
    {
        if (self::isProd()) {
            logger($class . ' @ ' . $line . ' ' . $message ?? 'Dont run on Prod');

            exit;
        }
    }
}
