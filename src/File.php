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
    public const BROKE_LINE = "\n";

    public static function readFile(string $filename): string
    {

        if (!file_exists($filename)) {
            throw new FileNotFound($filename);
        }

        $content = file_get_contents($filename);
        if ($content === false) {
            throw new FileCanNotBeRead($filename);
        }

        return $content;
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
}
