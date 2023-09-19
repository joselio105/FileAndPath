<?php

declare(strict_types=1);

namespace Plugse\Fp;

class File
{
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
