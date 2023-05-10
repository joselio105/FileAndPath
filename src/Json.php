<?php

namespace Plugse\Fp;

class Json extends File
{
    protected static function arrayToString(array $dataStructure): string
    {
        return json_encode($dataStructure, JSON_PRETTY_PRINT);
    }

    protected static function stringToArray(string $dataStructure): array
    {
        return json_decode($dataStructure, true);
    }
}
