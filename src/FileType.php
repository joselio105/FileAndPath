<?php

namespace Plugse\Fp;

interface FileType
{
    public static function read(string $filename): array;

    public static function save(string $filename, array $dataStructure): void;
}
