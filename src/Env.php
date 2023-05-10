<?php

namespace Plugse\Fp;

class Env extends File
{
    protected static function arrayToString(array $dataStructure): string
    {
        $response = '';

        foreach ($dataStructure as $key => $value) {
            $response .= "{$key} = {$value} " . self::BROKE_LINE;
        }

        return $response;
    }

    protected static function stringToArray(string $dataStructure): array
    {
        $response = [];

        foreach (explode(self::BROKE_LINE, $dataStructure) as $row) {
            [$key, $value] = explode('=', $row);
            $response[trim($key)] = trim($value);
        }

        return $response;
    }
}
