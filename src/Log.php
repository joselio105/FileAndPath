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
        $fileExists = file_exists($filename);
        $contentSave = $fileExists ? self::read($filename) : [];

        if ($update) {
            $keys = $dataStructure[0];
            unset($dataStructure[0]);

            if ($fileExists) {
                $contentSave = self::read($filename);
                array_push($contentSave, $dataStructure);
            } else {
                File::saveFile($filename, self::arrayToString([$keys]));
            }
        }

        $dataStructureToSave = $update ? $contentSave : $dataStructure;
        File::saveFile($filename, self::arrayToString($dataStructureToSave), $update);
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
