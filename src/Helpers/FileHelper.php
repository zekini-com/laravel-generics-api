<?php

declare(strict_types=1);

namespace App\Helpers;

use Livewire\TemporaryUploadedFile;

class FileHelper
{
    public static function formatFilesize(float $size, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $step = 1024;
        $i = 0;

        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }

        return round($size, $precision) . ' ' . $units[$i];
    }

    public static function getFieldValue(array $row, string $field): string
    {
        if (str_contains($field, ':')) {
            return self::getSplitValue($row, $field);
        }

        return $row[$field];
    }

    /**
     * Store the uploaded file on a filesystem disk.
     *
     * @return string|false
     */
    public static function saveFile(string $folder, ?TemporaryUploadedFile $file)
    {
        return $file ? $file->store($folder) : false;
    }

    //"first_name" => "1:0" means colum 1; index 0
    private static function getSplitValue(array $row, string $field): string
    {
        $fieldArray = explode(':', $field);
        $indexInRow = (int) $fieldArray[0];
        $indexInSplitRow = (int) $fieldArray[1];

        $valueInRowToParse = $row[$indexInRow];

        $splitValueArray = explode(' ', $valueInRowToParse);

        return $splitValueArray[$indexInSplitRow];
    }
}
