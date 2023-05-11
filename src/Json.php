<?php

declare(strict_types=1);

namespace Plugse\Fp;

class Json implements FileType
{
    public static function read(string $filename): array
    {
        return self::stringToArray(File::readFile($filename));
    }

    public static function save(string $filename, array $dataStructure, bool $update = false): void
    {
        File::saveFile($filename, self::arrayToString($dataStructure), $update);
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
