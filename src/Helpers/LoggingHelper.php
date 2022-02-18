<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class LoggingHelper
{
    public static function dblogging(): void
    {
        DB::listen(function ($query) {
            if (! self::shouldLog($query->time)) {
                return;
            }

            logger(
                self::getMessage($query),
                [
                    // 'query' => $query->sql,
                    // 'bindings' => $query->bindings,
                ]
            );
        });
    }

    private static function getMessage($query): string
    {
        return 'SLOW QUERY: ' . $query->time . PHP_EOL .
            'URL: ' . config('app.url') . PHP_EOL .
            'DB Host: ' . DB::connection()->getConfig('host') . PHP_EOL .
            'Database: ' . DB::connection()->getConfig('database') . PHP_EOL .
            // 'User: ' . optional(auth()->user())->email ?? 'Unknown' . PHP_EOL .
            'Time: ' . $query->time . PHP_EOL .
            'Query: ' . self::parseQuery($query);
    }

    private static function shouldLog(float $time): bool
    {
        return $time > config('custom.db_log_long');
    }

    private static function parseQuery($query): string
    {
        $sql = $query->sql;
        $bindings = $query->bindings;

        $sql = str_replace('?', "'%s'", $sql);

        $sql = sprintf($sql, ...$bindings);

        return 'use ' . DB::connection()->getConfig('database') . '; ' . $sql . ';';
    }
}
