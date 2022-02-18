<?php

declare(strict_types=1);

namespace App\Helpers;

class HttpHelper
{
    /**
     * Get Remote IP address
     */
    public static function getIp(): ?string
    {
        return request()->ip();
    }

    /**
     * Get User Agent
     */
    public static function getUserAgent(): ?string
    {
        return request()->userAgent();
    }
}
