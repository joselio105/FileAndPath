<?php

declare(strict_types=1);

namespace Plugse\Fp;

class Json implements FileType
{
    public static function read(string $filename): array
    {
        return self::stringToArray(file_get_contents($filename));
    }

    public static function save(string $filename, array $dataStructure, bool $update = false): void
    {
        $fileExists = file_exists($filename);

        if ($fileExists) {
            $contentSave = self::read($filename);
            array_push($contentSave, $dataStructure);
            $dataStructureToSave = $contentSave;
        } else {
            $dataStructureToSave = $dataStructure;
        }

        file_put_contents($filename, self::arrayToString($dataStructureToSave));
    }

    private static function arrayToString(array $dataStructure): string
    {
        return json_encode($dataStructure, JSON_PRETTY_PRINT);
    }

    private static function stringToArray(string $dataStructure): array
    {
        return json_decode($dataStructure, true);
    }
}
