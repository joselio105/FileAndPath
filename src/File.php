<?php

declare(strict_types=1);

namespace Plugse\Fp;

use Plugse\Fp\ExistingException;
use Plugse\Fp\NotFoundException;

class File
{
    public const BROKE_LINE = "\n";

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
