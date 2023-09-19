<?php

declare(strict_types=1);

namespace Plugse\Fp;

class Env implements FileType
{
    private const BROKE_LINE = "\n";

    public static function read(string $filename): array
    {
        return self::stringToArray(file_get_contents($filename));
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

        file_put_contents($filename, self::arrayToString($dataStructureToSave));
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

        foreach (explode(self::BROKE_LINE, $dataStructure) as $row) {
            if (strlen($row) > 0) {
                [$key, $value] = explode('=', $row);
                $response[trim($key)] = trim($value);
            }
        }

        return $response;
    }
}
