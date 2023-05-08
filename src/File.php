<?php

declare(strict_types=1);

namespace Plugse\Fp;

use Plugse\FP\Exceptions\FileAlreadyExists;
use Plugse\FP\Exceptions\FileCannotBeOppend;
use Plugse\FP\Exceptions\FileCannotBeWritten;
use Plugse\FP\Exceptions\FileNotFound;
use Plugse\FP\Exceptions\FileCanNotBeRead;

class File
{
    private const BROKE_LINE = "\n";
    public static function readLogFile(string $filename): array
    {
        $response = [];

        foreach (explode(self::BROKE_LINE, self::readFile($filename)) as $row) {
            array_push($response, explode(' - ', $row));
        }

        return $response;
    }
    public static function readJsonFile(string $filename): array
    {
        return json_decode(self::readFile($filename), true);
    }

    public static function readFromDotEnvFile(string $filename): array
    {
        $response = [];
        $separator = "=";
        foreach (explode(self::BROKE_LINE, self::readFile($filename)) as $row) {
            if (strlen($row) > 0 and strstr($row, $separator)) {
                $brk = explode($separator, $row);
                $key = trim($brk[0]);
                $value = trim($brk[1]);
                $response[$key] = $value;
            }
        }

        return $response;
    }

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

    public static function saveOnLogFile(string $filename, array $dataStructure, bool $update = false): void
    {
        $content = [];

        foreach ($dataStructure as $element) {
            array_push($content, implode(' - ', $element));
        }

        self::saveFile($filename, implode(self::BROKE_LINE, $content), $update);
    }

    public static function saveOnJsonFile(string $filename, array $dataStructure, bool $update = false): void
    {
        self::saveFile($filename, json_encode($dataStructure, JSON_PRETTY_PRINT), $update);
    }

    public static function saveOnDotEnvFile(string $filename, array $dataStructure, bool $update = false): void
    {
        $content = '';
        foreach ($dataStructure as $key => $value) {
            $content .= "{$key}={$value}" . self::BROKE_LINE;
        }

        self::saveFile($filename, $content, $update);
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
            if ($dirPiece !== '.') {
                $dir .= "/{$dirPiece}";
                if (!file_exists($dir)) {
                    mkdir($path, 0777, true);
                }
            }
        }
    }
}
