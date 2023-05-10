<?php

namespace Plugse\Fp;

class Log extends File
{
    private const VALUE_SEPARATOR = ' - ';
    protected static function arrayToString(array $dataStructure): string
    {
        $response = '';

        $keys = array_keys($dataStructure[0]);
        $response = implode(self::VALUE_SEPARATOR, $keys) . "\n";
        foreach ($dataStructure as $row) {
            $response .= implode(self::VALUE_SEPARATOR, $row) . "\n";
        }

        return $response;
    }

    protected static function stringToArray(string $dataStructure): array
    {
        $response = [];
        $dataLog = explode(self::BROKE_LINE, $dataStructure);
        $keys = $dataLog[0];
        unset($dataLog[0]);

        foreach ($dataLog as $row) {
            foreach (explode(' - ', $row) as $keyId => $value) {
                $response[$keys[$keyId]] = $value;
            }
        }



        return $response;
    }
}
