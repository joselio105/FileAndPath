<?php

declare(strict_types=1);

namespace Plugse\Fp;

class Env implements FileType
{
    public static function read(string $filename): array
    {
        return self::stringToArray(File::readFile($filename));
    }

    public static function save(string $filename, array $dataStructure, bool $update = false): void
    {
        $fileExists = file_exists($filename);

        if ($fileExists) {
            $contentSave = self::read($filename);
            foreach ($dataStructure as $key => $value) {
                $contentSave[$key] = $value;
            }
            $dataStructureToSave = $contentSave;
        } else {
            $dataStructureToSave = $dataStructure;
        }

        File::saveFile($filename, self::arrayToString($dataStructureToSave), $update);
    }

    private static function arrayToString(array $dataStructure): string
    {
        $response = '';

        foreach ($dataStructure as $key => $value) {
            $response .= "{$key} = {$value} " . File::BROKE_LINE;
        }

        return $response;
    }

    private static function stringToArray(string $dataStructure): array
    {
        $response = [];

        foreach (explode(File::BROKE_LINE, $dataStructure) as $row) {
            if (strlen($row) > 0) {
                [$key, $value] = explode('=', $row);
                $response[trim($key)] = trim($value);
            }
        }

        return $response;
    }
}
