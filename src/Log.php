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
        $dataStructureToSave = self::getContent($update, $filename, $dataStructure);
        File::saveFile($filename, self::arrayToString($dataStructureToSave), $update);
    }

    private static function getKeys(bool $update, bool $fileExists, string $filename, array $dataStructure): array
    {
        $keys = key_exists(0, $dataStructure) ? array_keys($dataStructure[0]) : array_keys($dataStructure);

        if ($update and !$fileExists) {
            File::saveFile($filename, self::arrayToString($keys));
        }

        return $keys;
    }

    private static function getContent(bool $update, string $filename, array $dataStructure): array
    {
        $fileExists = file_exists($filename);
        $keys = self::getKeys($update, $fileExists, $filename, $dataStructure);
        $contentSave = $fileExists ? self::read($filename) : [$keys];

        $dataStructureValues = key_exists(0, $dataStructure)
            ? self::getValues($dataStructure)
            : array_values($dataStructure);

        if ($update) {
            if (key_exists(0, $dataStructure)) {
                foreach ($dataStructureValues as $data) {
                    array_push($contentSave, $data);
                }
            } else {
                array_push($contentSave, $dataStructureValues);
            }

            return $contentSave;
        } else {
            array_unshift(
                $dataStructureValues,
                $keys
            );
            return $dataStructureValues;
        }
    }

    private static function getValues(array $dataStructure): array
    {
        $dataStructureValues = [];
        foreach ($dataStructure as $element) {
            array_push(
                $dataStructureValues,
                array_values($element)
            );
        }

        return $dataStructureValues;
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
        $keys = explode(self::VALUE_SEPARATOR, $dataLog[0]);
        unset($dataLog[0]);

        foreach ($dataLog as $rowKey => $row) {
            if (strlen($row) > 0) {
                foreach ($keys as $keyKey => $key) {
                    $items = explode(self::VALUE_SEPARATOR, $row);
                    $response[$rowKey - 1][$key] = $items[$keyKey];
                }
            }
        }

        return $response;
    }
}
