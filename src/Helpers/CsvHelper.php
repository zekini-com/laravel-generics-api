<?php

declare(strict_types=1);

namespace Zekini\Generics\Helpers;

class CsvHelper extends BaseHelper
{
    public static function readCSV($file_name, int $numHeaderLines = 1): array
    {
        $fileArray = array_map('str_getcsv', file($file_name));

        $headersArray = [];
        $associativeArray = [];

        for ($i = 0; $i <= $numHeaderLines - 1; $i++) {
            if (array_key_exists($i, $fileArray)) {
                $headersArray[] = $fileArray[$i];
                unset($fileArray[$i]);
            }
        }

        $headersArray = $headersArray[count($headersArray) - 1];

        if (count($fileArray) > 0) {
            foreach ($fileArray as $i => $lineArray) {
                foreach ($lineArray as $key => $line) {
                    $associativeArray[$i][$headersArray[$key]] = $line;
                }
            }
        }

        return [
            'associativeArray' => $associativeArray,
            'headersArray' => $headersArray,
        ];
    }
}
