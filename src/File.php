<?php

declare(strict_types=1);

namespace Plugse\Fp;

use Plugse\FP\Exceptions\FileAlreadyExists;
use Plugse\FP\Exceptions\FileCannotBeOppend;
use Plugse\FP\Exceptions\FileCannotBeWritten;
use Plugse\FP\Exceptions\FileNotFound;
use Plugse\FP\Exceptions\FileCanNotBeRead;

abstract class File
{
    protected const BROKE_LINE = "\n";
    public static function readFile(string $filename): string
    {

        if (!file_exists($filename)) {
            throw new FileNotFound($filename);
        }

        $fileContent = file($filename);
        if (!$fileContent) {
            throw new FileCanNotBeRead($filename);
        }

        return implode(self::BROKE_LINE, $fileContent);
    }

    public static function saveFile(string $filename, string $content, bool $update = false): void
    {
        self::createPathIfNotExists(dirname($filename));
        if (!$update) {
            if (file_exists($filename)) {
                throw new FileAlreadyExists($filename);
            }
        }

        if (!$handle = fopen($filename, 'w')) {
            throw new FileCannotBeOppend($filename);
        }

        if (fwrite($handle, $content) === false) {
            throw new FileCannotBeWritten($filename);
        }

        fclose($handle);
        $action = $update ? 'atualizado' : 'criado';
    }

    public static function createPathIfNotExists(string $path): void
    {
        if (file_exists($path)) {
            return;
        }

        $dir = '';
        foreach (explode('/', $path) as $dirPiece) {
                $dir .= "{$dirPiece}/";
            if (!file_exists($dir)) {
                mkdir($path, 0777, true);
            }
        }
    }

    public static function read(string $filename): array
    {
        return self::stringToArray(self::readFile($filename));
    }

    public static function save(string $filename, array $dataStructure, bool $update = false): void
    {
        self::saveFile($filename, self::arrayToString($dataStructure), $update);
    }

    abstract protected static function arrayToString(array $dataStructure): string;

    abstract protected static function stringToArray(string $dataStructure): array;
}
