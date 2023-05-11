<?php

declare(strict_types=1);

namespace Plugse\Fp;

class Log implements FileType
{
    private const VALUE_SEPARATOR = ' # ';

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
        $response = '';

        foreach ($dataStructure as $row) {
            $response .= implode(self::VALUE_SEPARATOR, $row) . File::BROKE_LINE;
        }

        return $response;
    }

    private static function stringToArray(string $dataStructure): array
    {
        $response = [];

        $dataLog = explode(File::BROKE_LINE, $dataStructure);

        foreach ($dataLog as $row) {
            if (strlen($row) > 0) {
                array_push($response, explode(self::VALUE_SEPARATOR, $row));
            }
        }

        return $response;
    }
}
