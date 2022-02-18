<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Collection;

class ArrayHelper
{
    public static function removeEmptyElementsFromCollection(Collection $collection, int $is_header = 0): Collection
    {
        $array = $collection->toArray();

        if (! isset($array[0])) {
            return collect([]);
        }

        foreach ($array[0] as $key => $value) {
            $count = self::getCountForNonEmptyElementsByKey($collection, $key, $is_header);

            if ($count === 0) {
                foreach ($array as $arrayKey => $arrayValue) {
                    unset($array[$arrayKey][$key]);
                }
            }
        }

        return collect(array_map('array_values', $array));
    }

    public static function isStringInArrayWildcard(string $string, array $array): bool
    {
        foreach ($array as $value) {
            if (stripos($value, $string) !== false) {
                return true;
            }
        }

        return false;
    }

    private static function getCountForNonEmptyElementsByKey(Collection $collection, int $key, int $is_header = 0): int
    {
        return count($collection->slice($is_header)->pluck((string) $key)->filter());
    }
}
