<?php

declare(strict_types=1);

namespace Plugse\Fp;

class Log implements FileType
{
    private const VALUE_SEPARATOR = ' # ';

    public static function read(string $filename): array
    {
        return self::stringToArray(file_get_contents($filename));
    }

    public static function save(string $filename, array $dataStructure, bool $update = false): void
    {
        $dataStructureToSave = self::getContent($update, $filename, $dataStructure);
        file_put_contents($filename, self::arrayToString($dataStructureToSave));
    }

    private static function getContent(bool $update, string $filename, array $dataStructure): array
    {
        $contentSave = file_exists($filename) ? self::read($filename) : [];

        if (key_exists(0, $dataStructure)) {
            foreach ($dataStructure as $row) {
                array_push($contentSave, $row);
            }
        } else {
            array_push($contentSave, $dataStructure);
        }

        return self::convertArrayToLog($contentSave);
    }

    private static function convertArrayToLog(array $dataStructure): array
    {
        if (key_exists(0, $dataStructure)) {
            $keys = array_keys($dataStructure[0]);
            $logStructure = [$keys];
            foreach ($dataStructure as $row) {
                array_push($logStructure, array_values($row));
            }

            return $logStructure;
        } else {
            $keys = array_keys($dataStructure);
            $logStructure = [$keys];
            array_push($logStructure, array_values($dataStructure));

            return $logStructure;
        }
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
