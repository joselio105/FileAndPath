<?php

declare(strict_types=1);

namespace Plugse\Fp;

use Plugse\Fp\Errors\Existing;
use Plugse\Fp\Errors\NotFound;

class File
{
    public const BROKE_LINE = "\n";

    public static function readFile(string $filename): string
    {

        if (!file_exists($filename)) {
            throw new NotFound($filename);
        }

        $content = file_get_contents($filename);

        return $content;
    }

    public static function saveFile(string $filename, string $content, bool $update = false): void
    {
        self::createPathIfNotExists(dirname($filename));
        if (!$update) {
            if (file_exists($filename)) {
                throw new Existing($filename);
            }
        }

        $handle = fopen($filename, 'w');
        fwrite($handle, $content);
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
